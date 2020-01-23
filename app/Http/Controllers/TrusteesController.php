<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trustee;
use App\Partner;
use App\CustomMetaTag;
use App\PageName;
use MetaTag;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class TrusteesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin==1){
            return view('admin.trustees.index')->with('trustees',Trustee::withTrashed()->get());
        }
        else{
            return view('admin.trustees.index')->with('trustees',Trustee::all());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.trustees.create');
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

        $trustee=new Trustee;
        if($request->image){
            $image_new_name=time().$request->image->getClientOriginalName();
            $request->image->move('uploads/trustees',$image_new_name);
            $image=resize_image('uploads/trustees/'.$image_new_name,500,500);
            $imageName = substr($image_new_name,0,strpos($image_new_name,"."));
            unlink('uploads/trustees/'.$image_new_name);
            imagepng($image,'uploads/trustees/'.$imageName.".png");
            $trustee->image='uploads/trustees/'.rawurlencode($imageName).".png";
        }
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $title='title_'.$locale;
            if($request->$title) {
                $text_content = 'text_content_' . $locale;
                $trustee->translateOrNew($locale)->title = $request->$title;
                $trustee->translateOrNew($locale)->text_content = $request->$text_content;
            }
        }
        $trustee->save();

        Session::flash('success','Trustee created successfully.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $trustee=Trustee::whereTranslation('slug', $slug)->firstOrFail();
        $page_names=PageName::all();

        return view('trustee_inner')->with('trustee',$trustee)
            ->with('partners', Partner::all())
            ->with('custom_meta_tags', CustomMetaTag::whereHas('page_names', function($q) use($page_names) {
                $q->whereIn('name', ['trustee_inner']);
            })->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trustee=Trustee::find($id);
        return view('admin.trustees.edit')->with('trustee', $trustee);
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
        $trustee=Trustee::find($id);
        if($request->hasFile('image'))
        {
            if(is_file("uploads/trustees/{$trustee->image}")) {
                $oldImage = public_path("uploads/trustees/{$trustee->image}");
                if (File::exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            $image_new_name=time().$request->image->getClientOriginalName();
            $request->image->move('uploads/trustees',$image_new_name);
            $image=resize_image('uploads/trustees/'.$image_new_name,500,500);
            $imageName = substr($image_new_name,0,strpos($image_new_name,"."));
            unlink('uploads/trustees/'.$image_new_name);
            imagepng($image,'uploads/trustees/'.$imageName.".png");
            $trustee->image='uploads/trustees/'.rawurlencode($imageName).".png";
        }
        foreach (array_keys(config('translatable.locales')) as $locale) {
            if($trustee->hasTranslation($locale)) {
                $title = 'title_' . $locale;
                $text_content = 'text_content_' . $locale;
                $trustee->getTranslation($locale)->slug = null;
                $trustee->getTranslation($locale)->title = $request->$title;
                $trustee->getTranslation($locale)->text_content = $request->$text_content;
                $trustee->save();
            }
        }
        $trustee->save();
        Session::flash('success', 'Trustee data updated successfully');
        return redirect()->route('trustees');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trustee=Trustee::find($id);
        $trustee->delete();
        Session::flash('success','The trustee data was just trashed.');
        return redirect()->back();
    }
}
