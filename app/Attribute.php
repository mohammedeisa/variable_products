<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model {

    public $fillable = ['name', 'category_id'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class);
    }

}
