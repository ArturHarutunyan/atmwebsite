<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomMetaTag;
use App\News;
use App\Photo;
use App\Video;
use App\Blog;
use App\Partner;
use App\Testimonial;
use App\PageName;
use App\Trustee;
use App\Certificate;
use MetaTag;

class WebsiteNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_names=PageName::all();
        return view('news')->with('news', News::orderBy('id', 'desc')->get())
            ->with('blogs', Blog::orderBy('id','desc')->get())
            ->with('testimonials', Testimonial::orderBy('id','desc')->get())
            ->with('certificates', Certificate::orderBy('id','desc')->get())
            ->with('trustees', Trustee::orderBy('id','desc')->get())
            ->with('photos', Photo::orderBy('id','desc')->get())
            ->with('videos', Video::orderBy('id','desc')->get())
            ->with('partners', Partner::all())
            ->with('custom_meta_tags', CustomMetaTag::whereHas('page_names', function($q) use($page_names) {
                $q->whereIn('name', ['news']);
            })->get());
    }
}
