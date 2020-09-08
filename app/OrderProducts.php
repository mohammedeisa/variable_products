<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model {

    protected $table = 'order_products';
    public $fillable = ['product_id', 'order_id', 'quantity', 'subtotal'];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

}
