<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomMetaTag;
use App\Partner;
use MetaTag;
use App\PageName;
use Illuminate\Support\Facades\Session;

class WebsiteContactController extends Controller
{
    public function index()
    {
        $page_names=PageName::all();
        return view('contact')->with('custom_meta_tags', CustomMetaTag::whereHas('page_names', function($q) use($page_names) {
                                      $q->whereIn('name', ['contact']);
                                  })->get())
                              ->with('partners', Partner::all());
    }

    public function index_post(Request $request)
    {
        $page_names=PageName::all();
        return view('contact')->with('custom_meta_tags', CustomMetaTag::whereHas('page_names', function($q) use($page_names) {
                                      $q->whereIn('name', ['contact']);
                                  })->get())
                                ->with('partners', Partner::all())
                                ->with('subject', $request->subject);
    }
}
