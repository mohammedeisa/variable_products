<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ProductsController extends \App\Http\Controllers\Controller {

    public function __construct() {
        $this->product = new Product();
    }

    public function list() {
        $products = Product::orderBy("updated_at", 'desc')->with('category')->paginate(15);
        $categories = Category::orderBy("updated_at", 'desc')->paginate(15);
        return view('product/frontend/list', ['products' => $products, 'categories' => $categories]);
    }

    public function filter(Request $request) {
        $products = $this->product->get_products_by_price_range($request->input('price_from'), $request->input('price_to'));
        $returnHTML = view('product.frontend.list_of_products_block', ['products' => $products])->render();
        return response()->json(array('success' => true, 'html' => $returnHTML));
    }

    public function search(Request $request) {
        $products = $this->product->search_products($request->input('query'));
        $returnHTML = view('product.frontend.list_of_products_block', ['products' => $products])->render();
        return response()->json(array('success' => true, 'html' => $returnHTML));
    }

    public function sort_by_category(Request $request) {
        $products = $this->product->get_products_ordered_by_category($request->input('order'));
        $returnHTML = view('product.frontend.list_of_products_block', ['products' => $products])->render();
        return response()->json(array('success' => true, 'html' => $returnHTML));
    }

    public function show($id) {
        $product = Product::with(['category'])->where('id', $id)->first();
        return view('product/frontend/show', ['product' => $product]);
    }

    public function get_product_JSON($id) {
        $product = Product::with(['category', 'attributes', 'variations'])->where('id', $id)->first();
        foreach ($product->variations as $variation) {}
        return response()->json(['product' => $product]);
    }

}
