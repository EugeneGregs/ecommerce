<?php

namespace App\Http\Controllers;

use App\Product;

use App\Category;

use App\User;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('home');
        $userType = \Auth::user()->user_type;

        if($userType->user_type == "Admin") {

            return view('admin.index',compact('userType'));

        } else if($userType->user_type == "Seller") {

            return view('sellers.index',compact('userType'));

        }  else if($userType->user_type == "Buyer") {
            $total_amount = 0;
            $products = Product::where('status', 1)->latest()->get();
            $categories = Category::all();
            $sellers = User::where('user_type_id', 3)->get();
            $orderInCart = \Auth::user()->orders()->where('order_status_id', 1)->first();

            if( $orderInCart ) {

                $orderId = $orderInCart->id;
                $cartItems = $orderInCart->orderItems;

                foreach($cartItems as $cartItem) {
                    foreach( $products as $product ) {
                         if( $cartItem->product_id == $product->id) {
                            $total_amount += ( (int)$product->price * (int)$cartItem->quantity );
                         }
                    }
                }

           } else {

                $orderId = '';
                $cartItems =[];

           }

           return view('buyers.index', compact('products','categories','sellers','cartItems','orderId','total_amount'));

        // $testProduct = Product::where('status', 1)->latest()->get()->first();

        //     echo json_encode($testProduct);

        }
    }
}
