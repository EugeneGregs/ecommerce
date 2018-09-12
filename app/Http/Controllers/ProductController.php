<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use App\Product;

use App\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = \Auth::user()->products;

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'image' => 'image|nullable|max:1999',
            'description' => 'required',
        ]);

        if( $request->hasFile('image') ) {

            //get file Name with Extension
            $fileNameWithExt = $request->file('image')->getClientOriginalName();

            //get just File name
            $fileName = pathinfo( $fileNameWithExt, PATHINFO_FILENAME );

            //get just ext
            $ext = $request->file('image')->getClientOriginalExtension();

            //file name to store
            $fileNameToStore = $fileName.'_'.time().'.'.$ext;

            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
        } else {
            $fileNameToStore = 'defaultImage.png';
        }

        $product = new Product;
        $product->category_id = $request->input('category_id');
        $product->name = $request->input('name');
        $product->status = 1;
        $product->price = $request->input('price');
        $product->image = $fileNameToStore;
        $product->description = $request->input('description');
        $product->user_id = \Auth::User()->id;
        $product->save();

        return redirect('/products');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        return view('products.singleProduct', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();

        return view('products.editProduct', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request(), [
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'image' => 'image|nullable|max:1999',
            'description' => 'required',
        ]);

        if( $request->hasFile('image') ) {

            //get file Name with Extension
            $fileNameWithExt = $request->file('image')->getClientOriginalName();

            //get just File name
            $fileName = pathinfo( $fileNameWithExt, PATHINFO_FILENAME );

            //get just ext
            $ext = $request->file('image')->getClientOriginalExtension();

            //file name to store
            $fileNameToStore = $fileName.'_'.time().'.'.$ext;

            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
        }

        $product = Product::find($id);

        $product->category_id = $request->input('category_id');
        $product->name = $request->input('name');
        $product->status = 1;
        $product->price = $request->input('price');
        if($request->hasFile('image')) {
            $product->image = $fileNameToStore;
        }
        $product->description = $request->input('description');
        $product->user_id = \Auth::User()->id;
        $product->save();

        return redirect('/products');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if($product->image !== 'defaultImage.png') {

            Storage::delete('public/images/'.$product->image);
        }

        $product->delete();

        return redirect('/products');
    }
}
