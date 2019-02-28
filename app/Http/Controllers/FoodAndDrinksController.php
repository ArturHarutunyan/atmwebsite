<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FoodAndDrink;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class FoodAndDrinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin==1){
            return view('admin.food_and_drinks.index')->with('food_and_drinks',FoodAndDrink::withTrashed()->get());
        }
        else{
            return view('admin.food_and_drinks.index')->with('food_and_drinks',FoodAndDrink::all());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.food_and_drinks.create')->with('food_and_drinks', FoodAndDrink::all());
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
            'image' => 'image'
        ]);

        $food_and_drink=new FoodAndDrink;
        if($request->image){
            $image_new_name=time().$request->image->getClientOriginalName();
            $request->image->move('uploads/food_and_drinks',$image_new_name);
            $image=resize_image('uploads/food_and_drinks/'.$image_new_name,500,500);
            $imageName = substr($image_new_name,0,strpos($image_new_name,"."));
            unlink('uploads/food_and_drinks/'.$image_new_name);
            imagepng($image,'uploads/food_and_drinks/'.$imageName.".png");
            $food_and_drink->image='uploads/food_and_drinks/'.rawurlencode($imageName).".png";
        }
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $name='name_'.$locale;
            $description='description_'.$locale;
            $food_and_drink->translateOrNew($locale)->name = $request->$name;
            $food_and_drink->translateOrNew($locale)->description = $request->$description;
        }
        $food_and_drink->save();


        Session::flash('success','Food/Drink created successfully.');
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
        $food_and_drink=FoodAndDrink::find($id);
        return view('admin.food_and_drinks.edit')->with('food_and_drink', $food_and_drink);
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
            'image' => 'image'
        ]);
        $food_and_drink=FoodAndDrink::find($id);
        if($request->hasFile('image'))
        {
            if(is_file("uploads/food_and_drinks/{$food_and_drink->image}")) {
                $oldImage = public_path("uploads/food_and_drinks/{$food_and_drink->image}");
                if (File::exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            $image_new_name=time().$request->image->getClientOriginalName();
            $request->image->move('uploads/food_and_drinks',$image_new_name);
            $image=resize_image('uploads/food_and_drinks/'.$image_new_name,500,500);
            $imageName = substr($image_new_name,0,strpos($image_new_name,"."));
            unlink('uploads/food_and_drinks/'.$image_new_name);
            imagepng($image,'uploads/food_and_drinks/'.$imageName.".png");
            $food_and_drink->image='uploads/food_and_drinks/'.rawurlencode($imageName).".png";
        }
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $name='name_'.$locale;
            $description='description_'.$locale;
            $food_and_drink->getTranslation($locale)->name=$request->$name;
            $food_and_drink->getTranslation($locale)->description=$request->$description;
            $food_and_drink->save();
        }
        $food_and_drink->save();
        Session::flash('success', 'Food/Drink updated successfully');
        return redirect()->route('food_and_drinks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $food_and_drink=FoodAndDrink::find($id);
        $food_and_drink->delete();
        Session::flash('success','The food/drink was just trashed.');
        return redirect()->back();
    }
}
