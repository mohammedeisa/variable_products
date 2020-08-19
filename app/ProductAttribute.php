<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model {

    protected $table = 'product_attribute';
    public $fillable = ['product_id', 'attribute_id'];

}
