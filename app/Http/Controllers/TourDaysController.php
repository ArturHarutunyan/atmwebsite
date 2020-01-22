<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tour;
use App\TourDay;
use App\TourDayImage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class TourDaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin==1){
            return view('admin.tour_days.index')->with('tour_days',TourDay::withTrashed()->get());
        }
        else{
            return view('admin.tour_days.index')->with('tour_days',TourDay::all());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tour_days.create')->with('tours', Tour::all());
    }

    /**
     * Store an image in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_image(Request $request){
        $image_raw=$request->file('file');
        $image_new_name=time().$image_raw->getClientOriginalName();
        $image_raw->move('uploads/tour_days',$image_new_name);
        $image=resize_image('uploads/tour_days/'.$image_new_name,500,500);
        $imageName = substr($image_new_name,0,strpos($image_new_name,"."));
        unlink('uploads/tour_days/'.$image_new_name);
        imagepng($image,'uploads/tour_days/'.$imageName.".png");
        return response()->json('uploads/tour_days/'.rawurlencode($imageName).'.png');
    }

    /**
     * Remove an image when clicked on a button on image from edit page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function remove_single_image($id){
        $image=TourDayImage::find($id);
        $image_name=$image->name;
        if(file_exists(public_path().'/'.$image_name)){
            unlink($image_name);
        }
        $image->delete();
        return redirect()->back();
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
            'tour_id'=>'required',
            'day_number'=>'required'
        ]);
        $tour_day=TourDay::create([
            'tour_id'=>$request->tour_id,
            'day_number'=>$request->day_number,
        ]);
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $text_content = 'text_content_' . $locale;
            if($request->$text_content) {
                $tour_day->translateOrNew($locale)->text_content = $request->$text_content;
            }
        }
        $tour_day->save();
        if($request->images_encoded){
            $images=json_decode($request->images_encoded);
            foreach ($images as $image){
                TourDayImage::create([
                   'tour_day_id'=>$tour_day->id,
                   'name'=>json_decode($image)
                ]);
            }
        }
        Session::flash('success','Tour day created successfully.');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tour_day=TourDay::find($id);
        return view('admin.tour_days.edit')->with('tour_day', $tour_day)
            ->with('tours', Tour::all());
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
            //'author' =>'required',
            //'author_image' => 'image',
            //'text_content' => 'required',
            'tour_id'=>'required',
            'day_number'=>'required'
        ]);
        $tour_day=TourDay::find($id);
        $tour_day->tour_id=$request->tour_id;
        $tour_day->day_number=$request->day_number;
        foreach (array_keys(config('translatable.locales')) as $locale) {
            if($tour_day->hasTranslation($locale)){
                $text_content='text_content_'.$locale;
                $tour_day->getTranslation($locale)->slug = null;
                $tour_day->getTranslation($locale)->text_content=$request->$text_content;
                $tour_day->save();
            }
        }
        $tour_day->save();
        if($request->images_encoded){
            $images=json_decode($request->images_encoded);
            foreach ($images as $image){
                TourDayImage::create([
                    'tour_day_id'=>$tour_day->id,
                    'name'=>json_decode($image)
                ]);
            }
        }
        Session::flash('success', 'Tour day updated successfully');
        return redirect()->route('tour_days');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tour_day=TourDay::find($id);
        $tour_day->delete();
        Session::flash('success','The tour day was just trashed.');
        return redirect()->back();
    }
}
