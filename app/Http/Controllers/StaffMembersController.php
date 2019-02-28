<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StaffMember;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class StaffMembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin==1){
            return view('admin.staff_members.index')->with('staff_members',StaffMember::withTrashed()->get());
        }
        else{
            return view('admin.staff_members.index')->with('staff_members',StaffMember::all());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.staff_members.create');
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
            'image' => 'image|required',
            /*'facebook'=>'required',
            'linkedin'=>'required'*/
        ]);
        $image_new_name=time().rawurlencode($request->image->getClientOriginalName());
        $request->image->move('uploads/staff_members',$image_new_name);
        $image=resize_image('uploads/staff_members/'.$image_new_name,500,500);
        $imageName = substr($image_new_name,0,strpos($image_new_name,"."));
        unlink('uploads/staff_members/'.$image_new_name);
        imagepng($image,'uploads/staff_members/'.$imageName.".png");
        $staff_member=StaffMember::create([
            'facebook'=>$request->facebook,
            'linkedin'=>$request->linkedin,
            'image'=>'uploads/staff_members/'.$imageName.".png"
        ]);

        foreach (array_keys(config('translatable.locales')) as $locale) {
            $name='name_'.$locale;
            $surname='surname_'.$locale;
            $position='position_'.$locale;
            $staff_member->translateOrNew($locale)->name = $request->$name;
            $staff_member->translateOrNew($locale)->surname = $request->$surname;
            $staff_member->translateOrNew($locale)->position = $request->$position;

        }
        $staff_member->save();

        Session::flash('success','Staff member created successfully.');
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
        $staff_member=StaffMember::find($id);
        return view('admin.staff_members.edit')->with('staff_member', $staff_member);
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
            /*'facebook'=>'required',
            'linkedin'=>'required'*/
        ]);
        $staff_member=StaffMember::find($id);
        if($request->hasFile('image'))
        {
            $oldImage = public_path("uploads/staff_members/{$staff_member->image}");
            if (is_file($oldImage)) {
                unlink($oldImage);
            }
            $image_new_name=time().rawurlencode($request->image->getClientOriginalName());
            $request->image->move('uploads/staff_members',$image_new_name);
            $image=resize_image('uploads/staff_members/'.$image_new_name,500,500);
            $imageName = substr($image_new_name,0,strpos($image_new_name,"."));
            unlink('uploads/staff_members/'.$image_new_name);
            imagepng($image,'uploads/staff_members/'.$imageName.".png");
            $staff_member->image='uploads/staff_members/'.$imageName.".png";
        }
        $staff_member->facebook=$request->facebook;
        $staff_member->linkedin=$request->linkedin;
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $name='name_'.$locale;
            $surname='surname_'.$locale;
            $position='position_'.$locale;
            $staff_member->getTranslation($locale)->slug = null;
            $staff_member->getTranslation($locale)->name=$request->$name;
            $staff_member->getTranslation($locale)->surname=$request->$surname;
            $staff_member->getTranslation($locale)->position=$request->$position;
            $staff_member->save();
        }
        $staff_member->save();
        Session::flash('success', 'Staff member info updated successfully');
        return redirect()->route('staff_members');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staff_member=StaffMember::find($id);
        $staff_member->delete();
        Session::flash('success','The staff member data was just trashed.');
        return redirect()->back();
    }
}
