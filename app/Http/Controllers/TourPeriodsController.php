<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TourPeriod;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class TourPeriodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin==1){
            return view('admin.tour_periods.index')->with('tour_periods',TourPeriod::withTrashed()->get());
        }
        else{
            return view('admin.tour_periods.index')->with('tour_periods',TourPeriod::all());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tour_periods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
/*        $this->validate($request, [
            'name' =>'required'
        ]);*/
        
        $tour_period=new TourPeriod();
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $name='name_'.$locale;
            $tour_period->translateOrNew($locale)->name = $request->$name;
        }
        $tour_period->save();
        Session::flash('success','Tour Period added successfully.');
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
        $tour_period=TourPeriod::find($id);
        return view('admin.tour_periods.edit')->with('tour_period', $tour_period);
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
/*        $this->validate($request, [
            'name' =>'required'
        ]);*/
        $tour_period=TourPeriod::find($id);
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $name='name_'.$locale;
            $tour_period->getTranslation($locale)->slug = null;
            $tour_period->getTranslation($locale)->name=$request->$name;
            $tour_period->save();
        }
        $tour_period->save();
        Session::flash('success', 'Tour period updated successfully');
        return redirect()->route('tour_periods');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tour_period=TourPeriod::find($id);
        $tour_period->delete();
        Session::flash('success','The tour period was just trashed.');
        return redirect()->back();
    }
}
