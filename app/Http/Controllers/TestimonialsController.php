<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Testimonial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
class TestimonialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin==1){
            return view('admin.testimonials.index')->with('testimonials',Testimonial::withTrashed()->get());
        }
        else{
            return view('admin.testimonials.index')->with('testimonials',Testimonial::all());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonials.create');
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
            //'author' =>'required',
            'author_image' => 'image',
            //'text_content' => 'required',
            'gender'=>'required'
        ]);
        if($request->author_image){
            $author_image_new_name=time().rawurlencode($request->author_image->getClientOriginalName());
            $request->author_image->move('uploads/testimonials',$author_image_new_name);
            $author_image=resize_image('uploads/testimonials/'.$author_image_new_name,500,500);
            $author_imageName = substr($author_image_new_name,0,strpos($author_image_new_name,"."));
            unlink('uploads/testimonials/'.$author_image_new_name);
            imagepng($author_image,'uploads/testimonials/'.$author_imageName.".png");
            $testimonial=Testimonial::create([
                //'author'=>$request->author,
                //'text_content'=>$request->text_content,
                'gender'=>$request->gender,
                'author_image'=>'uploads/testimonials/'.$author_imageName.".png"
            ]);

            foreach (array_keys(config('translatable.locales')) as $locale) {
                $author='author_'.$locale;
                $text_content='text_content_'.$locale;
                $testimonial->translateOrNew($locale)->author = $request->$author;
                $testimonial->translateOrNew($locale)->text_content = $request->$text_content;

            }
            $testimonial->save();
        }
        else{
            $testimonial=Testimonial::create([
                'gender'=>$request->gender,
            ]);

            foreach (array_keys(config('translatable.locales')) as $locale) {
                $author='author_'.$locale;
                $text_content='text_content_'.$locale;
                $testimonial->translateOrNew($locale)->author = $request->$author;
                $testimonial->translateOrNew($locale)->text_content = $request->$text_content;

            }
            $testimonial->save();
        }


        Session::flash('success','Testimonial created successfully.');
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
        $testimonial=Testimonial::find($id);
        return view('admin.testimonials.edit')->with('testimonial', $testimonial);
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
            //'author' =>'required',
            'author_image' => 'image',
            //'text_content' => 'required',
            'gender'=>'required'
        ]);
        $testimonial=Testimonial::find($id);
        if($request->hasFile('author_image'))
        {
            $oldImage = public_path("uploads/testiomonials/{$testimonial->author_image}");
            if (is_file($oldImage)) {
                unlink($oldImage);
            }
            $author_image_new_name=time().rawurlencode($request->author_image->getClientOriginalName());
            $request->author_image->move('uploads/testimonials',$author_image_new_name);
            $author_image=resize_image('uploads/testimonials/'.$author_image_new_name,500,500);
            $author_imageName = substr($author_image_new_name,0,strpos($author_image_new_name,"."));
            unlink('uploads/testimonials/'.$author_image_new_name);
            imagepng($author_image,'uploads/testimonials/'.$author_imageName.".png");
            $testimonial->author_image='uploads/testimonials/'.$author_imageName.".png";
        }
        $testimonial->gender=$request->gender;
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $author='author_'.$locale;
            $text_content='text_content_'.$locale;
            //$testimonial->getTranslation($locale)->slug = null;
            $testimonial->getTranslation($locale)->author=$request->$author;
            $testimonial->getTranslation($locale)->text_content=$request->$text_content;
            $testimonial->save();
        }
        $testimonial->save();
        Session::flash('success', 'Testimonial updated successfully');
        return redirect()->route('testimonials');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $testimonial=Testimonial::find($id);
        $testimonial->delete();
        Session::flash('success','The testimonial was just trashed.');
        return redirect()->back();
    }
}
