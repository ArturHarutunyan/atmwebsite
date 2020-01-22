<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Partner;
use App\CustomMetaTag;
use App\PageName;
use MetaTag;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin==1){
            return view('admin.blogs.index')->with('blogs',Blog::withTrashed()->get());
        }
        else{
            return view('admin.blogs.index')->with('blogs',Blog::all());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blogs.create');
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

        $blog=new Blog;
        if($request->image){
            $image_new_name=time().$request->image->getClientOriginalName();
            $request->image->move('uploads/blogs',$image_new_name);
            $image=resize_image('uploads/blogs/'.$image_new_name,500,500);
            $imageName = substr($image_new_name,0,strpos($image_new_name,"."));
            unlink('uploads/blogs/'.$image_new_name);
            imagepng($image,'uploads/blogs/'.$imageName.".png");
            $blog->image='uploads/blogs/'.rawurlencode($imageName).".png";
        }
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $title = 'title_' . $locale;
            if($request->$title) {
                $text_content = 'text_content_' . $locale;
                $blog->translateOrNew($locale)->title = $request->$title;
                $blog->translateOrNew($locale)->text_content = $request->$text_content;
            }
        }
        $blog->save();

        Session::flash('success','Blog created successfully.');
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
        $blog=Blog::whereTranslation('slug', $slug)->firstOrFail();
        $page_names=PageName::all();

        return view('blog_inner')->with('blog',$blog)
            ->with('partners', Partner::all())
            ->with('custom_meta_tags', CustomMetaTag::whereHas('page_names', function($q) use($page_names) {
                $q->whereIn('name', ['blog_inner']);
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
        $blog=Blog::find($id);
        return view('admin.blogs.edit')->with('blog', $blog);
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
        $blog=Blog::find($id);
        if($request->hasFile('image'))
        {
            if(is_file("uploads/blogs/{$blog->image}")) {
                $oldImage = public_path("uploads/blogs/{$blog->image}");
                if (File::exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            $image_new_name=time().$request->image->getClientOriginalName();
            $request->image->move('uploads/blogs',$image_new_name);
            $image=resize_image('uploads/blogs/'.$image_new_name,500,500);
            $imageName = substr($image_new_name,0,strpos($image_new_name,"."));
            unlink('uploads/blogs/'.$image_new_name);
            imagepng($image,'uploads/blogs/'.$imageName.".png");
            $blog->image='uploads/blogs/'.rawurlencode($imageName).".png";
        }
        foreach (array_keys(config('translatable.locales')) as $locale) {
            if($blog->hasTranslation($locale)) {
                $title = 'title_' . $locale;
                $text_content = 'text_content_' . $locale;
                $blog->getTranslation($locale)->slug = null;
                $blog->getTranslation($locale)->title = $request->$title;
                $blog->getTranslation($locale)->text_content = $request->$text_content;
                $blog->save();
            }
        }
        $blog->save();
        Session::flash('success', 'Blog updated successfully');
        return redirect()->route('blogs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog=Blog::find($id);
        $blog->delete();
        Session::flash('success','The blog was just trashed.');
        return redirect()->back();
    }
}
