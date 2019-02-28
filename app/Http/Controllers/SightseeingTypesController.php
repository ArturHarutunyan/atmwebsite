<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SightseeingType;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class SightseeingTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin==1){
            return view('admin.sightseeing_types.index')->with('sightseeing_types',SightseeingType::withTrashed()->get());
        }
        else{
            return view('admin.sightseeing_types.index')->with('sightseeing_types',SightseeingType::all());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sightseeing_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$this->validate($request, [
            'name' =>'required'
        ]);*/

        $sightseeing_type=new SightseeingType();
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $name='name_'.$locale;
            $sightseeing_type->translateOrNew($locale)->name = $request->$name;
        }
        $sightseeing_type->save();
        Session::flash('success','Sightseeing Type added successfully.');
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
        $sightseeing_type=SightseeingType::find($id);
        return view('admin.sightseeing_types.edit')->with('sightseeing_type', $sightseeing_type);
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
        /*$this->validate($request, [
            'name' =>'required'
        ]);*/
        $sightseeing_type=SightseeingType::find($id);
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $name='name_'.$locale;
            $sightseeing_type->getTranslation($locale)->slug = null;
            $sightseeing_type->getTranslation($locale)->name=$request->$name;
            $sightseeing_type->save();
        }
        Session::flash('success', 'Sightseeing Type updated successfully');
        return redirect()->route('sightseeing_types');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sightseeing_type=SightseeingType::find($id);
        $sightseeing_type->delete();
        Session::flash('success','The sightseeing type was just trashed.');
        return redirect()->back();
    }
}
