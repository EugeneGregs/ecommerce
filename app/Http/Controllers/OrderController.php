<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Order;

use App\Order_item;

use App\Product;

use App\User;

use DB;

class OrderController extends Controller
{
    public function cart(Request $request) {

        $this->validate(request(), [
            'user_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
            'order_id' => 'required',
            'seller_id' => 'required',
        ]);
        
        if( $request->order_id ) {

            $orderItem = new Order_item;
            $orderItem->order_id = $request->order_id;
            $orderItem->product_id = $request->product_id;
            $orderItem->quantity = $request->quantity;
            $orderItem->save();

            echo "Working";

        } else {

            //create order number
            $order_number = 'ORD'.time();

            //create new order
            $order = new Order;
            $order->user_id = $request->user_id;
            $order->order_status_id = 1;
            $order->order_number = $order_number;
            $order->save();

            //get order id
            $NewOrder = Order::where('user_id', $request->user_id)
            ->where('order_status_id', 1)
            ->get()->first();
            $order_id = $NewOrder->id;

            //attach the order to the seller
            $seller = User::find( $request->seller_id );
            $seller->placedOrders()->attach($order_id);

            //create order item
            $orderItem = new Order_item;
            $orderItem->order_id = $order_id;
            $orderItem->product_id = $request->product_id;
            $orderItem->quantity = $request->quantity;
            $orderItem->save();

            //return order id
            echo $order_id;

        }

    }

    public function place($order_id) {

        Order::find($order_id)->update(['order_status_id' => 2]);
        
    }

    public function placedOrders() {

        $placedOrders = \Auth::user()->placedOrders()->where('order_status_id', 2);
        $products = \Auth::user()->products;
        
        return view('sellers.orders', compact('placedOrders', 'products'));
    }

    public function complete($order_id, $product_id) {

        // update order status
        Order::find($order_id)->update(['order_status_id' => 3]);

        // update product status
        Product::find($product_id)->update(['status' => 2]);

        //send email to buyer



    }

    public function updateQuantity(Request $request) {

        $this->validate(request(), [
            'order_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
        ]);
        
        $order_id = $request->query('order_id');
        $product_id = $request->query('product_id');
        $quantity = $request->query('quantity');

       DB::table('order_items')->where([
            ['order_id', '=' , $order_id],
            ['product_id', '=' , $product_id],
        ])->update(['quantity' =>  $quantity]);
        
    }

    public function clearCart($order_id) {

        Order_item::where('order_id', $order_id)->delete();

    }

    public function removeFromCart($product_id) {

        Order_item::where('product_id', $product_id)->delete();

    }
}
