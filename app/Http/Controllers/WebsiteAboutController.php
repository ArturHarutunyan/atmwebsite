<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partner;
use App\StaffMember;
use App\AboutContent;
use App\Project;
use App\CustomMetaTag;
use App\PageName;
use MetaTag;

class WebsiteAboutController extends Controller
{
    public function index()
    {
        $page_names=PageName::all();
        return view('about')->with('partners', Partner::all())
                                  ->with('staff_members', StaffMember::all())
                                  ->with('about_content',AboutContent::orderBy('id', 'desc')->take(1)->get())
                                  ->with('projects', Project::all())
                                  ->with('projects_5', Project::orderBy('id','desc')->take(5)->get())
                                  ->with('custom_meta_tags', CustomMetaTag::whereHas('page_names', function($q) use($page_names) {
                                      $q->whereIn('name', ['about']);
                                  })->get());
    }
}
