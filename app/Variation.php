<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variation extends Model {

    public $fillable = ['product_id', 'price', 'quantity'];

    public function product() {
        return $this->belongsTo(Product::class);
    }
    public function attributes() {
        return $this->hasMany(VariationAttributes::class, 'variation_id');
    }

}
