<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TourType;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class TourTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin==1){
            return view('admin.tour_types.index')->with('tour_types',TourType::withTrashed()->get());
        }
        else{
            return view('admin.tour_types.index')->with('tour_types',TourType::all());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tour_types.create');
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

        $tour_type=new TourType();
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $name='name_'.$locale;
            $tour_type->translateOrNew($locale)->name = $request->$name;
        }
        $tour_type->save();
        Session::flash('success','Tour type added successfully.');
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
        $tour_type=TourType::find($id);
        return view('admin.tour_types.edit')->with('tour_type', $tour_type);
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
        $tour_type=TourType::find($id);
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $name='name_'.$locale;
            $tour_type->getTranslation($locale)->slug = null;
            $tour_type->getTranslation($locale)->name=$request->$name;
            $tour_type->save();
        }
        Session::flash('success', 'Tour type updated successfully');
        return redirect()->route('tour_types');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tour_type=TourType::find($id);
        $tour_type->delete();
        Session::flash('success','The tour type was just trashed.');
        return redirect()->back();
    }
}
