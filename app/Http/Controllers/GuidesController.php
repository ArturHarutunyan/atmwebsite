<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guide;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class GuidesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin==1){
            return view('admin.guides.index')->with('guides',Guide::withTrashed()->get());
        }
        else{
            return view('admin.guides.index')->with('guides',Guide::all());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.guides.create');
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
            'image' => 'image'
        ]);
        $image_new_name=time().$request->image->getClientOriginalName();
        $request->image->move('uploads/guides',$image_new_name);
        $image=resize_image('uploads/guides/'.$image_new_name,500,500);
        $imageName = substr($image_new_name,0,strpos($image_new_name,"."));
        unlink('uploads/guides/'.$image_new_name);
        imagepng($image,'uploads/guides/'.$imageName.".png");
        $guide=Guide::create([
            'facebook'=>$request->facebook,
            'linkedin'=>$request->linkedin,
            'image'=>'uploads/guides/'.rawurlencode($imageName).".png"
        ]);

        foreach (array_keys(config('translatable.locales')) as $locale) {
            $name='name_'.$locale;
            $surname='surname_'.$locale;
            $language='language_'.$locale;
            $guide->translateOrNew($locale)->name = $request->$name;
            $guide->translateOrNew($locale)->surname = $request->$surname;
            $guide->translateOrNew($locale)->language = $request->$language;

        }
        $guide->save();

        Session::flash('success','Guide created successfully.');
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
        $guide=Guide::find($id);
        return view('admin.guides.edit')->with('guide', $guide);

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
        $guide=Guide::find($id);
        if($request->hasFile('image'))
        {
            $oldImage = public_path("uploads/guides/{$guide->image}");
            if (is_file($oldImage)) {
                unlink($oldImage);
            }
            $image_new_name=time().$request->image->getClientOriginalName();
            $request->image->move('uploads/guides',$image_new_name);
            $image=resize_image('uploads/guides/'.$image_new_name,500,500);
            $imageName = substr($image_new_name,0,strpos($image_new_name,"."));
            unlink('uploads/guides/'.$image_new_name);
            imagepng($image,'uploads/guides/'.$imageName.".png");
            $guide->image='uploads/guides/'.rawurlencode($imageName).".png";
        }
        $guide->facebook=$request->facebook;
        $guide->linkedin=$request->linkedin;
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $name='name_'.$locale;
            $surname='surname_'.$locale;
            $language='language_'.$locale;
            $guide->getTranslation($locale)->name=$request->$name;
            $guide->getTranslation($locale)->surname=$request->$surname;
            $guide->getTranslation($locale)->language=$request->$language;
            $guide->save();
        }
        $guide->save();
        Session::flash('success', 'Guide info updated successfully');
        return redirect()->route('guides');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guide=Guide::find($id);
        $guide->delete();
        Session::flash('success','The guide data was just trashed.');
        return redirect()->back();
    }
}
