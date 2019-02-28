<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HomePageContent;
use Illuminate\Support\Facades\Session;
class HomePageContentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home_page_contents.index')->with('home_page_contents',HomePageContent::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $home_page_content=HomePageContent::find($id);
        return view('admin.home_page_contents.edit')->with('home_page_content', $home_page_content);
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
            'who_we_are_content' =>'required',
            'the_best_tours_content' => 'required',
        ]);*/
        $home_page_content=HomePageContent::find($id);
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $who_we_are_content='who_we_are_content_'.$locale;
            $the_best_tours_content='the_best_tours_content_'.$locale;
            $unique_services_content='unique_services_content_'.$locale;
            $home_page_content->getTranslation($locale)->slug = null;
            $home_page_content->getTranslation($locale)->who_we_are_content=$request->$who_we_are_content;
            $home_page_content->getTranslation($locale)->the_best_tours_content=$request->$the_best_tours_content;
            $home_page_content->getTranslation($locale)->unique_services_content=$request->$unique_services_content;
            $home_page_content->save();
        }
        $home_page_content->save();

        Session::flash('success', 'Home page content updated successfully');
        return redirect()->route('home_page_contents');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
