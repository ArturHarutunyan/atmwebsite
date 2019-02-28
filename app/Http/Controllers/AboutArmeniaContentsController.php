<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AboutArmeniaContent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
class AboutArmeniaContentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.about_armenia_contents.index')->with('about_armenia_contents',AboutArmeniaContent::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.about_armenia_contents.create');
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
            'history_image' => 'image|required',
            'religion_image' => 'image|required'
        ]);
        $history_image_new_name=time().$request->history_image->getClientOriginalName();
        $religion_image_new_name=time().$request->religion_image->getClientOriginalName();
        $request->history_image->move('uploads/about_armenia_contents', $history_image_new_name);
        $request->religion_image->move('uploads/about_armenia_contents', $religion_image_new_name);
        $history_image=resize_image('uploads/about_armenia_contents/'.$history_image_new_name,500,500);
        $religion_image=resize_image('uploads/about_armenia_contents/'.$religion_image_new_name,500,500);
        $history_imageName = substr($history_image_new_name,0,strpos($history_image_new_name,"."));
        $religion_imageName = substr($religion_image_new_name,0,strpos($religion_image_new_name,"."));
        unlink('uploads/about_armenia_contents/'.$history_image_new_name);
        unlink('uploads/about_armenia_contents/'.$religion_image_new_name);
        imagepng($history_image,'uploads/about_armenia_contents/'.$history_imageName.".png");
        imagepng($religion_image,'uploads/about_armenia_contents/'.$religion_imageName.".png");
        $about_armenia_content=AboutArmeniaContent::create([
            'history_image'=>'uploads/about_armenia_contents/'.rawurlencode($history_imageName).".png",
            'religion_image'=>'uploads/about_armenia_contents/'.rawurlencode($religion_imageName).".png",
        ]);

        foreach (array_keys(config('translatable.locales')) as $locale) {
            $history_content='history_content_'.$locale;
            $culture_content_one='culture_content_one_'.$locale;
            $culture_content_two='culture_content_two_'.$locale;
            $religion_content='religion_content_'.$locale;
            $climate_content='climate_content_'.$locale;
            $climate_content_two='climate_content_two_'.$locale;
            $winter_content='winter_content_'.$locale;
            $spring_content='spring_content_'.$locale;
            $summer_content='summer_content_'.$locale;
            $autumn_content='autumn_content_'.$locale;
            $first_reason_content='first_reason_content_'.$locale;
            $second_reason_content='second_reason_content_'.$locale;
            $third_reason_content='third_reason_content_'.$locale;
            $fourth_reason_content='fourth_reason_content_'.$locale;
            $fifth_reason_content='fifth_reason_content_'.$locale;
            $about_armenia_content->translateOrNew($locale)->history_content = $request->$history_content;
            $about_armenia_content->translateOrNew($locale)->culture_content_one = $request->$culture_content_one;
            $about_armenia_content->translateOrNew($locale)->culture_content_two = $request->$culture_content_two;
            $about_armenia_content->translateOrNew($locale)->religion_content = $request->$religion_content;
            $about_armenia_content->translateOrNew($locale)->climate_content = $request->$climate_content;
            $about_armenia_content->translateOrNew($locale)->climate_content_two = $request->$climate_content_two;
            $about_armenia_content->translateOrNew($locale)->winter_content = $request->$winter_content;
            $about_armenia_content->translateOrNew($locale)->spring_content = $request->$spring_content;
            $about_armenia_content->translateOrNew($locale)->summer_content = $request->$summer_content;
            $about_armenia_content->translateOrNew($locale)->autumn_content = $request->$autumn_content;
            $about_armenia_content->translateOrNew($locale)->first_reason_content = $request->$first_reason_content;
            $about_armenia_content->translateOrNew($locale)->second_reason_content = $request->$second_reason_content;
            $about_armenia_content->translateOrNew($locale)->third_reason_content = $request->$third_reason_content;
            $about_armenia_content->translateOrNew($locale)->fourth_reason_content = $request->$fourth_reason_content;
            $about_armenia_content->translateOrNew($locale)->fifth_reason_content = $request->$fifth_reason_content;
            $about_armenia_content->save();
        }
        $about_armenia_content->save();

        Session::flash('success','About Armenia page content created successfully.');
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
        $about_armenia_content=AboutArmeniaContent::find($id);
        return view('admin.about_armenia_contents.edit')->with('about_armenia_content', $about_armenia_content);
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
            'history_image' => 'image',
            'religion_image'=>'image',
        ]);
        $about_armenia_content=AboutArmeniaContent::find($id);
        if($request->hasFile('history_image'))
        {
            $oldImage = public_path("uploads/about_armenia_contents/{$about_armenia_content->history_image}");
            if (File::exists($oldImage)) {
                unlink($oldImage);
            }
            $history_image_new_name=time().$request->history_image->getClientOriginalName();
            $request->history_image->move('uploads/about_armenia_contents', $history_image_new_name);
            $history_image=resize_image('uploads/about_armenia_contents/'.$history_image_new_name,500,500);
            $history_imageName = substr($history_image_new_name,0,strpos($history_image_new_name,"."));
            unlink('uploads/about_armenia_contents/'.$history_image_new_name);
            imagepng($history_image,'uploads/about_armenia_contents/'.$history_imageName.".png");
            $about_armenia_content->history_image='uploads/about_armenia_contents/'.rawurlencode($history_imageName).".png";
        }
        if($request->hasFile('religion_image'))
        {
            $oldImage = public_path("uploads/about_armenia_contents/{$about_armenia_content->religion_image}");
            if (File::exists($oldImage)) {
                unlink($oldImage);
            }
            $religion_image_new_name=time().$request->religion_image->getClientOriginalName();
            $request->religion_image->move('uploads/about_armenia_contents', $religion_image_new_name);
            $religion_image=resize_image('uploads/about_armenia_contents/'.$religion_image_new_name,500,500);
            $religion_imageName = substr($religion_image_new_name,0,strpos($religion_image_new_name,"."));
            unlink('uploads/about_armenia_contents/'.$religion_image_new_name);
            imagepng($religion_image,'uploads/about_armenia_contents/'.$religion_imageName.".png");
            $about_armenia_content->religion_image='uploads/about_armenia_contents/'.rawurlencode($religion_imageName).".png";
        }

        foreach (array_keys(config('translatable.locales')) as $locale) {
            $history_content='history_content_'.$locale;
            $culture_content_one='culture_content_one_'.$locale;
            $culture_content_two='culture_content_two_'.$locale;
            $religion_content='religion_content_'.$locale;
            $climate_content='climate_content_'.$locale;
            $climate_content_two='climate_content_two_'.$locale;
            $winter_content='winter_content_'.$locale;
            $spring_content='spring_content_'.$locale;
            $summer_content='summer_content_'.$locale;
            $autumn_content='autumn_content_'.$locale;
            $first_reason_content='first_reason_content_'.$locale;
            $second_reason_content='second_reason_content_'.$locale;
            $third_reason_content='third_reason_content_'.$locale;
            $fourth_reason_content='fourth_reason_content_'.$locale;
            $fifth_reason_content='fifth_reason_content_'.$locale;

            $about_armenia_content->getTranslation($locale)->history_content=$request->$history_content;
            $about_armenia_content->getTranslation($locale)->culture_content_one = $request->$culture_content_one;
            $about_armenia_content->getTranslation($locale)->culture_content_two = $request->$culture_content_two;
            $about_armenia_content->getTranslation($locale)->religion_content = $request->$religion_content;
            $about_armenia_content->getTranslation($locale)->climate_content = $request->$climate_content;
            $about_armenia_content->getTranslation($locale)->climate_content_two = $request->$climate_content_two;
            $about_armenia_content->getTranslation($locale)->winter_content = $request->$winter_content;
            $about_armenia_content->getTranslation($locale)->spring_content = $request->$spring_content;
            $about_armenia_content->getTranslation($locale)->summer_content = $request->$summer_content;
            $about_armenia_content->getTranslation($locale)->autumn_content = $request->$autumn_content;
            $about_armenia_content->getTranslation($locale)->first_reason_content = $request->$first_reason_content;
            $about_armenia_content->getTranslation($locale)->second_reason_content = $request->$second_reason_content;
            $about_armenia_content->getTranslation($locale)->third_reason_content = $request->$third_reason_content;
            $about_armenia_content->getTranslation($locale)->fourth_reason_content = $request->$fourth_reason_content;
            $about_armenia_content->getTranslation($locale)->fifth_reason_content = $request->$fifth_reason_content;
            $about_armenia_content->save();
        }
        $about_armenia_content->save();
        Session::flash('success', 'About Armenia page content updated successfully');
        return redirect()->route('about_armenia_contents');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $about_armenia_content=AboutArmeniaContent::find($id);
        $about_armenia_content->delete();
        Session::flash('success','The About Armenia page content was just trashed.');
        return redirect()->back();
    }
}
