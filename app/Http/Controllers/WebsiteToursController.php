<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tour;
use App\Partner;
use App\TourPeriod;
use App\TourSeason;
use App\TourGroupSize;
use App\HotelCategory;
use App\CustomMetaTag;
use App\TourType;
use App\PageName;
use MetaTag;

class WebsiteToursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_names=PageName::all();
        return view('tours')->with('tours', Tour::orderBy('id', 'desc')->get())
                                    ->with('partners', Partner::all())
                                    ->with('tour_periods', TourPeriod::all())
                                    ->with('tour_seasons', TourSeason::all())
                                    ->with('tour_group_sizes', TourGroupSize::all())
                                    ->with('hotel_categories', HotelCategory::all())
                                    ->with('tour_types', TourType::all())
                                    ->with('custom_meta_tags', CustomMetaTag::whereHas('page_names', function($q) use($page_names) {
                                        $q->whereIn('name', ['tours']);
                                    })->get());
    }

    public function your_own_tour(){
        $page_names=PageName::all();
        return view('your_own_tour')->with('custom_meta_tags', CustomMetaTag::whereHas('page_names', function($q) use($page_names) {
                                          $q->whereIn('name', ['your_own_tour']);
                                      })->get())
                                    ->with('partners', Partner::all())
                                    ->with('tour_types', TourType::all());
    }
}
