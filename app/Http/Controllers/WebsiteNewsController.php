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
use App;
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
        return view('news')->with('news', News::translatedIn(App::getLocale())->orderBy('id', 'desc')->get())
            ->with('blogs', Blog::translatedIn(App::getLocale())->orderBy('id','desc')->get())
            ->with('testimonials', Testimonial::translatedIn(App::getLocale())->orderBy('id','desc')->get())
            ->with('certificates', Certificate::translatedIn(App::getLocale())->orderBy('id','desc')->get())
            ->with('trustees', Trustee::translatedIn(App::getLocale())->orderBy('id','desc')->get())
            ->with('photos', Photo::translatedIn(App::getLocale())->orderBy('id','desc')->get())
            ->with('videos', Video::translatedIn(App::getLocale())->orderBy('id','desc')->get())
            ->with('partners', Partner::all())
            ->with('custom_meta_tags', CustomMetaTag::whereHas('page_names', function($q) use($page_names) {
                $q->whereIn('name', ['news']);
            })->get());
    }
}
