<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeProduct extends Model {

    protected $table = 'attribute_product';
    public $fillable = ['product_id', 'attribute_id'];

}
