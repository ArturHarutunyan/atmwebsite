<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\Partner;
use App\CustomMetaTag;
use App\PageName;
use MetaTag;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin==1){
            return view('admin.videos.index')->with('videos',Video::withTrashed()->get());
        }
        else{
            return view('admin.videos.index')->with('videos',Video::all());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.videos.create');
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
            'image' => 'image',
        ]);
        $video=new Video;
        if($request->image){
            $image_new_name=time().$request->image->getClientOriginalName();
            $request->image->move('uploads/videos',$image_new_name);
            $image=resize_image('uploads/videos/'.$image_new_name,500,500);
            $imageName = substr($image_new_name,0,strpos($image_new_name,"."));
            unlink('uploads/videos/'.$image_new_name);
            imagepng($image,'uploads/videos/'.$imageName.".png");
            $video->image='uploads/videos/'.rawurlencode($imageName).".png";
        }
        if($request->video){
            $video_new_name=time().$request->video->getClientOriginalName();
            $request->video->move('uploads/videos',$video_new_name);
        }
        $video->source_code=$request->source_code;
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $title='title_'.$locale;
            if($request->$title) {
                $video->translateOrNew($locale)->title = $request->$title;
            }
        }
        $video->save();

        Session::flash('success','Video created successfully.');
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
        $video=Video::find($id);
        return view('admin.videos.edit')->with('video', $video);
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
            'image' => 'image'
        ]);
        $video=Video::find($id);
        if($request->hasFile('image'))
        {
            if(is_file("uploads/videos/{$video->image}")) {
                $oldImage = public_path("uploads/videos/{$video->image}");
                if (File::exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            $image_new_name=time().$request->image->getClientOriginalName();
            $request->image->move('uploads/videos',$image_new_name);
            $image=resize_image('uploads/videos/'.$image_new_name,500,500);
            $imageName = substr($image_new_name,0,strpos($image_new_name,"."));
            unlink('uploads/videos/'.$image_new_name);
            imagepng($image,'uploads/videos/'.$imageName.".png");
            $video->image='uploads/videos/'.rawurlencode($imageName).".png";
        }
        if($request->hasFile('video'))
        {
            $oldVideo = public_path("uploads/videos/{$video->video}");
            if (File::exists($oldVideo)) {
                unlink($oldVideo);
            }
            $video_new_name=time().$request->video->getClientOriginalName();
            $request->video->move('uploads/videos',$video_new_name);
            $video->video='uploads/videos/'.rawurlencode($video_new_name);
        }
        $video->source_code=$request->source_code;
        foreach (array_keys(config('translatable.locales')) as $locale) {
            if($video->hasTranslation($locale)) {
                $title='title_'.$locale;
                $video->getTranslation($locale)->slug = null;
                $video->getTranslation($locale)->title=$request->$title;
                $video->save();
            }
        }
        $video->save();
        Session::flash('success', 'Video updated successfully');
        return redirect()->route('videos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video=Video::find($id);
        $video->delete();
        Session::flash('success','The video was just trashed.');
        return redirect()->back();
    }
}
