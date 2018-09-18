<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Order_user;

use App\Order;

class SellerConteroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function placedOrders() {
        
        return view('sellers.orders');
    }

    public function complete($order_id) {

        //update completed column of order_users table to 1
        Order_user::where('order_id', $order_id)->where('user_id', \Auth::user()->id )
        ->update(['completed' => 1]);

        //check if there are uncompleted orders
        $uncompleted = Order_user::where('order_id', $order_id)->where('completed', 0)->get();

        //update order_status_table only if there are 
        if( !count($uncompleted) ) {
            Order::find($order_id)->update(['order_status_id' => 3]);
        }

        return redirect('/orders');

    }

    public function viewSingle($order_id) {
        $items = Order::find( $order_id )->orderItems;

        return view('sellers.orderItems', compact('items'));
    }
}
