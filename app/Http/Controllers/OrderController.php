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
            'product_price' => 'required',
        ]);
        
        if( $request->order_id ) {

            $order = Order::find($request->order_id);
            $sellers = $order->users()->where('user_id', $request->seller_id)->get();

            if( !count($sellers) ) {

                $sellerN = User::find( $request->seller_id );
                $sellerN->placedOrders()->attach($request->order_id);
             
            }

            $orderItem = new Order_item;
            $orderItem->order_id = $request->order_id;
            $orderItem->product_id = $request->product_id;
            $orderItem->quantity = $request->quantity;
            $orderItem->price = $request->product_price;
            $orderItem->save();

            $item = Order_item::where('order_id', $request->order_id)
            ->where('product_id', $request->product_id)->first();

            echo json_encode($item);

        } else {

            // create order number
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
            $orderItem->price = $request->product_price;
            $orderItem->save();

            $item = Order_item::where('order_id', $order_id)
            ->where('product_id', $request->product_id)->first();

            echo json_encode($item);

            // //return order id
            // echo $order_id;

        }

    }

    public function place($order_id) {

        Order::find($order_id)->update(['order_status_id' => 2]);
        
    }

    public function updateQuantity(Request $request) {

        $this->validate(request(), [
            'quantity' => 'required',
            'item_id' => 'required',
        ]);
        
        $quantity = $request->quantity;
        $item_id = $request->item_id;
        $item_intId = (int)$item_id;
        
        $item = Order_item::find( $item_intId );
        $item->quantity = $quantity;
        $item->save();

    //    $item = DB::table('order_items')->where([
    //         ['order_id', '=' , $order_id],
    //         ['product_id', '=' , $product_id],
    //     ])->first();

        
        echo "Saved!!";
    }

    public function clearCart($order_id) {

        Order_item::where('order_id', $order_id)->delete();

    }

    public function removeFromCart($id) {

        Order_item::where('id', $id)->delete();

    }
}
