<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomMetaTag;
use App\PageName;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class CustomMetaTagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin==1){
            return view('admin.custom_meta_tags.index')->with('custom_meta_tags',CustomMetaTag::withTrashed()->get());
        }
        else{
            return view('admin.custom_meta_tags.index')->with('custom_meta_tags',CustomMetaTag::all());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.custom_meta_tags.create')->with('page_names',PageName::all());
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
            'name'=>'required',
            'description'=>'required'
        ]);


        $custom_meta_tag=CustomMetaTag::create([
            'name'=>$request->name,
            'description'=>$request->description
        ]);
        $custom_meta_tag->page_names()->attach($request->page_names);
        Session::flash('success','Meta tag added successfully.');
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
        $custom_meta_tag=CustomMetaTag::find($id);
        return view('admin.custom_meta_tags.edit')->with('custom_meta_tag', $custom_meta_tag)->with('page_names',PageName::all());
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
            'name'=>'required',
            'description'=>'required'
        ]);
        $custom_meta_tag=CustomMetaTag::find($id);
        $custom_meta_tag->page_names()->sync($request->page_names);
        $custom_meta_tag->name=$request->name;
        $custom_meta_tag->description=$request->description;
        $custom_meta_tag->save();
        Session::flash('success', 'Meta Tag updated successfully');
        return redirect()->route('custom_meta_tags');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $custom_meta_tag=CustomMetaTag::find($id);
        $custom_meta_tag->delete();
        Session::flash('success','The meta tag was just trashed.');
        return redirect()->back();
    }
}
