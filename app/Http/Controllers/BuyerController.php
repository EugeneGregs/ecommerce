<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

use App\Category;

use App\Order_item;

use App\Order;

use App\User;

class BuyerController extends Controller
{
    public function cart() {

        $buyer_id = \Auth::user()->id;
        $products = Product::where('status', 1)->latest()->get();
        echo($products);
        $cartItems = Order::where('user_id', $buyer_id)->where('order_status_id', 1)->get()->first()->orderItems;
        $orderId = Order::where('user_id', $buyer_id)->where('order_status_id', 1)->get()->first()->id;
        $categories = Category::all();
        $sellers = User::where('user_type_id', 3)->get();

        return view('buyers.index', compact('products','categories','sellers','cartItems'));
    }
}
