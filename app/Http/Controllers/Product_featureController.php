<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Feature;

use App\Product;

class Product_featureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $product = Product::find($id);
        $features = \Auth::user()->features;

        return view('productFeatures.show', compact('product','features'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $features = \Auth::user()->features;
        $product = Product::find($id);
        $featureToJs = json_encode($features);
        return view('productFeatures.create', compact('features','product','featureToJs'));
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
            'product_id' => 'required',
            'feature_id' => 'required',
        ]);
        
        $productId = $request->product_id;
        $featureId = $request->feature_id;
        $product = Product::find($productId);

        $product->features()->attach($featureId);

        return redirect('/product_features/'.$productId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($product_id, $feature_id)
    {
        $features = \Auth::user()->features;
        $product = Product::find($product_id);
        $feature = Feature::find($feature_id);

        return view('productFeatures.edit', compact('features','product','feature'));
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
        $this->validate(request(), [
            'product_id' => 'required',
            'feature_id' => 'required',
        ]);
        
        $productId = $request->product_id;
        $featureId = $request->feature_id;
        $product = Product::find($productId);
        
        $product->features()->detach($id);
        $product->features()->attach($featureId);

        return redirect('/product_features/'.$productId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id, $feature_id)
    {
        $product = Product::find($product_id);
        $product->features()->detach($feature_id);

        return redirect('/product_features/'.$product_id);
    }
}
