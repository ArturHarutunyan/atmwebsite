<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Lang;
use App;
use App\Testimonial;
use App\Partner;
use App\HomePageContent;
use App\Tour;
use App\PageName;
use App\CustomMetaTag;
use MetaTag;
class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //if (Session::has('locale')) {
        //    $locale = Session::get('locale');
        //}
        //else{
        //    $locale = 'en';
        //}
        //App::setLocale($locale);
        //config(['app.fallback_locale' => $locale]);
        $page_names=PageName::all();
        return view('website')->with('testimonials', Testimonial::all())
                                    ->with('partners', Partner::all())
                                    ->with('home_page_contents', HomePageContent::all())
                                    ->with('tours', Tour::orderBy('id', 'desc')->take(5)->get())
                                    ->with('firsttour', Tour::first())
                                    ->with('custom_meta_tags', CustomMetaTag::whereHas('page_names', function($q) use($page_names) {
                                        $q->whereIn('name', ['home']);
                                    })->get());
    }

}
