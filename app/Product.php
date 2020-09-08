<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    public $fillable = ['name', 'description', 'price', 'category_id', 'image'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function attributes() {
        return $this->belongsToMany(Attribute::class);
    }

    public function variations() {
        return $this->hasMany(Variation::class, 'product_id');
    }

    public function get_products_by_price_range($price_from, $price_to) {
        return $this::where('price', '>=', $price_from)
                        ->where('price', '<=', $price_to)
                        ->orderBy("updated_at", 'desc')
                        ->get();
    }

    public function search_products($query) {
        return $this::where('name', '=', $query)
                        ->orWhere('description', 'like', '%' . $query . '%')
                        ->orderBy("updated_at", 'desc')
                        ->get();
    }

    public function get_products_ordered_by_category($order_direction) {
        return Product::join('categories', 'products.category_id', '=', 'categories.id')->orderBy('categories.name', $order_direction)->select('products.*')->paginate(10);
    }

}
