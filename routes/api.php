<?php

use Illuminate\Http\Request;
use App\Tour;
use App\TourType;
use App\StaffMember;
use App\WcitExcursions;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api'], function () {
    // Fetch Tours
    Route::get('tours_site', function () {
        return Tour::with('currency', 'tour_types', 'hotel')->get();
    })->name('tours.api');
    Route::get('tour_types', function () {
        return TourType::all();
    })->name('tourtypes.api');

    Route::get('staff_members_short_list', function () {
        return StaffMember::orderBy('id', 'asc')->take(12)->get();
    })->name('staff_members_short.api');
    Route::get('staff_members_full_list', function () {
        return StaffMember::all();
    })->name('staff_members_full.api');
    Route::post('save_transportation_data', [
        'uses' => 'CustomersController@save',
        'as' => 'customer_data_save'
    ]);
    Route::get('get_routes', [
        'uses' => 'CustomersController@get_routes',
        'as' => 'get_makes'
    ]);
    Route::get('get_makes', [
        'uses' => 'CustomersController@get_makes',
        'as' => 'get_makes'
    ]);
    Route::get('get_models/{id}', [
        'uses' => 'CustomersController@get_models',
        'as' => 'get_models'
    ]);
});

Route::group(['middleware' => 'api', 'prefix' => 'meridian'], function () {
    Route::post('hotels/{ln}', [
        'uses' => 'MeridianHotelsController@index',
        'as' => 'MeridianHotels'
    ]/*function ($ln){
        MeridianHotels::with('imgs')->translatedIn($ln)->get();
    }*/);

    Route::get('excursions', function () {
        return StaffMember::all();
    });
});
Route::group(['middleware' => 'api', 'prefix' => 'wcit'], function () {
    Route::get('excursions', function () {
        return WcitExcursions::with('photos', 'includes')->get();
        //        return WcitExcursions::all();
    })->name('WCIT_excursionss.api');
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
