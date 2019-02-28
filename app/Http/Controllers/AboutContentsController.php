<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AboutContent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
class AboutContentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.about_contents.index')->with('about_contents',AboutContent::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.about_contents.create');
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
            'why_me_first_image' => 'required',
            'why_me_second_image' => 'required',
            'why_me_third_image' => 'required',
            'why_me_fourth_image' => 'required',
        ]);

        $about_content=AboutContent::create([
            'why_me_first_image'=>$request->why_me_first_image,
            'why_me_second_image'=>$request->why_me_second_image,
            'why_me_third_image'=>$request->why_me_third_image,
            'why_me_fourth_image'=>$request->why_me_fourth_image,
        ]);

        foreach (array_keys(config('translatable.locales')) as $locale) {
            $company_content='company_content_'.$locale;
            $our_projects_content='our_projects_content_'.$locale;
            $dmc_content='dmc_content_'.$locale;
            $excursion_content='excursion_content_'.$locale;
            $logistics_content='logistics_content_'.$locale;
            $special_events_content='special_events_content_'.$locale;
            $for_partners_content='for_partners_content_'.$locale;
            $login_password_content='login_password_content_'.$locale;
            $your_account_content='your_account_content_'.$locale;
            $special_content='special_content_'.$locale;
            $why_me_first_title='why_me_first_title_'.$locale;
            $why_me_first_content='why_me_first_content_'.$locale;
            $why_me_second_title='why_me_second_title_'.$locale;
            $why_me_second_content='why_me_second_content_'.$locale;
            $why_me_third_title='why_me_third_title_'.$locale;
            $why_me_third_content='why_me_third_content_'.$locale;
            $why_me_fourth_title='why_me_fourth_title_'.$locale;
            $why_me_fourth_content='why_me_fourth_content_'.$locale;
            $about_content->translateOrNew($locale)->company_content = $request->$company_content;
            $about_content->translateOrNew($locale)->our_projects_content = $request->$our_projects_content;
            $about_content->translateOrNew($locale)->dmc_content = $request->$dmc_content;
            $about_content->translateOrNew($locale)->excursion_content = $request->$excursion_content;
            $about_content->translateOrNew($locale)->logistics_content = $request->$logistics_content;
            $about_content->translateOrNew($locale)->special_events_content = $request->$special_events_content;
            $about_content->translateOrNew($locale)->for_partners_content = $request->$for_partners_content;
            $about_content->translateOrNew($locale)->login_password_content = $request->$login_password_content;
            $about_content->translateOrNew($locale)->your_account_content = $request->$your_account_content;
            $about_content->translateOrNew($locale)->special_content = $request->$special_content;
            $about_content->translateOrNew($locale)->why_me_first_title = $request->$why_me_first_title;
            $about_content->translateOrNew($locale)->why_me_first_content = $request->$why_me_first_content;
            $about_content->translateOrNew($locale)->why_me_second_title = $request->$why_me_second_title;
            $about_content->translateOrNew($locale)->why_me_second_content = $request->$why_me_second_content;
            $about_content->translateOrNew($locale)->why_me_third_title = $request->$why_me_third_title;
            $about_content->translateOrNew($locale)->why_me_third_content = $request->$why_me_third_content;
            $about_content->translateOrNew($locale)->why_me_fourth_title = $request->$why_me_fourth_title;
            $about_content->translateOrNew($locale)->why_me_fourth_content = $request->$why_me_fourth_content;
            $about_content->save();
        }
        $about_content->save();



        Session::flash('success','About page content created successfully.');
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
        $about_content=AboutContent::find($id);
        return view('admin.about_contents.edit')->with('about_content', $about_content);
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

        $about_content=AboutContent::find($id);
        $about_content->why_me_first_image=$request->why_me_first_image;
        $about_content->why_me_second_image=$request->why_me_second_image;
        $about_content->why_me_third_image=$request->why_me_third_image;
        $about_content->why_me_fourth_image=$request->why_me_fourth_image;

        foreach (array_keys(config('translatable.locales')) as $locale) {
            $company_content='company_content_'.$locale;
            $our_projects_content='our_projects_content_'.$locale;
            $dmc_content='dmc_content_'.$locale;
            $excursion_content='excursion_content_'.$locale;
            $logistics_content='logistics_content_'.$locale;
            $special_events_content='special_events_content_'.$locale;
            $for_partners_content='for_partners_content_'.$locale;
            $login_password_content='login_password_content_'.$locale;
            $your_account_content='your_account_content_'.$locale;
            $special_content='special_content_'.$locale;
            $why_me_first_title='why_me_first_title_'.$locale;
            $why_me_first_content='why_me_first_content_'.$locale;
            $why_me_second_title='why_me_second_title_'.$locale;
            $why_me_second_content='why_me_second_content_'.$locale;
            $why_me_third_title='why_me_third_title_'.$locale;
            $why_me_third_content='why_me_third_content_'.$locale;
            $why_me_fourth_title='why_me_fourth_title_'.$locale;
            $why_me_fourth_content='why_me_fourth_content_'.$locale;

            $about_content->getTranslation($locale)->company_content=$request->$company_content;
            $about_content->getTranslation($locale)->our_projects_content = $request->$our_projects_content;
            $about_content->getTranslation($locale)->dmc_content = $request->$dmc_content;
            $about_content->getTranslation($locale)->excursion_content = $request->$excursion_content;
            $about_content->getTranslation($locale)->logistics_content = $request->$logistics_content;
            $about_content->getTranslation($locale)->special_events_content = $request->$special_events_content;
            $about_content->getTranslation($locale)->for_partners_content = $request->$for_partners_content;
            $about_content->getTranslation($locale)->login_password_content = $request->$login_password_content;
            $about_content->getTranslation($locale)->your_account_content = $request->$your_account_content;
            $about_content->getTranslation($locale)->special_content = $request->$special_content;
            $about_content->getTranslation($locale)->why_me_first_title = $request->$why_me_first_title;
            $about_content->getTranslation($locale)->why_me_first_content = $request->$why_me_first_content;
            $about_content->getTranslation($locale)->why_me_second_title = $request->$why_me_second_title;
            $about_content->getTranslation($locale)->why_me_second_content = $request->$why_me_second_content;
            $about_content->getTranslation($locale)->why_me_third_title = $request->$why_me_third_title;
            $about_content->getTranslation($locale)->why_me_third_content = $request->$why_me_third_content;
            $about_content->getTranslation($locale)->why_me_fourth_title = $request->$why_me_fourth_title;
            $about_content->getTranslation($locale)->why_me_fourth_content = $request->$why_me_fourth_content;
            $about_content->save();
        }
        $about_content->save();
        Session::flash('success', 'About page content updated successfully');
        return redirect()->route('about_contents');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $about_content=AboutContent::find($id);
        $about_content->delete();
        Session::flash('success','The About page content was just trashed.');
        return redirect()->back();
    }
}
