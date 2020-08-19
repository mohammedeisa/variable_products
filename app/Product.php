<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    public $fillable = ['name', 'description', 'category_id'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function attributes() {
        return $this->belongsToMany(Attribute::class);
    }

    public function variations() {
        return $this->hasMany(Variation::class, 'product_id');
    }

}
