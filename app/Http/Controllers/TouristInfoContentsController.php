<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TouristInfoContent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
class TouristInfoContentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tourist_info_contents.index')->with('tourist_info_contents',TouristInfoContent::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tourist_info_contents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tourist_info_content=new TouristInfoContent();

        foreach (array_keys(config('translatable.locales')) as $locale) {
            $visa_content='visa_content_'.$locale;
            $climate_content='climate_content_'.$locale;
            $currency_content='currency_content_'.$locale;
            $safety_content='safety_content_'.$locale;

            $tourist_info_content->translateOrNew($locale)->visa_content = $request->$visa_content;
            $tourist_info_content->translateOrNew($locale)->climate_content = $request->$climate_content;
            $tourist_info_content->translateOrNew($locale)->currency_content = $request->$currency_content;
            $tourist_info_content->translateOrNew($locale)->safety_content = $request->$safety_content;
            $tourist_info_content->save();
        }
        $tourist_info_content->save();

        Session::flash('success','Tourist info content created successfully.');
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
        $tourist_info_content=TouristInfoContent::find($id);
        return view('admin.tourist_info_contents.edit')->with('tourist_info_content', $tourist_info_content);
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
        $tourist_info_content=TouristInfoContent::find($id);
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $visa_content='visa_content_'.$locale;
            $climate_content='climate_content_'.$locale;
            $currency_content='currency_content_'.$locale;
            $safety_content='safety_content_'.$locale;


            $tourist_info_content->getTranslation($locale)->visa_content=$request->$visa_content;
            $tourist_info_content->getTranslation($locale)->climate_content = $request->$climate_content;
            $tourist_info_content->getTranslation($locale)->currency_content = $request->$currency_content;
            $tourist_info_content->getTranslation($locale)->safety_content = $request->$safety_content;

            $tourist_info_content->save();
        }
        $tourist_info_content->save();
        Session::flash('success', 'Tourist info content updated successfully');
        return redirect()->route('tourist_info_contents');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tourist_info_content=TouristInfoContent::find($id);
        $tourist_info_content->delete();
        Session::flash('success','Tourist info page content was just trashed.');
        return redirect()->back();
    }
}
