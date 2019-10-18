<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Customer;
use App\Car;
use App\AdditionalService;
use App\Price;
use App\CarImage;
use App\Route;
use App\CarMake;
use App\CarModel;
use App\CustomRoute;

class CustomersController extends Controller
{
    public function save(Request $request)
    {
        $formObj = json_decode($request->input('formObject'));
        $customer_data = $formObj->partnerInfo;
        $customer = Customer::create([
            'legal_name' => $customer_data->legal_name,
            'phone' => $customer_data->phone_number,
            'email' => $customer_data->Email,
            'tin' => $customer_data->AVC,
            'notes' => $customer_data->notes,
            'name' => $customer_data->name,
            'legal_address' => $customer_data->legal_address,
            'business_address' => $customer_data->business_address,
            'directors_name' => $customer_data->directors_name
        ]);
        $prices_data = $formObj->prices;
        foreach ($prices_data as $price_data) {
            $price = Price::create([
                'customer_id' => $customer->id,
                'per_km' => floatval(preg_replace("/,/", "", $price_data->pricesForm[0]->value)) || "",
                'per_km_driver' => floatval(preg_replace("/,/", "", $price_data->pricesForm[1]->value)) || "",
            ]);
            foreach ($price_data->routes as $route_key => $route) {
                if (is_int($route->value)) {
                    // minus two because the first 2 indexes belong to price_per_km & price_per_km_driver respectively
                    DB::table('price_route')->insert([
                        'price_id' => $price->id,
                        'route_id' => $route->value,
                        'amount' => floatval(preg_replace("/,/", "", $route->price))
                    ]);
                }
                else {
                    CustomRoute::create([
                        'price_id' => $price->id,
                        'name' => $route->value,
                        'amount' => floatval(preg_replace("/,/", "", $route->price))
                    ]);
                }
            }
            foreach ($price_data->cars as $c_i => $price_car_key) {
                $carData = $formObj->cars[$price_car_key];

                $make = $carData->inputs[0]->value;
                $make_id = $make;
                if(!is_numeric($make)){
                    $new_make=CarMake::create([
                        'name' => substr($make, 1),
                        'is_featured' => 0,
                        'is_custom' => 1
                    ]);
                    $make_id = $new_make->id;
                }

                $model= $carData->inputs[1]->value;
                $model_id = $model;
                if(!is_numeric($model)){
                    $new_model=CarModel::create([
                        'make_id' => $make_id,
                        'name' => substr($model, 1),
                        'is_custom' => 1
                    ]);
                    $model_id = $new_model->id;
                }

                $car = Car::create([
                    'price_id' => $price->id,
                    'model_id' => $model_id,
                    'color' => $carData->inputs[2]->value,
                    'year' => intval($carData->inputs[3]->value),
                    'seat_count' => intval($carData->inputs[4]->value),
                    'baggage_quantity' => intval($carData->inputs[5]->value),
                    'is_leather' => $carData->seats[0]->value,
                    'is_foldable' => $carData->seats[1]->value,
                    'has_air_conditioning' => $carData->seats[2]->value,
                    'has_monitor' => $carData->seats[3]->value,
                    'fuel_type_id' => intval($carData->fuelType->value),
                    'volume' => floatval($carData->working_volume)
                ]);

                foreach ($request->file("images_{$c_i}") as $car_image) {
                    $image_new_name = time() . $car_image->getClientOriginalName();
                    $car_image->move('uploads/cars', $image_new_name);
                    $image = resize_image('uploads/cars/' . $image_new_name, 500, 500);
                    $imageName = substr($image_new_name, 0, strpos($image_new_name, "."));
                    unlink('uploads/cars/' . $image_new_name);
                    imagepng($image, 'uploads/cars/' . $imageName . ".png");

                    CarImage::create([
                        'car_id' => $car->id,
                        'name' => 'uploads/cars/' . rawurlencode($imageName) . ".png"
                    ]);
                }
                foreach ($carData->services as $service){
                    AdditionalService::create([
                        'car_id' => $car->id,
                        'name' => $service->value
                    ]);
                }

            }
        }
        return response()->json(1);

    }

    public function get_makes()
    {
        $makes = CarMake::all();
        return response()->json($makes);
    }

    public function get_models($id)
    {
        $models = CarModel::where('make_id', $id)->get();
        return response()->json($models);
    }

    public function get_routes()
    {
        $routes = Route::all();
        return response()->json($routes);
    }

    public function show(){
        return view('admin.transportation.cars_list')->with('cars',Car::all());
    }
}
