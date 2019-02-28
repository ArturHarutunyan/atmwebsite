<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
use App\HotelCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class HotelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin==1){
            return view('admin.hotels.index')->with('hotels',Hotel::withTrashed()->get());
        }
        else{
            return view('admin.hotels.index')->with('hotels',Hotel::all());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.hotels.create')->with('hotel_categories', HotelCategory::all());
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
            'is_in_yerevan' => 'required',
            'category_id'=>'required',
            'link'=>'url',
        ]);
        $data=[
            'link'=>$request->link,
            'is_in_yerevan'=>$request->is_in_yerevan,
            'category_id'=>$request->category_id
        ];

        $hotel=Hotel::create($data);

        foreach (array_keys(config('translatable.locales')) as $locale) {
            $name='name_'.$locale;
            $address='address_'.$locale;
            $description='description_'.$locale;
            $hotel->translateOrNew($locale)->name = $request->$name;
            $hotel->translateOrNew($locale)->address = $request->$address;
            $hotel->translateOrNew($locale)->description = $request->$description;
        }
        $hotel->save();
        Session::flash('success','Hotel created successfully.');
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
        $hotel=Hotel::find($id);
        return view('admin.hotels.edit')->with('hotel', $hotel)
                                        ->with('hotel_categories', HotelCategory::all());
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
            //'address' => 'required',
            'link'=>'url',
            'is_in_yerevan' => 'required',
            'category_id'=>'required'
        ]);
        $hotel=Hotel::find($id);
        $hotel->link=$request->link;
        $hotel->is_in_yerevan=$request->is_in_yerevan;
        $hotel->category_id=$request->category_id;
        $hotel->save();
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $name='name_'.$locale;
            $address='address_'.$locale;
            $description='description_'.$locale;
            $hotel->getTranslation($locale)->slug = null;
            $hotel->getTranslation($locale)->name=$request->$name;
            $hotel->getTranslation($locale)->address=$request->$address;
            $hotel->getTranslation($locale)->description=$request->$description;
            $hotel->save();
        }
        Session::flash('success', 'Hotel data updated successfully');
        return redirect()->route('hotels');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hotel=Hotel::find($id);
        $hotel->delete();
        Session::flash('success','The hotel was just trashed.');
        return redirect()->back();
    }
}
