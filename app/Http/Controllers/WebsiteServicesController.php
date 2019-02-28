<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StaffMember;
use App\Hotel;
use App\ServicesContent;
use App\Partner;
use App\Project;
use App\Tour;
use App\CustomMetaTag;
use App\Guide;
use App\MealsAndCatering;
use App\PageName;
use MetaTag;

class WebsiteServicesController extends Controller
{
    public function index()
    {
        $services_content=ServicesContent::orderBy('id', 'desc')->take(1)->get();
        $page_names=PageName::all();
        return view('services')->with('partners', Partner::all())
            ->with('tour_one', Tour::find($services_content[0]->tour_id_one))
            ->with('tour_two', Tour::find($services_content[0]->tour_id_two))
            ->with('services_content',ServicesContent::orderBy('id', 'desc')->take(1)->get())
            ->with('guides', Guide::all())
            ->with('hotels', Hotel::all())
            ->with('hotels_3', Hotel::orderBy('id', 'desc')->take(3)->get())
            ->with('projects', Project::all())
            ->with('meals', MealsAndCatering::all())
            ->with('meals_3', MealsAndCatering::orderBy('id', 'desc')->take(3)->get())
            ->with('custom_meta_tags', CustomMetaTag::whereHas('page_names', function($q) use($page_names) {
                $q->whereIn('name', ['services']);
            })->get());
    }
}
