<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException as QueryException;
use App\Product;
use App\Category;
use App\Variation;
use App\Attribute;
use App\VariationAttributes;

class ProductsController extends Controller {

    public function index() {
        $products = Product::orderBy("updated_at", 'desc')->with('category')->paginate(15);
        return view('product/index', ['products' => $products]);
    }

    public function create() {
        return view('product/create', ['product', new Product()]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:10',
        ]);

        $name = $request->input('name');
        $description = $request->input('description');
        $category = null;
        if ($request->input("is_new_category") == "yes") {
            $category = Category::create(['name' => $request->input('category')])->id;
        } else {
            $category = $request->input('category');
        }

        $new_product = null;
        try {
            $new_product = Product::create(['name' => $name, 'category_id' => $category, 'description' => $description]);
        } catch (QueryException $e) {
            return redirect()->route('product.create')->withErrors('Something went wrong, please try again' . dd($e->getMessage()));
        }

        $attributes = $request->input('attributes');
        if (count($request->input('attributes'))) {
            $new_product->attributes()->sync($request->input('attributes'));
        }

        $product_from_request = $request->input('product');
        if (isset($product_from_request['new_variations'])) {

            foreach ($product_from_request['new_variations'] as $request_variation) {
                $new_variation = Variation::create([
                            'product_id' => $new_product->id,
                            'price' => $request_variation['price'],
                            'quantity' => $request_variation['quantity']
                ]);
                foreach ($request_variation['attributes'] as $attribute_id => $attribute) {
                    VariationAttributes::create(['variation_id' => $new_variation->id, 'attribute_id' => $attribute['attribute_id'], 'value' => $attribute['value']]);
                }
            }
        }

        return redirect()->route('product.edit', ['id' => $new_product])->with(['message' => 'the product has been created successfully!', 'alert-class' => 'alert-success']);
    }

    public function edit(Request $request, $id = null) {
        if ($request->isMethod('post')) {
            if (!$this->update($request)) {
                return redirect()->back()->withErrors('Something went wrong. please try again');
            }
        }

        $product = Product::with(['category'])->where('id', $id)->first();

        $variations_count = count($product->variations);

        $variations_ids = [];
        foreach ($product->variations as $variation) {
            $variations_ids[] = $variation->id;
        }
        $variations_attributes = VariationAttributes::select('id', 'variation_id', 'attribute_id', 'value')
                ->whereIn('variation_id', $variations_ids)
                ->get();


        return view('product/edit', ['product' => $product, 'variations' => $product->variations, 'variations_count' => $variations_count, 'variations_attributes' => $variations_attributes]);
    }

    public function update($request) {
        $id = $request->input('id');
        $this->validate($request, [
            'name' => 'required|max:10',
        ]);

        $DB_product = Product::with(['variations'])->where('id', $id)->first();

        $category = null;
        if ($request->input("is_new_category") == "yes") {
            $category = Category::create(['name' => $request->input('category')])->id;
        } else {
            $category = $request->input('category');
        }

        $product_from_request = $request->input('product');

        try {
            DB::table('products')
                    ->where('id', $id)
                    ->update(['name' => $request->name, 'description' => $request->description, 'category_id' => $category]);
        } catch (QueryException $e) {
            return false;
        }
        if (count($request->input('attributes'))) {
            $DB_product->attributes()->sync($request->input('attributes'));
        }
        if (isset($product_from_request['new_variations'])) {
            foreach ($product_from_request['new_variations'] as $new_variation_from_request) {

                $new_variation = Variation::create([
                            'product_id' => $DB_product->id,
                            'price' => $new_variation_from_request['price'],
                            'quantity' => $new_variation_from_request['quantity']
                ]);
                foreach ($new_variation_from_request['attributes'] as $attribute_id => $attribute) {
                    VariationAttributes::create(['variation_id' => $new_variation->id, 'attribute_id' => $attribute['attribute_id'], 'value' => $attribute['value']]);
                }
            }
        }
        if (isset($product_from_request['old_variations'])) {
            foreach ($product_from_request['old_variations'] as $request_variation_id => $request_variation) {

                if ($request_variation['updated'] !== 'yes') {
                    continue;
                }
                Variation::where('id', $request_variation_id)
                        ->update(['price' => $request_variation['price'], 'quantity' => $request_variation['quantity']]);

                foreach ($request_variation['attributes'] as $request_variation_attribute_id => $request_variation_attribute) {
                    VariationAttributes::where(['variation_id' => $request_variation_id, 'attribute_id' => $request_variation_attribute['attribute_id']])
                            ->update(['value' => $request_variation_attribute['value']]);
                }
            }
        }
        return redirect()->route('product.edit', ['id' => $id])->with(['message' => 'The product has been edited successfully!', 'alert-class' => 'alert-success']);
    }

    public function add_variation_block(Request $request) {
        $attributes_ids = $request->input('attributes');
        $attributes = \App\Attribute::select('id', 'name')
                ->whereIn('id', $attributes_ids)
                ->get();
        $existing_variation_blocks_count = $request->input('variation_blocks_count');
        $returnHTML = view('product.fields.new_variation_block', ['variation_block_index' => $existing_variation_blocks_count + 1, 'variation_attributes' => $attributes])->render(); // or method that you prefere to return data + RENDER is the key here
        return response()->json(array('success' => true, 'html' => $returnHTML));
    }

    public function delete(Request $request, $id) {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('product.index')->with(['message' => 'The product doesn\'t exist!', 'alert-class' => 'alert-error']);
        }
        $product->delete();
        return redirect()->route('product.index')->with(['message' => 'The product has been deleted successfully!', 'alert-class' => 'alert-success']);
    }

    public function delete_variation(Request $request) {
        try {
            $variation = Variation::find($request->input('variation_id'));
            if ($variation->has('attributes')) {
                $variation->attributes()->delete();
            }
            $variation->delete();
        } catch (QueryException $e) {
            return response()->json(['message' => 'Something went wrong'], 404);
        }
        return response()->json(['message' => 'Done'], 200);
    }

}
