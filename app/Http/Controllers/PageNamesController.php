<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PageName;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class PageNamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin==1){
            return view('admin.page_names.index')->with('page_names',PageName::withTrashed()->get());
        }
        else{
            return view('admin.page_names.index')->with('page_names',PageName::all());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page_names.create');
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
            'name'=>'required'
        ]);


        PageName::create([
            'name'=>$request->name
        ]);

        Session::flash('success','Page name added successfully.');
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
        $page_name=PageName::find($id);
        return view('admin.page_names.edit')->with('page_name', $page_name);
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
            'name'=>'required'
        ]);
        $page_name=PageName::find($id);
        $page_name->name=$request->name;
        $page_name->save();
        Session::flash('success', 'Page name updated successfully');
        return redirect()->route('page_names');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page_name=PageName::find($id);
        $page_name->delete();
        Session::flash('success','The page name data was just trashed.');
        return redirect()->back();
    }
}
