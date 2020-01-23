<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Certificate;
use App\Partner;
use App\CustomMetaTag;
use App\PageName;
use MetaTag;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CertificatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin==1){
            return view('admin.certificates.index')->with('certificates',Certificate::withTrashed()->get());
        }
        else{
            return view('admin.certificates.index')->with('certificates',Certificate::all());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.certificates.create');
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

        $certificate=new Certificate;
        if($request->image){
            $image_new_name=time().$request->image->getClientOriginalName();
            $request->image->move('uploads/certificates',$image_new_name);
            $image=resize_image('uploads/certificates/'.$image_new_name,500,500);
            $imageName = substr($image_new_name,0,strpos($image_new_name,"."));
            unlink('uploads/certificates/'.$image_new_name);
            imagepng($image,'uploads/certificates/'.$imageName.".png");
            $certificate->image='uploads/certificates/'.rawurlencode($imageName).".png";
        }
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $title='title_'.$locale;
            if($request->$title) {
                $text_content = 'text_content_' . $locale;
                $certificate->translateOrNew($locale)->title = $request->$title;
                $certificate->translateOrNew($locale)->text_content = $request->$text_content;
            }
        }
        $certificate->save();

        Session::flash('success','Certificate created successfully.');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $certificate=Certificate::find($id);
        return view('admin.certificates.edit')->with('certificate', $certificate);
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
        $certificate=Certificate::find($id);
        if($request->hasFile('image'))
        {
            if(is_file("uploads/certificates/{$certificate->image}")) {
                $oldImage = public_path("uploads/certificates/{$certificate->image}");
                if (File::exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            $image_new_name=time().$request->image->getClientOriginalName();
            $request->image->move('uploads/certificates',$image_new_name);
            $image=resize_image('uploads/certificates/'.$image_new_name,500,500);
            $imageName = substr($image_new_name,0,strpos($image_new_name,"."));
            unlink('uploads/certificates/'.$image_new_name);
            imagepng($image,'uploads/certificates/'.$imageName.".png");
            $certificate->image='uploads/certificates/'.rawurlencode($imageName).".png";
        }
        foreach (array_keys(config('translatable.locales')) as $locale) {
            if($certificate->hasTranslation($locale)) {
                $title = 'title_' . $locale;
                $text_content = 'text_content_' . $locale;
                $certificate->getTranslation($locale)->slug = null;
                $certificate->getTranslation($locale)->title = $request->$title;
                $certificate->getTranslation($locale)->text_content = $request->$text_content;
                $certificate->save();
            }
        }
        $certificate->save();
        Session::flash('success', 'Certificate data updated successfully');
        return redirect()->route('certificates');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $certificate=Certificate::find($id);
        $certificate->delete();
        Session::flash('success','The certificate data was just trashed.');
        return redirect()->back();
    }
}
