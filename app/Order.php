<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $table = 'orders';
    public $fillable = ['total'];

    public function products() {
        return $this->hasMany(Product::class, 'order_id');
    }

}
