<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException as QueryException;
use App\Product;
use App\Category;
use App\Variation;
use App\Attribute;
use App\Order;
use App\OrderProducts;

class OrdersController extends \App\Http\Controllers\Controller {

    public function place_an_order(Request $request) {
        $order_data = ($request->input('order_data'));
        $new_order = null;
        try {
            $new_order = Order::create(['total' => $order_data['total']]);
        } catch (QueryException $e) {
            echo ($e->getMessage());
            return false;
        }

        foreach ($order_data['items'] as $item) {
            OrderProducts::create([
                'order_id' => $new_order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' => $item['subtotal']
            ]);
        }
        return response()->json(array('success' => true));
    }

}
