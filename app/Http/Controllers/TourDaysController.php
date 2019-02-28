<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tour;
use App\TourDay;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class TourDaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin==1){
            return view('admin.tour_days.index')->with('tour_days',TourDay::withTrashed()->get());
        }
        else{
            return view('admin.tour_days.index')->with('tour_days',TourDay::all());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tour_days.create')->with('tours', Tour::all());
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
            //'author' =>'required',
            //'author_image' => 'image',
            //'text_content' => 'required',
            'tour_id'=>'required',
            'day_number'=>'required'
        ]);

            $tour_day=TourDay::create([
                'tour_id'=>$request->tour_id,
                'day_number'=>$request->day_number,
            ]);

            foreach (array_keys(config('translatable.locales')) as $locale) {
                $text_content='text_content_'.$locale;
                $tour_day->translateOrNew($locale)->text_content = $request->$text_content;

            }
            $tour_day->save();

        Session::flash('success','Tour day created successfully.');
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
        $tour_day=TourDay::find($id);
        return view('admin.tour_days.edit')->with('tour_day', $tour_day)
            ->with('tours', Tour::all());
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
            //'author' =>'required',
            //'author_image' => 'image',
            //'text_content' => 'required',
            'tour_id'=>'required',
            'day_number'=>'required'
        ]);
        $tour_day=TourDay::find($id);
        $tour_day->tour_id=$request->tour_id;
        $tour_day->day_number=$request->day_number;
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $text_content='text_content_'.$locale;
            $tour_day->getTranslation($locale)->slug = null;
            $tour_day->getTranslation($locale)->text_content=$request->$text_content;
            $tour_day->save();
        }
        $tour_day->save();
        Session::flash('success', 'Tour day updated successfully');
        return redirect()->route('tour_days');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tour_day=TourDay::find($id);
        $tour_day->delete();
        Session::flash('success','The tour day was just trashed.');
        return redirect()->back();
    }
}
