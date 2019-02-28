<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TourGroupSize;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class TourGroupSizesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin==1){
            return view('admin.tour_group_sizes.index')->with('tour_group_sizes',TourGroupSize::withTrashed()->get());
        }
        else{
            return view('admin.tour_group_sizes.index')->with('tour_group_sizes',TourGroupSize::all());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tour_group_sizes.create');
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
            'size' =>'required'
        ]);


        $tour_group_size=TourGroupSize::create([
            'size'=>$request->size
        ]);

        Session::flash('success','Tour group size added successfully.');
        return redirect()->back();
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
        $tour_group_size=TourGroupSize::find($id);
        return view('admin.tour_group_sizes.edit')->with('tour_group_size', $tour_group_size);
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
            'size' =>'required'
        ]);
        $tour_group_size=TourGroupSize::find($id);
        $tour_group_size->size=$request->size;
        $tour_group_size->save();
        Session::flash('success', 'Tour group size updated successfully');
        return redirect()->route('tour_group_sizes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tour_group_size=TourGroupSize::find($id);
        $tour_group_size->delete();
        Session::flash('success','The tour group size was just trashed.');
        return redirect()->back();
    }
}
