<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServicesContent;
use App\Tour;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
class ServicesContentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.services_contents.index')->with('services_contents',ServicesContent::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.services_contents.create')->with('tours',Tour::all());
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
            'for_fit_image' => 'image|required',
            'tour_id_one' => 'required',
            'tour_id_two' => 'required'
        ]);
        $for_fit_image_new_name=time().$request->for_fit_image->getClientOriginalName();
        $request->for_fit_image->move('uploads/services_contents',$for_fit_image_new_name);
        $for_fit_image=resize_image('uploads/services_contents/'.$for_fit_image_new_name,500,500);
        $for_fit_imageName = substr($for_fit_image_new_name,0,strpos($for_fit_image_new_name,"."));
        unlink('uploads/services_contents/'.$for_fit_image_new_name);
        imagepng($for_fit_image,'uploads/services_contents/'.$for_fit_imageName.".png");
        $services_content=ServicesContent::create([
            'for_fit_image'=>'uploads/services_contents/'.rawurlencode($for_fit_imageName).".png",
            'tour_id_one'=>$request->tour_id_one,
            'tour_id_two'=>$request->tour_id_two
        ]);

        foreach (array_keys(config('translatable.locales')) as $locale) {
            $tour_packages_content='tour_packages_content_'.$locale;
            $hotel_reservation_content='hotel_reservation_content_'.$locale;
            $choose_hotel_content='choose_hotel_content_'.$locale;
            $select_dates_content='select_dates_content_'.$locale;
            $welcome_to_armenia_content='welcome_to_armenia_content_'.$locale;
            $transport_content='transport_content_'.$locale;
            $meals_content='meals_content_'.$locale;
            $excursions_content='excursions_content_'.$locale;
            $mice_content_one='mice_content_one_'.$locale;
            $mice_content_two='mice_content_two_'.$locale;
            $translation_content='translation_content_'.$locale;
            $equipment_content='equipment_content_'.$locale;
            $for_fit_content='for_fit_content_'.$locale;
            $services_content->translateOrNew($locale)->tour_packages_content = $request->$tour_packages_content;
            $services_content->translateOrNew($locale)->hotel_reservation_content = $request->$hotel_reservation_content;
            $services_content->translateOrNew($locale)->choose_hotel_content = $request->$choose_hotel_content;
            $services_content->translateOrNew($locale)->select_dates_content = $request->$select_dates_content;
            $services_content->translateOrNew($locale)->welcome_to_armenia_content = $request->$welcome_to_armenia_content;
            $services_content->translateOrNew($locale)->transport_content = $request->$transport_content;
            $services_content->translateOrNew($locale)->meals_content = $request->$meals_content;
            $services_content->translateOrNew($locale)->excursions_content = $request->$excursions_content;
            $services_content->translateOrNew($locale)->mice_content_one = $request->$mice_content_one;
            $services_content->translateOrNew($locale)->mice_content_two = $request->$mice_content_two;
            $services_content->translateOrNew($locale)->translation_content = $request->$translation_content;
            $services_content->translateOrNew($locale)->equipment_content = $request->$equipment_content;
            $services_content->translateOrNew($locale)->for_fit_content = $request->$for_fit_content;
            $services_content->save();
        }
        $services_content->save();



        Session::flash('success','Services page content created successfully.');
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
        $services_content=ServicesContent::find($id);
        return view('admin.services_contents.edit')->with('services_content', $services_content)
                                                   ->with('tours',Tour::all());
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
            'for_fit_image' => 'image',
            'tour_id_one' => 'required',
            'tour_id_two' => 'required'
        ]);
        $services_content=ServicesContent::find($id);
        if($request->hasFile('for_fit_image'))
        {
            $oldImage = public_path("uploads/services_contents/{$services_content->for_fit_image}");
            if (is_file($oldImage)) {
                unlink($oldImage);
            }
            $for_fit_image_new_name=time().$request->for_fit_image->getClientOriginalName();
            $request->for_fit_image->move('uploads/services_contents',$for_fit_image_new_name);
            $for_fit_image=resize_image('uploads/services_contents/'.$for_fit_image_new_name,500,500);
            $for_fit_imageName = substr($for_fit_image_new_name,0,strpos($for_fit_image_new_name,"."));
            unlink('uploads/services_contents/'.$for_fit_image_new_name);
            imagepng($for_fit_image,'uploads/services_contents/'.$for_fit_imageName.".png");
            $services_content->for_fit_image='uploads/services_contents/'.rawurlencode($for_fit_imageName).".png";
        }
        $services_content->tour_id_one=$request->tour_id_one;
        $services_content->tour_id_two=$request->tour_id_two;
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $tour_packages_content='tour_packages_content_'.$locale;
            $hotel_reservation_content='hotel_reservation_content_'.$locale;
            $choose_hotel_content='choose_hotel_content_'.$locale;
            $select_dates_content='select_dates_content_'.$locale;
            $welcome_to_armenia_content='welcome_to_armenia_content_'.$locale;
            $transport_content='transport_content_'.$locale;
            $meals_content='meals_content_'.$locale;
            $excursions_content='excursions_content_'.$locale;
            $mice_content_one='mice_content_one_'.$locale;
            $mice_content_two='mice_content_two_'.$locale;
            $translation_content='translation_content_'.$locale;
            $equipment_content='equipment_content_'.$locale;
            $for_fit_content='for_fit_content_'.$locale;

            $services_content->getTranslation($locale)->tour_packages_content=$request->$tour_packages_content;
            $services_content->getTranslation($locale)->hotel_reservation_content = $request->$hotel_reservation_content;
            $services_content->getTranslation($locale)->choose_hotel_content = $request->$choose_hotel_content;
            $services_content->getTranslation($locale)->select_dates_content = $request->$select_dates_content;
            $services_content->getTranslation($locale)->welcome_to_armenia_content = $request->$welcome_to_armenia_content;
            $services_content->getTranslation($locale)->transport_content = $request->$transport_content;
            $services_content->getTranslation($locale)->meals_content = $request->$meals_content;
            $services_content->getTranslation($locale)->excursions_content = $request->$excursions_content;
            $services_content->getTranslation($locale)->mice_content_one = $request->$mice_content_one;
            $services_content->getTranslation($locale)->mice_content_two = $request->$mice_content_two;
            $services_content->getTranslation($locale)->translation_content = $request->$translation_content;
            $services_content->getTranslation($locale)->equipment_content = $request->$equipment_content;
            $services_content->getTranslation($locale)->for_fit_content = $request->$for_fit_content;
            $services_content->save();
        }
        $services_content->save();
        Session::flash('success', 'Services page content updated successfully');
        return redirect()->route('services_contents');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $services_content=ServicesContent::find($id);
        $services_content->delete();
        Session::flash('success','The Services page content was just trashed.');
        return redirect()->back();
    }
}
