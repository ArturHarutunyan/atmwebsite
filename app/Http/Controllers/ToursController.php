<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tour;
use App\Currency;
use App\TourType;
use App\TourSeason;
use App\TourPeriod;
use App\TourGroupSize;
use App\Hotel;
use App\Partner;
use App\PageName;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\CustomMetaTag;
use MetaTag;

class ToursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin==1){
            return view('admin.tours.index')->with('tours',Tour::withTrashed()->get());
        }
        else{
            return view('admin.tours.index')->with('tours',Tour::all());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tours.create')->with('currencies', Currency::all())
                                              ->with('tour_types', TourType::all())
                                              ->with('tour_periods', TourPeriod::all())
                                              ->with('tour_seasons', TourSeason::all())
                                              ->with('tour_group_sizes', TourGroupSize::all())
                                              ->with('hotels', Hotel::all())
                                              ->with('custom_meta_tags', CustomMetaTag::where('page_name','single_tour')->get());
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
            //'name' =>'required',
            'tour_image' => 'image',
            'start_price' =>'required',
            'currency_id'=>'required',
            'season_id'=>'required',
            'period_id'=>'required',
            'group_size_id'=>'required',
            'guaranteed'=>'required',
            'days_count'=>'required',
            'nights_count'=>'required',
            'hotel_id'=>'required'
        ]);
        $tour=Tour::create([
            //'name'=>$request->name,
            'start_price'=>$request->start_price,
            'currency_id'=>$request->currency_id,
            'season_id'=>$request->season_id,
            'period_id'=>$request->period_id,
            'group_size_id'=>$request->group_size_id,
            'guaranteed'=>$request->guaranteed,
            'days_count'=>$request->days_count,
            'nights_count'=>$request->nights_count,
            'hotel_id'=>$request->hotel_id,
            //'tour_image'=>'uploads/tours/'.$tour_image_new_name
        ]);
        if($request->tour_image) {
            $tour_image_new_name=time().rawurlencode($request->tour_image->getClientOriginalName());
            $request->tour_image->move('uploads/tours',$tour_image_new_name);
            $tour_image=resize_image('uploads/tours/'.$tour_image_new_name,500,500);
            $tour_imageName = substr($tour_image_new_name,0,strpos($tour_image_new_name,"."));
            unlink('uploads/tours/'.$tour_image_new_name);
            imagepng($tour_image,'uploads/tours/'.$tour_imageName.".png");
            $tour->tour_image='uploads/tours/'.$tour_imageName.".png";
        }
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $name='name_'.$locale;
            if($request->$name) {
                $tour->translateOrNew($locale)->name = $request->$name;
            }
        }
        $tour->save();
        $tour->tour_types()->attach($request->types);

        Session::flash('success','Tour created successfully.');
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
        $page_names=PageName::all();
        $tour=Tour::whereTranslation('slug', $slug)->firstOrFail();
        return view('tour_inner')->with('tour', $tour)
            ->with('currencies', Currency::all())
            ->with('tour_types', TourType::all())
            ->with('tour_periods', TourPeriod::all())
            ->with('tour_seasons', TourSeason::all())
            ->with('tour_group_sizes', TourGroupSize::all())
            ->with('hotels', Hotel::all())
            ->with('partners', Partner::all())
            ->with('custom_meta_tags', CustomMetaTag::whereHas('page_names', function($q) use($page_names) {
                $q->whereIn('name', ['tour_inner']);
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
        $tour=Tour::find($id);
        return view('admin.tours.edit')->with('tour', $tour)
                                            ->with('currencies', Currency::all())
                                            ->with('tour_types', TourType::all())
                                            ->with('tour_periods', TourPeriod::all())
                                            ->with('tour_seasons', TourSeason::all())
                                            ->with('tour_group_sizes', TourGroupSize::all())
                                            ->with('hotels', Hotel::all());
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
            //'name' =>'required',
            'tour_image' => 'image',
            'start_price' => 'required',
            'currency_id' => 'required',
            'season_id'=>'required',
            'period_id'=>'required',
            'group_size_id'=>'required',
            'guaranteed'=>'required',
            'days_count' => 'required',
            'nights_count' => 'required',
            'hotel_id' => 'required',
            'types' => 'required',
        ]);
        $tour=Tour::find($id);
        if($request->hasFile('tour_image'))
        {
            if(is_file("uploads/tours/{$tour->tour_image}")){
                $oldImage = public_path("uploads/tours/{$tour->tour_image}");
                if (File::exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            $tour_image_new_name=time().rawurlencode($request->tour_image->getClientOriginalName());
            $request->tour_image->move('uploads/tours',$tour_image_new_name);
            $tour_image=resize_image('uploads/tours/'.$tour_image_new_name,500,500);
            $tour_imageName = substr($tour_image_new_name,0,strpos($tour_image_new_name,"."));
            unlink('uploads/tours/'.$tour_image_new_name);
            imagepng($tour_image,'uploads/tours/'.$tour_imageName.".png");
            $tour->tour_image='uploads/tours/'.$tour_imageName.".png";
        }
        $tour->tour_types()->sync($request->types);
        //$tour->name=$request->name;
        $tour->currency_id=$request->currency_id;
        $tour->season_id=$request->season_id;
        $tour->period_id=$request->period_id;
        $tour->group_size_id=$request->group_size_id;
        $tour->guaranteed=$request->guaranteed;
        $tour->start_price=$request->start_price;
        $tour->days_count=$request->days_count;
        $tour->nights_count=$request->nights_count;
        $tour->hotel_id=$request->hotel_id;
        $tour->save();
        foreach (array_keys(config('translatable.locales')) as $locale) {
            if($tour->hasTranslation($locale)) {
                $name = 'name_' . $locale;
                $tour->getTranslation($locale)->slug = null;
                $tour->getTranslation($locale)->name = $request->$name;
                $tour->save();
            }
        }
        Session::flash('success', 'Tour updated successfully');
        return redirect()->route('tours');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tour=Tour::find($id);
        $tour->delete();
        Session::flash('success','The tour was just trashed.');
        return redirect()->back();
    }
}
