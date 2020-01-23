<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\FoodAndDrink;
use App\SightseeingType;
use App\SightseeingPlace;
use App\Entertainment;
use App\CustomMetaTag;
use App\PageName;
use App\Partner;
use App\AboutArmeniaContent;
use App\TouristInfoContent;
use App;
use MetaTag;

class WebsiteArmeniaController extends Controller
{
    public function index()
    {
        $page_names=PageName::all();
        return view('armenia')->with('events', Event::translatedIn(App::getLocale())->get())
            ->with('food_and_drinks', FoodAndDrink::translatedIn(App::getLocale())->get())
            ->with('sightseeing_types', SightseeingType::all())
            ->with('sightseeing_places', SightseeingPlace::translatedIn(App::getLocale())->get())
            ->with('entertainments', Entertainment::translatedIn(App::getLocale())->get())
            ->with('partners', Partner::all())
            ->with('tourist_info_content',TouristInfoContent::orderBy('id', 'desc')->take(1)->get())
            ->with('about_armenia_content',AboutArmeniaContent::orderBy('id', 'desc')->take(1)->get())
            ->with('custom_meta_tags', CustomMetaTag::whereHas('page_names', function($q) use($page_names) {
                $q->whereIn('name', ['armenia']);
            })->get());
    }
}
