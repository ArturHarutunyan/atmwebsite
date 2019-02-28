<?php

namespace App\Http\Controllers;

use App\MealsAndCatering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class MealsAndCateringsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin==1){
            return view('admin.meals_and_caterings.index')->with('meals_and_caterings',MealsAndCatering::withTrashed()->get());
        }
        else{
            return view('admin.meals_and_caterings.index')->with('meals_and_caterings',MealsAndCatering::all());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.meals_and_caterings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $meals_and_catering=new MealsAndCatering();
        $meals_and_catering->link=$request->link;
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $name='name_'.$locale;
            $address='address_'.$locale;
            $description='description_'.$locale;
            $meals_and_catering->translateOrNew($locale)->name = $request->$name;
            $meals_and_catering->translateOrNew($locale)->address = $request->$address;
            $meals_and_catering->translateOrNew($locale)->description = $request->$description;
        }
        $meals_and_catering->save();

        Session::flash('success','Meals and Catering created successfully.');
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
        $meals_and_catering=MealsAndCatering::find($id);
        return view('admin.meals_and_caterings.edit')->with('meals_and_catering', $meals_and_catering);
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
        $meals_and_catering=MealsAndCatering::find($id);
        $meals_and_catering->link=$request->link;
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $name='name_'.$locale;
            $address='address_'.$locale;
            $description='description_'.$locale;
            $meals_and_catering->getTranslation($locale)->slug = null;
            $meals_and_catering->getTranslation($locale)->name=$request->$name;
            $meals_and_catering->getTranslation($locale)->address=$request->$address;
            $meals_and_catering->getTranslation($locale)->description=$request->$description;
            $meals_and_catering->save();
        }
        $meals_and_catering->save();
        Session::flash('success', 'Meals and catering updated successfully');
        return redirect()->route('meals_and_caterings');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $meals_and_catering=MealsAndCatering::find($id);
        $meals_and_catering->delete();
        Session::flash('success','The meals and catering was just trashed.');
        return redirect()->back();
    }
}
