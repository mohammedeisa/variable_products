<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories_Attributes extends Model {

    public $fillable = ['category_id', 'attribute_id'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function attribute() {
        return $this->belongsTo(Attribute::class);
    }

}
