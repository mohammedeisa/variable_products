<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException as QueryException;
use App\Product;
use App\Category;
use Illuminate\Support\Collection;

class CategoriesController extends \App\Http\Controllers\Controller {

    public function index() {
        $products = DB::table('products')->get();
        return view('product/index', ['products' => $products]);
    }

    public function create() {
        return view('product/create', ['product', new Product()]);
    }

    public function store(Request $request) {

        $this->validate($request, [
            'name' => 'required|max:10',
        ]);
        $new_product = null;
        try {
            $new_product = Product::create($request->all());
        } catch (QueryException $e) {
            return redirect()->route('product.create')->withErrors('Something went wrong, please try again' . dd($e->getMessage()));
        }

        return redirect()->route('product.edit', ['id' => $new_product])->with(['message' => 'the product has been created successfully!', 'alert-class' => 'alert-success']);
    }

    public function edit(Request $request, $id = null) {
        if ($request->isMethod('post')) {
            if (!$this->update($request)) {
                return redirect()->back()->withErrors('Something went wrong. please try again');
            }
        }
        $product = Product::whereId($id)->first();
        return view('product/edit', ['product' => $product]);
    }

    public function update($request) {
        $id = $request->input('id');
        $this->validate($request, [
            'name' => 'required|max:10',
        ]);
        try {
            DB::table('products')
                    ->where('id', $id)
                    ->update(['name' => $request->name, 'description' => $request->description]);
        } catch (QueryException $e) {
            return false;
        }
        return redirect()->route('product.edit', ['id' => $id])->with(['message' => 'The product has been edited successfully!', 'alert-class' => 'alert-success']);
    }

    public function search($term = null, $page = 1) {
        $search_result = DB::table('categories')->where('name', 'like', '%' . $term . '%')->get(['id', 'name']);
        return json_encode($search_result);
    }

}
