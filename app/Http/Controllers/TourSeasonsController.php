<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TourSeason;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class TourSeasonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin==1){
            return view('admin.tour_seasons.index')->with('tour_seasons',TourSeason::withTrashed()->get());
        }
        else{
            return view('admin.tour_seasons.index')->with('tour_seasons',TourSeason::all());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tour_seasons.create');
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

        $tour_season=new TourSeason();
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $name='name_'.$locale;
            $tour_season->translateOrNew($locale)->name = $request->$name;
        }
        $tour_season->save();
        Session::flash('success','Tour Season added successfully.');
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
        $tour_season=TourSeason::find($id);
        return view('admin.tour_seasons.edit')->with('tour_season', $tour_season);
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
/*      $this->validate($request, [
            'name' =>'required'
        ]);*/
        $tour_season=TourSeason::find($id);
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $name='name_'.$locale;
            $tour_season->getTranslation($locale)->slug = null;
            $tour_season->getTranslation($locale)->name=$request->$name;
            $tour_season->save();
        }
        Session::flash('success', 'Tour season updated successfully');
        return redirect()->route('tour_seasons');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tour_season=TourSeason::find($id);
        $tour_season->delete();
        Session::flash('success','The tour season was just trashed.');
        return redirect()->back();
    }
}
