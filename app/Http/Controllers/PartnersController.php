<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class PartnersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin==1){
            return view('admin.partners.index')->with('partners',Partner::withTrashed()->get());
        }
        else{
            return view('admin.partners.index')->with('partners',Partner::all());
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.partners.create');
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
            'name' =>'required',
            'link'=>'required|url',
            'partner_image' => 'required'
        ]);
        $partner_image_new_name=time().$request->partner_image->getClientOriginalName();
        $request->partner_image->move('uploads/partners',$partner_image_new_name);
        //$partner_image=resize_image('uploads/partners/'.$partner_image_new_name,500,500);
        //$partner_imageName = substr($partner_image_new_name,0,strpos($partner_image_new_name,"."));
        //unlink('uploads/partners/'.$partner_image_new_name);
        //imagepng($partner_image,'uploads/partners/'.$partner_imageName.".png");
        //$partner_image->move('uploads/partners', $partner_image_new_name);
        Partner::create([
            'name'=>$request->name,
            'link'=>$request->link,
            'partner_image'=>'uploads/partners/'.rawurlencode($partner_image_new_name)
        ]);

        Session::flash('success','Partner added successfully.');
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
        $partner=Partner::find($id);
        return view('admin.partners.edit')->with('partner', $partner);
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
            'name' =>'required',
            'link'=>'required|url'/*,
            'partner_image' => 'image'*/
        ]);
        $partner=Partner::find($id);

        if($request->hasFile('partner_image'))
        {
            $oldImage = public_path("uploads/partners/{$partner->partner_image}");
            if (File::exists($oldImage)) {
                unlink($oldImage);
            }
            $partner_image_new_name=time().$request->partner_image->getClientOriginalName();
            $request->partner_image->move('uploads/partners',$partner_image_new_name);
            $partner->partner_image='uploads/partners/'.rawurlencode($partner_image_new_name);
        }
        $partner->name=$request->name;
        $partner->link=$request->link;
        $partner->save();
        Session::flash('success', 'Partner updated successfully');
        return redirect()->route('partners');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $partner=Partner::find($id);
        $partner->delete();
        Session::flash('success','The partner data was just trashed.');
        return redirect()->back();
    }
}
