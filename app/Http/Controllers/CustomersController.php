<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Customer;
use App\Car;
use App\FuelType;
use App\Price;
use App\CarImage;
use App\Route;
use App\CarMake;
use App\CarModel;

class CustomersController extends Controller
{
    public function save(Request $request){
        //var_dump($request->get('partnerInfo["legal_name"]'));
        //return;
        //var_dump($request->input('images_0'));
        //dd($request->file('images_0'));
        //return response()->json($request->file('images'));
        $formObj=json_decode($request->formObject);

        /*$this->validate($formObj, [
            'legal_name'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'tin' => 'required'
        ]);*/
        $customer_data=$formObj->partnerInfo;
        $customer=Customer::create([
            'legal_name'=>$customer_data->legal_name,
            'phone'=>$customer_data->phone_number,
            'email'=>$customer_data->Email,
            'tin'=>$customer_data->AVC,
            'notes'=>$customer_data->notes
        ]);
        $prices_data=$formObj->prices;
        foreach($prices_data as $price_data){
            $price=Price::create([
                'customer_id'=>$customer->id,
                'per_km'=>$price_data->pricesForm[0]->value||"",
                'per_km_driver'=>$price_data->pricesForm[1]->value||""
            ]);
            foreach($price_data->assocPrices as $route_key=>$route_price){
                if($route_key>1){
                    // minus two because the first 2 indexes belong to price_per_km & price_per_km_driver respectively
                    DB::table('price_route')->insert([
                        'price_id'=> $price->id,
                        'route_id'=> $formObj->prices->routes[$route_key-2]->index-2,
                        'amount'=> floatval(preg_replace("/,/","",$formObj->prices->routes[$route_key-2]->amount))
                    ]);
                }
            }
            foreach($price_data->cars as $c_i=>$price_car_key){
                 $carData=$formObj->cars[$price_car_key];
                 $car=Car::create([
                     'price_id'=>$price->id,
                     'make'=>$carData->inputs[0]->value,
                     'model'=>$carData->inputs[1]->value,
                     'color'=>$carData->inputs[2]->value,
                     'year'=>intval($carData->inputs[3]->value),
                     'seat_count'=>intval($carData->inputs[4]->value),
                     'quality'=>$carData->inputs[5]->value,
                     'is_leather'=>$carData->seats[0]->value,
                     'is_foldable'=>$carData->seats[1]->value,
                     'has_air_conditioning'=>$carData->seats[2]->value,
                     'fuel_type_id'=>intval($carData->fuelType->value),
                     'volume'=>floatval($carData->working_volume)
                 ]);
                 ///////IMAGES///////////////////////////////
                 /*foreach ($formObj->fd->input("images_{$c_i}") as $car_image){

                     $image_new_name=time().$car_image->getClientOriginalName();
                     $request->image->move('uploads/cars',$image_new_name);
                     $image=resize_image('uploads/cars/'.$image_new_name,500,500);
                     $imageName = substr($image_new_name,0,strpos($image_new_name,"."));
                     unlink('uploads/cars/'.$image_new_name);
                     imagepng($image,'uploads/cars/'.$imageName.".png");
                     //file_put_contents('uploads/cars/'.$image_new_name,base64_encode("blob:http://localhost:8000/a82b226c-c400-44f8-a2bf-5c6adaba2014"));
                     CarImage::create([
                         'car_id'=>$car->id,
                         'name'=>'uploads/cars/'.rawurlencode($imageName).".png"
                     ]);
                 }*/
            }
        }
        return response()->json(1);
        //Session::flash('success','Currency added successfully.');
        //return redirect()->back();
    }

    public function get_car_makes(){
        $makes=CarMake::all();
        return response()->json($makes);
    }

    public function get_car_models($id){
        $models=CarModel::where('make_id',$id);
        return response()->json($models);
    }

    public function get_routes(){
        $routes=Route::all();
        return response()->json($routes);
    }
}
