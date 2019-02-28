<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SightseeingType;
use App\SightseeingPlace;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class SightseeingPlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin==1){
            return view('admin.sightseeing_places.index')->with('sightseeing_places',SightseeingPlace::withTrashed()->get());
        }
        else{
            return view('admin.sightseeing_places.index')->with('sightseeing_places',SightseeingPlace::all());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sightseeing_places.create')->with('sightseeing_types', SightseeingType::all());
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
            'image'=>'image',
            'sightseeing_type_id'=>'required',
        ]);


        $sightseeing_place=SightseeingPlace::create([
            'sightseeing_type_id'=>$request->sightseeing_type_id
            //'image'=>'uploads/sightseeing_places/'.$image_new_name
        ]);
        if($request->image) {
            $image_new_name=time().$request->image->getClientOriginalName();
            $request->image->move('uploads/sightseeing_places',$image_new_name);
            $image=resize_image('uploads/sightseeing_places/'.$image_new_name,500,500);
            $imageName = substr($image_new_name,0,strpos($image_new_name,"."));
            unlink('uploads/sightseeing_places/'.$image_new_name);
            imagepng($image,'uploads/sightseeing_places/'.$imageName.".png");
            $sightseeing_place->image='uploads/sightseeing_places/'.rawurlencode($imageName).".png";
        }
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $description='description_'.$locale;
            $name='name_'.$locale;
            $sightseeing_place->translateOrNew($locale)->description = $request->$description;
            $sightseeing_place->translateOrNew($locale)->name = $request->$name;
        }
        $sightseeing_place->save();

        Session::flash('success','Sightseeing place created successfully.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sightseeing_place=SightseeingPlace::find($id);
        return view('admin.sightseeing_places.edit')->with('sightseeing_place', $sightseeing_place)
            ->with('sightseeing_types', SightseeingType::all());
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
            'sightseeing_type_id'=>'required',
            'image' => 'image'
        ]);
        $sightseeing_place=SightseeingPlace::find($id);
        if($request->hasFile('image'))
        {
            if(is_file("uploads/sightseeing_places/{$sightseeing_place->image}")) {
                $oldImage = public_path("uploads/sightseeing_places/{$sightseeing_place->image}");
                if (File::exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            $image_new_name=time().$request->image->getClientOriginalName();
            $request->image->move('uploads/sightseeing_places',$image_new_name);
            $image=resize_image('uploads/sightseeing_places/'.$image_new_name,500,500);
            $imageName = substr($image_new_name,0,strpos($image_new_name,"."));
            unlink('uploads/sightseeing_places/'.$image_new_name);
            imagepng($image,'uploads/sightseeing_places/'.$imageName.".png");
            $sightseeing_place->image='uploads/sightseeing_places/'.rawurlencode($imageName).".png";
        }
        $sightseeing_place->sightseeing_type_id=$request->sightseeing_type_id;
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $name='name_'.$locale;
            $description='description_'.$locale;
            $sightseeing_place->getTranslation($locale)->slug = null;
            $sightseeing_place->getTranslation($locale)->name=$request->$name;
            $sightseeing_place->getTranslation($locale)->description=$request->$description;
            $sightseeing_place->save();
        }
        $sightseeing_place->save();
        Session::flash('success', 'Sightseeing place updated successfully');
        return redirect()->route('sightseeing_places');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sightseeing_place=SightseeingPlace::find($id);
        $sightseeing_place->delete();
        Session::flash('success','The sightseeing place was just trashed.');
        return redirect()->back();
    }
}
