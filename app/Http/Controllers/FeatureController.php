<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Feature;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $features = \Auth::user()->features;
       return view('sellers.features', compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $features = Feature::all();
        return view('sellers.createFeature', compact('features'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),[
            'user_id' => 'required',
            'name' => 'required',
            'parent' => 'required',
        ]);

        Feature::create(request(['user_id','name','parent']));

        session()->flash("You have created a new Feature");

        return redirect('/features');
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
    public function edit($id)
    {
        $feature = Feature::find($id);

        $features = Feature::all();

        return view('sellers.editFeature', compact('feature','features'));
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
            'user_id' => 'required',
            'name' => 'required',
            'parent' => 'required',
        ]);

        Feature::where('id', $id)
        ->update(request(['user_id','name','parent']));

        return redirect('/features');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Feature::where('id', $id)
        ->delete();

        return redirect('/features');
    }
}
