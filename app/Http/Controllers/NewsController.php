<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Partner;
use App\CustomMetaTag;
use App\PageName;
use MetaTag;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin==1){
            return view('admin.news.index')->with('news',News::withTrashed()->get());
        }
        else{
            return view('admin.news.index')->with('news',News::all());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create')->with('news', News::all());
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

        $news=new News;
        if($request->image){
            $image_new_name=time().$request->image->getClientOriginalName();
            $request->image->move('uploads/news',$image_new_name);
            $image=resize_image('uploads/news/'.$image_new_name,500,500);
            $imageName = substr($image_new_name,0,strpos($image_new_name,"."));
            unlink('uploads/news/'.$image_new_name);
            imagepng($image,'uploads/news/'.$imageName.".png");
            $news->image='uploads/news/'.rawurlencode($imageName).".png";
        }
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $title='title_'.$locale;
            if($request->$title) {
                $text_content = 'text_content_' . $locale;
                $news->translateOrNew($locale)->title = $request->$title;
                $news->translateOrNew($locale)->text_content = $request->$text_content;
            }
        }
        $news->save();

        Session::flash('success','News created successfully.');
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
        //$news=News::find($id);
        $news=News::whereTranslation('slug', $slug)->firstOrFail();
        $page_names=PageName::all();

        return view('news_inner')->with('news',$news)
            ->with('partners', Partner::all())
            ->with('custom_meta_tags', CustomMetaTag::whereHas('page_names', function($q) use($page_names) {
                $q->whereIn('name', ['news_inner']);
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
        $news=News::find($id);
        return view('admin.news.edit')->with('news', $news);
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
        $news=News::find($id);
        if($request->hasFile('image'))
        {
            if(is_file("uploads/news/{$news->image}")) {
                $oldImage = public_path("uploads/news/{$news->image}");
                if (File::exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            $image_new_name=time().$request->image->getClientOriginalName();
            $request->image->move('uploads/news',$image_new_name);
            $image=resize_image('uploads/news/'.$image_new_name,500,500);
            $imageName = substr($image_new_name,0,strpos($image_new_name,"."));
            unlink('uploads/news/'.$image_new_name);
            imagepng($image,'uploads/news/'.$imageName.".png");
            $news->image='uploads/news/'.rawurlencode($imageName).".png";
        }
        foreach (array_keys(config('translatable.locales')) as $locale) {
            if($news->hasTranslation($locale)) {
                $title = 'title_' . $locale;
                $text_content = 'text_content_' . $locale;
                $news->getTranslation($locale)->slug = null;
                $news->getTranslation($locale)->title = $request->$title;
                $news->getTranslation($locale)->text_content = $request->$text_content;
                $news->save();
            }
        }
        $news->save();
        Session::flash('success', 'News updated successfully');
        return redirect()->route('news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news=News::find($id);
        $news->delete();
        Session::flash('success','The news was just trashed.');
        return redirect()->back();
    }
}
