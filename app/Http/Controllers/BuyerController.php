<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

use App\Category;

use App\User;

class BuyerController extends Controller
{
    public function index() {

        $products = Product::latest();
        $categories = Category::all();
        $sellers = User::where('user_type_id', 3);

        return view('buyers.index', compact('products','categories','sellers'));
    }
}
