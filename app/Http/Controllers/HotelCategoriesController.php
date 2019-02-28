<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HotelCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class HotelCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin==1){
            return view('admin.hotel_categories.index')->with('hotel_categories',HotelCategory::withTrashed()->get());
        }
        else{
            return view('admin.hotel_categories.index')->with('hotel_categories',HotelCategory::all());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.hotel_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' =>'required'
        ]);


        HotelCategory::create([
            'name'=>$request->name
        ]);

        Session::flash('success','Hotel category added successfully.');
        return redirect()->back();
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hotel_category=HotelCategory::find($id);
        return view('admin.hotel_categories.edit')->with('hotel_category', $hotel_category);
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
        $this->validate($request, [
            'name' =>'required'
        ]);
        $hotel_category=HotelCategory::find($id);
        $hotel_category->name=$request->name;
        $hotel_category->save();
        Session::flash('success', 'Hotel category updated successfully');
        return redirect()->route('hotel_categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hotel_category=HotelCategory::find($id);
        $hotel_category->delete();
        Session::flash('success','The hotel category was just trashed.');
        return redirect()->back();
    }
}
