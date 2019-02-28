<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entertainment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
class EntertainmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin==1){
            return view('admin.entertainments.index')->with('entertainments',Entertainment::withTrashed()->get());
        }
        else{
            return view('admin.entertainments.index')->with('entertainments',Entertainment::all());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.entertainments.create');
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
        $entertainment=new Entertainment();
        if($request->image){
            $image_new_name=time().$request->image->getClientOriginalName();
            $request->image->move('uploads/entertainments',$image_new_name);
            $image=resize_image('uploads/entertainments/'.$image_new_name,500,500);
            $imageName = substr($image_new_name,0,strpos($image_new_name,"."));
            unlink('uploads/entertainments/'.$image_new_name);
            imagepng($image,'uploads/entertainments/'.$imageName.".png");
            $entertainment->image='uploads/entertainments/'.rawurlencode($imageName).".png";
        }
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $name='name_'.$locale;
            $description='description_'.$locale;
            $entertainment->translateOrNew($locale)->name = $request->$name;
            $entertainment->translateOrNew($locale)->description = $request->$description;
        }
        $entertainment->save();

        Session::flash('success','Entertainment created successfully.');
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
        $entertainment=Entertainment::find($id);
        return view('admin.entertainments.edit')->with('entertainment', $entertainment);
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
        $entertainment=Entertainment::find($id);
        if($request->hasFile('image'))
        {
            $oldImage = public_path("uploads/entertainments/{$entertainment->image}");
            if (is_file($oldImage)) {
                unlink($oldImage);
            }
            $image_new_name=time().$request->image->getClientOriginalName();
            $request->image->move('uploads/entertainments',$image_new_name);
            $image=resize_image('uploads/entertainments/'.$image_new_name,500,500);
            $imageName = substr($image_new_name,0,strpos($image_new_name,"."));
            unlink('uploads/entertainments/'.$image_new_name);
            imagepng($image,'uploads/entertainments/'.$imageName.".png");
            $entertainment->image='uploads/entertainments/'.rawurlencode($imageName).".png";
        }
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $name='name_'.$locale;
            $description='description_'.$locale;
            $entertainment->getTranslation($locale)->slug = null;
            $entertainment->getTranslation($locale)->name=$request->$name;
            $entertainment->getTranslation($locale)->description=$request->$description;
            $entertainment->save();
        }
        $entertainment->save();
        Session::flash('success', 'Entertainment updated successfully');
        return redirect()->route('entertainments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $entertainment=Entertainment::find($id);
        $entertainment->delete();
        Session::flash('success','The entertainment was just trashed.');
        return redirect()->back();
    }
}
