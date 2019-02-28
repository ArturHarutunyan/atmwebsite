<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin==1){
            return view('admin.events.index')->with('events',Event::withTrashed()->get());
        }
        else{
            return view('admin.events.index')->with('events',Event::all());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.events.create')->with('events', Event::all());
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
            'image' => 'image',
            'date'=>'required'
        ]);

        $event=Event::create([
            'date'=>strtotime($request->date)
            //'image'=>'uploads/events/'.$image_new_name
        ]);
        if($request->image){
            $image_new_name=time().$request->image->getClientOriginalName();
            $request->image->move('uploads/events',$image_new_name);
            $image=resize_image('uploads/events/'.$image_new_name,500,500);
            $imageName = substr($image_new_name,0,strpos($image_new_name,"."));
            unlink('uploads/events/'.$image_new_name);
            imagepng($image,'uploads/events/'.$imageName.".png");
            $event->image='uploads/events/'.rawurlencode($imageName).".png";
        }
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $name='name_'.$locale;
            $description='description_'.$locale;
            $event->translateOrNew($locale)->name = $request->$name;
            $event->translateOrNew($locale)->description = $request->$description;
        }
        $event->save();


        Session::flash('success','Event created successfully.');
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
        $event=Event::find($id);
        return view('admin.events.edit')->with('event', $event);
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
            'image' => 'image',
            'date'=>'required'
        ]);
        $event=Event::find($id);
        if($request->hasFile('image'))
        {
            if(is_file("uploads/events/{$event->image}")) {
                $oldImage = public_path("uploads/events/{$event->image}");
                if (File::exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            $image_new_name=time().$request->image->getClientOriginalName();
            $request->image->move('uploads/events',$image_new_name);
            $image=resize_image('uploads/events/'.$image_new_name,500,500);
            $imageName = substr($image_new_name,0,strpos($image_new_name,"."));
            unlink('uploads/events/'.$image_new_name);
            imagepng($image,'uploads/events/'.$imageName.".png");
            $event->image='uploads/events/'.rawurlencode($imageName).".png";
        }
        $event->date=strtotime($request->date);
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $name='name_'.$locale;
            $description='description_'.$locale;
            $event->getTranslation($locale)->name=$request->$name;
            $event->getTranslation($locale)->description=$request->$description;
            $event->save();
        }
        $event->save();
        Session::flash('success', 'Event updated successfully');
        return redirect()->route('events');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event=Event::find($id);
        $event->delete();
        Session::flash('success','The event was just trashed.');
        return redirect()->back();
    }
}
