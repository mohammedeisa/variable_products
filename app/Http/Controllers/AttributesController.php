<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException as QueryException;
use App\Product;
use App\Category;
use App\Attribute;
use Illuminate\Support\Collection;

class AttributesController extends Controller {

    public function index() {
        $attributes = DB::table('attributes')->get();
        return view('attribute/index', ['attributes' => $attributes]);
    }

    public function create() {
        return view('attribute/create', ['attributes', new Attribute()]);
    }

    public function store(Request $request) {

        $this->validate($request, [
            'name' => 'required|max:10',
            'category' => 'required',
        ]);

        $name = $request->input('name');
        $category = null;
        if ($request->input("is_new_category") == "yes") {
            $category = Category::create(['name' => $request->input('category')])->id;
        } else {
            $category = $request->input('category');
        }

        $new_attribute = null;
        try {
            $new_attribute = Attribute::create(['name' => $name, 'category_id' => $category]);
        } catch (QueryException $e) {
            return redirect()->route('attribute.create')->withErrors('Something went wrong, please try again' . dd($e->getMessage()));
        }

        return redirect()->route('attribute.edit', ['id' => $new_attribute])->with(['message' => 'the attribute has been created successfully!', 'alert-class' => 'alert-success']);
    }

    public function edit(Request $request, $id = null) {
        if ($request->isMethod('post')) {
            if (!$this->update($request)) {
                return redirect()->back()->withErrors('Something went wrong. please try again');
            }
        }
        $attribute = Attribute::with('category')->where('id', $id)->first();
        return view('attribute/edit', ['attribute' => $attribute]);
    }

    public function update($request) {
        $id = $request->input('id');
        $this->validate($request, [
            'name' => 'required|max:10',
        ]);
        $category = null;
        if ($request->input("is_new_category") == "yes") {
            $category = Category::create(['name' => $request->input('category')])->id;
        } else {
            $category = $request->input('category');
        }
        try {
            DB::table('attributes')
                    ->where('id', $id)
                    ->update(['name' => $request->name, 'category_id' => $category]);
        } catch (QueryException $e) {
            return false;
        }
        return redirect()->route('attribute.edit', ['id' => $id])->with(['message' => 'The attribute has been edited successfully!', 'alert-class' => 'alert-success']);
    }

    public function search(Request $request) {

        $term = $request->input('term');
        $category_id = $request->input('category_id');
        $page = $request->input('page');

        $search_result = DB::table('attributes AS A')
                ->leftJoin('categories AS C', 'A.category_id', '=', 'C.id')
                ->where('A.name', 'like', '%' . $term . '%')
                ->where('C.id', '=', $category_id)
                ->get(['A.id', 'A.name']);

        return json_encode($search_result);
    }

}
