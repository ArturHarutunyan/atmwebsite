<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use App\Partner;
use App\CustomMetaTag;
use App\PageName;
use MetaTag;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin==1){
            return view('admin.photos.index')->with('photos',Photo::withTrashed()->get());
        }
        else{
            return view('admin.photos.index')->with('photos',Photo::all());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.photos.create');
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
        $photo=new Photo;
        if($request->image){
            $image_new_name=time().$request->image->getClientOriginalName();
            $request->image->move('uploads/photos',$image_new_name);
            $image=resize_image('uploads/photos/'.$image_new_name,500,500);
            $imageName = substr($image_new_name,0,strpos($image_new_name,"."));
            unlink('uploads/photos/'.$image_new_name);
            imagepng($image,'uploads/photos/'.$imageName.".png");
            $photo->image='uploads/photos/'.rawurlencode($imageName).".png";
        }
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $title='title_'.$locale;
            if($request->$title) {
                $photo->translateOrNew($locale)->title = $request->$title;
            }
        }
        $photo->save();

        Session::flash('success','Photo created successfully.');
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
        $photo=Photo::find($id);
        return view('admin.photos.edit')->with('photo', $photo);
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
        $photo=Photo::find($id);
        if($request->hasFile('image'))
        {
            if(is_file("uploads/photos/{$photo->image}")) {
                $oldImage = public_path("uploads/photos/{$photo->image}");
                if (File::exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            $image_new_name=time().$request->image->getClientOriginalName();
            $request->image->move('uploads/photos',$image_new_name);
            $image=resize_image('uploads/photos/'.$image_new_name,500,500);
            $imageName = substr($image_new_name,0,strpos($image_new_name,"."));
            unlink('uploads/photos/'.$image_new_name);
            imagepng($image,'uploads/photos/'.$imageName.".png");
            $photo->image='uploads/photos/'.rawurlencode($imageName).".png";
        }
        foreach (array_keys(config('translatable.locales')) as $locale) {
            if($photo->hasTranslation($locale)) {
                $title = 'title_' . $locale;
                $photo->getTranslation($locale)->slug = null;
                $photo->getTranslation($locale)->title = $request->$title;
                $photo->save();
            }
        }
        $photo->save();
        Session::flash('success', 'Photo updated successfully');
        return redirect()->route('photos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo=Photo::find($id);
        $photo->delete();
        Session::flash('success','The photo was just trashed.');
        return redirect()->back();
    }
}
