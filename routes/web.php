<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix'=>'admin', 'middleware'=>'admin', 'namespace'=>'App\Http\Controllers'], function(){

    Route::get('/testimonials', [
        'uses'=>'TestimonialsController@index',
        'as'=>'testimonials'
    ]);
    Route::get('/testimonial/create', [
        'uses'=>'TestimonialsController@create',
        'as'=>'testimonial.create'
    ]);
    Route::post('/testimonial/store', [
        'uses'=>'TestimonialsController@store',
        'as'=>'testimonial.store'
    ]);
    Route::get('/testimonial/edit/{id}', [
        'uses'=>'TestimonialsController@edit',
        'as'=>'testimonial.edit'
    ]);
    Route::post('/testimonial/update/{id}', [
        'uses'=>'TestimonialsController@update',
        'as'=>'testimonial.update'
    ]);
    Route::get('/testimonial/delete/{id}', [
        'uses'=>'TestimonialsController@destroy',
        'as'=>'testimonial.delete'
    ]);

    Route::get('/partners', [
        'uses'=>'PartnersController@index',
        'as'=>'partners'
    ]);
    Route::get('/partner/create', [
        'uses'=>'PartnersController@create',
        'as'=>'partner.create'
    ]);
    Route::post('/partner/store', [
        'uses'=>'PartnersController@store',
        'as'=>'partner.store'
    ]);
    Route::get('/partner/edit/{id}', [
        'uses'=>'PartnersController@edit',
        'as'=>'partner.edit'
    ]);
    Route::post('/partner/update/{id}', [
        'uses'=>'PartnersController@update',
        'as'=>'partner.update'
    ]);
    Route::get('/partner/delete/{id}', [
        'uses'=>'PartnersController@destroy',
        'as'=>'partner.delete'
    ]);

    Route::get('/projects', [
        'uses'=>'ProjectsController@index',
        'as'=>'projects'
    ]);
    Route::get('/project/create', [
        'uses'=>'ProjectsController@create',
        'as'=>'project.create'
    ]);
    Route::post('/project/store', [
        'uses'=>'ProjectsController@store',
        'as'=>'project.store'
    ]);
    Route::get('/project/edit/{id}', [
        'uses'=>'ProjectsController@edit',
        'as'=>'project.edit'
    ]);
    Route::post('/project/update/{id}', [
        'uses'=>'ProjectsController@update',
        'as'=>'project.update'
    ]);
    Route::get('/project/delete/{id}', [
        'uses'=>'ProjectsController@destroy',
        'as'=>'project.delete'
    ]);

    Route::get('/home_page_contents', [
        'uses'=>'HomePageContentsController@index',
        'as'=>'home_page_contents'
    ]);
    Route::get('/home_page_content/edit/{id}', [
        'uses'=>'HomePageContentsController@edit',
        'as'=>'home_page_content.edit'
    ]);
    Route::post('/home_page_content/update/{id}', [
        'uses'=>'HomePageContentsController@update',
        'as'=>'home_page_content.update'
    ]);

    Route::get('/tours', [
        'uses'=>'ToursController@index',
        'as'=>'tours'
    ]);
    Route::get('/tour/create', [
        'uses'=>'ToursController@create',
        'as'=>'tour.create'
    ]);
    Route::post('/tour/store', [
        'uses'=>'ToursController@store',
        'as'=>'tour.store'
    ]);
    Route::get('/tour/edit/{id}', [
        'uses'=>'ToursController@edit',
        'as'=>'tour.edit'
    ]);

    Route::post('/tour/update/{id}', [
        'uses'=>'ToursController@update',
        'as'=>'tour.update'
    ]);
    Route::get('/tour/delete/{id}', [
        'uses'=>'ToursController@destroy',
        'as'=>'tour.delete'
    ]);

    Route::get('/currencies', [
        'uses'=>'CurrenciesController@index',
        'as'=>'currencies'
    ]);
    Route::get('/currency/create', [
        'uses'=>'CurrenciesController@create',
        'as'=>'currency.create'
    ]);
    Route::post('/currency/store', [
        'uses'=>'CurrenciesController@store',
        'as'=>'currency.store'
    ]);
    Route::get('/currency/edit/{id}', [
        'uses'=>'CurrenciesController@edit',
        'as'=>'currency.edit'
    ]);
    Route::post('/currency/update/{id}', [
        'uses'=>'CurrenciesController@update',
        'as'=>'currency.update'
    ]);
    Route::get('/currency/delete/{id}', [
        'uses'=>'CurrenciesController@destroy',
        'as'=>'currency.delete'
    ]);

    Route::get('/page_names', [
        'uses'=>'PageNamesController@index',
        'as'=>'page_names'
    ]);
    Route::get('/page_name/create', [
        'uses'=>'PageNamesController@create',
        'as'=>'page_name.create'
    ]);
    Route::post('/page_name/store', [
        'uses'=>'PageNamesController@store',
        'as'=>'page_name.store'
    ]);
    Route::get('/page_name/edit/{id}', [
        'uses'=>'PageNamesController@edit',
        'as'=>'page_name.edit'
    ]);
    Route::post('/page_name/update/{id}', [
        'uses'=>'PageNamesController@update',
        'as'=>'page_name.update'
    ]);
    Route::get('/page_name/delete/{id}', [
        'uses'=>'PageNamesController@destroy',
        'as'=>'page_name.delete'
    ]);

    Route::get('/tour_periods', [
        'uses'=>'TourPeriodsController@index',
        'as'=>'tour_periods'
    ]);
    Route::get('/tour_period/create', [
        'uses'=>'TourPeriodsController@create',
        'as'=>'tour_period.create'
    ]);
    Route::post('/tour_period/store', [
        'uses'=>'TourPeriodsController@store',
        'as'=>'tour_period.store'
    ]);
    Route::get('/tour_period/edit/{id}', [
        'uses'=>'TourPeriodsController@edit',
        'as'=>'tour_period.edit'
    ]);
    Route::post('/tour_period/update/{id}', [
        'uses'=>'TourPeriodsController@update',
        'as'=>'tour_period.update'
    ]);
    Route::get('/tour_period/delete/{id}', [
        'uses'=>'TourPeriodsController@destroy',
        'as'=>'tour_period.delete'
    ]);
    Route::get('/tour_days', [
        'uses'=>'TourDaysController@index',
        'as'=>'tour_days'
    ]);
    Route::get('/tour_day/create', [
        'uses'=>'TourDaysController@create',
        'as'=>'tour_day.create'
    ]);
    Route::post('/tour_day/store', [
        'uses'=>'TourDaysController@store',
        'as'=>'tour_day.store'
    ]);
    Route::get('/tour_day/edit/{id}', [
        'uses'=>'TourDaysController@edit',
        'as'=>'tour_day.edit'
    ]);
    Route::post('/tour_day/update/{id}', [
        'uses'=>'TourDaysController@update',
        'as'=>'tour_day.update'
    ]);
    Route::get('/tour_day/delete/{id}', [
        'uses'=>'TourDaysController@destroy',
        'as'=>'tour_day.delete'
    ]);
    Route::get('/tour_seasons', [
        'uses'=>'TourSeasonsController@index',
        'as'=>'tour_seasons'
    ]);
    Route::get('/tour_season/create', [
        'uses'=>'TourSeasonsController@create',
        'as'=>'tour_season.create'
    ]);
    Route::post('/tour_season/store', [
        'uses'=>'TourSeasonsController@store',
        'as'=>'tour_season.store'
    ]);
    Route::get('/tour_season/edit/{id}', [
        'uses'=>'TourSeasonsController@edit',
        'as'=>'tour_season.edit'
    ]);
    Route::post('/tour_season/update/{id}', [
        'uses'=>'TourSeasonsController@update',
        'as'=>'tour_season.update'
    ]);
    Route::get('/tour_season/delete/{id}', [
        'uses'=>'TourSeasonsController@destroy',
        'as'=>'tour_season.delete'
    ]);

    Route::get('/tour_group_sizes', [
        'uses'=>'TourGroupSizesController@index',
        'as'=>'tour_group_sizes'
    ]);
    Route::get('/tour_group_size/create', [
        'uses'=>'TourGroupSizesController@create',
        'as'=>'tour_group_size.create'
    ]);
    Route::post('/tour_group_size/store', [
        'uses'=>'TourGroupSizesController@store',
        'as'=>'tour_group_size.store'
    ]);
    Route::get('/tour_group_size/edit/{id}', [
        'uses'=>'TourGroupSizesController@edit',
        'as'=>'tour_group_size.edit'
    ]);
    Route::post('/tour_group_size/update/{id}', [
        'uses'=>'TourGroupSizesController@update',
        'as'=>'tour_group_size.update'
    ]);
    Route::get('/tour_group_size/delete/{id}', [
        'uses'=>'TourGroupSizesController@destroy',
        'as'=>'tour_group_size.delete'
    ]);

    Route::get('/hotel_categories', [
        'uses'=>'HotelCategoriesController@index',
        'as'=>'hotel_categories'
    ]);
    Route::get('/hotel_category/create', [
        'uses'=>'HotelCategoriesController@create',
        'as'=>'hotel_category.create'
    ]);
    Route::post('/hotel_category/store', [
        'uses'=>'HotelCategoriesController@store',
        'as'=>'hotel_category.store'
    ]);
    Route::get('/hotel_category/edit/{id}', [
        'uses'=>'HotelCategoriesController@edit',
        'as'=>'hotel_category.edit'
    ]);
    Route::post('/hotel_category/update/{id}', [
        'uses'=>'HotelCategoriesController@update',
        'as'=>'hotel_category.update'
    ]);
    Route::get('/hotel_category/delete/{id}', [
        'uses'=>'HotelCategoriesController@destroy',
        'as'=>'hotel_category.delete'
    ]);

    Route::get('/tour_types', [
        'uses'=>'TourTypesController@index',
        'as'=>'tour_types'
    ]);
    Route::get('/tour_type/create', [
        'uses'=>'TourTypesController@create',
        'as'=>'tour_type.create'
    ]);
    Route::post('/tour_type/store', [
        'uses'=>'TourTypesController@store',
        'as'=>'tour_type.store'
    ]);
    Route::get('/tour_type/edit/{id}', [
        'uses'=>'TourTypesController@edit',
        'as'=>'tour_type.edit'
    ]);
    Route::post('/tour_type/update/{id}', [
        'uses'=>'TourTypesController@update',
        'as'=>'tour_type.update'
    ]);
    Route::get('/tour_type/delete/{id}', [
        'uses'=>'TourTypesController@destroy',
        'as'=>'tour_type.delete'
    ]);

    Route::get('/hotels', [
        'uses'=>'HotelsController@index',
        'as'=>'hotels'
    ]);
    Route::get('/hotel/create', [
        'uses'=>'HotelsController@create',
        'as'=>'hotel.create'
    ]);
    Route::post('/hotel/store', [
        'uses'=>'HotelsController@store',
        'as'=>'hotel.store'
    ]);
    Route::get('/hotel/edit/{id}', [
        'uses'=>'HotelsController@edit',
        'as'=>'hotel.edit'
    ]);
    Route::post('/hotel/update/{id}', [
        'uses'=>'HotelsController@update',
        'as'=>'hotel.update'
    ]);
    Route::get('/hotel/delete/{id}', [
        'uses'=>'HotelsController@destroy',
        'as'=>'hotel.delete'
    ]);

    Route::get('/meals_and_caterings', [
        'uses'=>'MealsAndCateringsController@index',
        'as'=>'meals_and_caterings'
    ]);
    Route::get('/meals_and_catering/create', [
        'uses'=>'MealsAndCateringsController@create',
        'as'=>'meals_and_catering.create'
    ]);
    Route::post('/meals_and_catering/store', [
        'uses'=>'MealsAndCateringsController@store',
        'as'=>'meals_and_catering.store'
    ]);
    Route::get('/meals_and_catering/edit/{id}', [
        'uses'=>'MealsAndCateringsController@edit',
        'as'=>'meals_and_catering.edit'
    ]);
    Route::post('/meals_and_catering/update/{id}', [
        'uses'=>'MealsAndCateringsController@update',
        'as'=>'meals_and_catering.update'
    ]);
    Route::get('/meals_and_catering/delete/{id}', [
        'uses'=>'MealsAndCateringsController@destroy',
        'as'=>'meals_and_catering.delete'
    ]);

    Route::get('/staff_members', [
        'uses'=>'StaffMembersController@index',
        'as'=>'staff_members'
    ]);
    Route::get('/staff_member/create', [
        'uses'=>'StaffMembersController@create',
        'as'=>'staff_member.create'
    ]);
    Route::post('/staff_member/store', [
        'uses'=>'StaffMembersController@store',
        'as'=>'staff_member.store'
    ]);
    Route::get('/staff_member/edit/{id}', [
        'uses'=>'StaffMembersController@edit',
        'as'=>'staff_member.edit'
    ]);
    Route::post('/staff_member/update/{id}', [
        'uses'=>'StaffMembersController@update',
        'as'=>'staff_member.update'
    ]);
    Route::get('/staff_member/delete/{id}', [
        'uses'=>'StaffMembersController@destroy',
        'as'=>'staff_member.delete'
    ]);

    Route::get('/guides', [
        'uses'=>'GuidesController@index',
        'as'=>'guides'
    ]);
    Route::get('/guide/create', [
        'uses'=>'GuidesController@create',
        'as'=>'guide.create'
    ]);
    Route::post('/guide/store', [
        'uses'=>'GuidesController@store',
        'as'=>'guide.store'
    ]);
    Route::get('/guide/edit/{id}', [
        'uses'=>'GuidesController@edit',
        'as'=>'guide.edit'
    ]);
    Route::post('/guide/update/{id}', [
        'uses'=>'GuidesController@update',
        'as'=>'guide.update'
    ]);
    Route::get('/guide/delete/{id}', [
        'uses'=>'GuidesController@destroy',
        'as'=>'guide.delete'
    ]);

    Route::get('/about_contents', [
        'uses'=>'AboutContentsController@index',
        'as'=>'about_contents'
    ]);
    Route::get('/about_content/create', [
        'uses'=>'AboutContentsController@create',
        'as'=>'about_content.create'
    ]);
    Route::post('/about_content/store', [
        'uses'=>'AboutContentsController@store',
        'as'=>'about_content.store'
    ]);
    Route::get('/about_content/edit/{id}', [
        'uses'=>'AboutContentsController@edit',
        'as'=>'about_content.edit'
    ]);
    Route::post('/about_content/update/{id}', [
        'uses'=>'AboutContentsController@update',
        'as'=>'about_content.update'
    ]);
    Route::get('/about_content/delete/{id}', [
        'uses'=>'AboutContentsController@destroy',
        'as'=>'about_content.delete'
    ]);

    Route::get('/about_armenia_contents', [
        'uses'=>'AboutArmeniaContentsController@index',
        'as'=>'about_armenia_contents'
    ]);
    Route::get('/about_armenia_content/create', [
        'uses'=>'AboutArmeniaContentsController@create',
        'as'=>'about_armenia_content.create'
    ]);
    Route::post('/about_armenia_content/store', [
        'uses'=>'AboutArmeniaContentsController@store',
        'as'=>'about_armenia_content.store'
    ]);
    Route::get('/about_armenia_content/edit/{id}', [
        'uses'=>'AboutArmeniaContentsController@edit',
        'as'=>'about_armenia_content.edit'
    ]);
    Route::post('/about_armenia_content/update/{id}', [
        'uses'=>'AboutArmeniaContentsController@update',
        'as'=>'about_armenia_content.update'
    ]);
    Route::get('/about_armenia_content/delete/{id}', [
        'uses'=>'AboutArmeniaContentsController@destroy',
        'as'=>'about_armenia_content.delete'
    ]);

    Route::get('/services_contents', [
        'uses'=>'ServicesContentsController@index',
        'as'=>'services_contents'
    ]);
    Route::get('/services_content/create', [
        'uses'=>'ServicesContentsController@create',
        'as'=>'services_content.create'
    ]);
    Route::post('/services_content/store', [
        'uses'=>'ServicesContentsController@store',
        'as'=>'services_content.store'
    ]);
    Route::get('/services_content/edit/{id}', [
        'uses'=>'ServicesContentsController@edit',
        'as'=>'services_content.edit'
    ]);
    Route::post('/services_content/update/{id}', [
        'uses'=>'ServicesContentsController@update',
        'as'=>'services_content.update'
    ]);
    Route::get('/services_content/delete/{id}', [
        'uses'=>'ServicesContentsController@destroy',
        'as'=>'services_content.delete'
    ]);

    Route::get('/tourist_info_contents', [
        'uses'=>'TouristInfoContentsController@index',
        'as'=>'tourist_info_contents'
    ]);
    Route::get('/tourist_info_content/create', [
        'uses'=>'TouristInfoContentsController@create',
        'as'=>'tourist_info_content.create'
    ]);
    Route::post('/tourist_info_content/store', [
        'uses'=>'TouristInfoContentsController@store',
        'as'=>'tourist_info_content.store'
    ]);
    Route::get('/tourist_info_content/edit/{id}', [
        'uses'=>'TouristInfoContentsController@edit',
        'as'=>'tourist_info_content.edit'
    ]);
    Route::post('/tourist_info_content/update/{id}', [
        'uses'=>'TouristInfoContentsController@update',
        'as'=>'tourist_info_content.update'
    ]);
    Route::get('/tourist_info_content/delete/{id}', [
        'uses'=>'TouristInfoContentsController@destroy',
        'as'=>'tourist_info_content.delete'
    ]);

    Route::get('/custom_meta_tags', [
        'uses'=>'CustomMetaTagsController@index',
        'as'=>'custom_meta_tags'
    ]);
    Route::get('/custom_meta_tag/create', [
        'uses'=>'CustomMetaTagsController@create',
        'as'=>'custom_meta_tag.create'
    ]);
    Route::post('/custom_meta_tag/store', [
        'uses'=>'CustomMetaTagsController@store',
        'as'=>'custom_meta_tag.store'
    ]);
    Route::get('/custom_meta_tag/edit/{id}', [
        'uses'=>'CustomMetaTagsController@edit',
        'as'=>'custom_meta_tag.edit'
    ]);
    Route::post('/custom_meta_tag/update/{id}', [
        'uses'=>'CustomMetaTagsController@update',
        'as'=>'custom_meta_tag.update'
    ]);
    Route::get('/custom_meta_tag/delete/{id}', [
        'uses'=>'CustomMetaTagsController@destroy',
        'as'=>'custom_meta_tag.delete'
    ]);

    Route::get('/entertainments', [
        'uses'=>'EntertainmentsController@index',
        'as'=>'entertainments'
    ]);
    Route::get('/entertainment/create', [
        'uses'=>'EntertainmentsController@create',
        'as'=>'entertainment.create'
    ]);
    Route::post('/entertainment/store', [
        'uses'=>'EntertainmentsController@store',
        'as'=>'entertainment.store'
    ]);
    Route::get('/entertainment/edit/{id}', [
        'uses'=>'EntertainmentsController@edit',
        'as'=>'entertainment.edit'
    ]);
    Route::post('/entertainment/update/{id}', [
        'uses'=>'EntertainmentsController@update',
        'as'=>'entertainment.update'
    ]);
    Route::get('/entertainment/delete/{id}', [
        'uses'=>'EntertainmentsController@destroy',
        'as'=>'entertainment.delete'
    ]);

    Route::get('/sightseeing_types', [
        'uses'=>'SightseeingTypesController@index',
        'as'=>'sightseeing_types'
    ]);
    Route::get('/sightseeing_type/create', [
        'uses'=>'SightseeingTypesController@create',
        'as'=>'sightseeing_type.create'
    ]);
    Route::post('/sightseeing_type/store', [
        'uses'=>'SightseeingTypesController@store',
        'as'=>'sightseeing_type.store'
    ]);
    Route::get('/sightseeing_type/edit/{id}', [
        'uses'=>'SightseeingTypesController@edit',
        'as'=>'sightseeing_type.edit'
    ]);
    Route::post('/sightseeing_type/update/{id}', [
        'uses'=>'SightseeingTypesController@update',
        'as'=>'sightseeing_type.update'
    ]);
    Route::get('/sightseeing_type/delete/{id}', [
        'uses'=>'SightseeingTypesController@destroy',
        'as'=>'sightseeing_type.delete'
    ]);

    Route::get('/sightseeing_places', [
        'uses'=>'SightseeingPlacesController@index',
        'as'=>'sightseeing_places'
    ]);
    Route::get('/sightseeing_place/create', [
        'uses'=>'SightseeingPlacesController@create',
        'as'=>'sightseeing_place.create'
    ]);
    Route::post('/sightseeing_place/store', [
        'uses'=>'SightseeingPlacesController@store',
        'as'=>'sightseeing_place.store'
    ]);
    Route::get('/sightseeing_place/edit/{id}', [
        'uses'=>'SightseeingPlacesController@edit',
        'as'=>'sightseeing_place.edit'
    ]);
    Route::post('/sightseeing_place/update/{id}', [
        'uses'=>'SightseeingPlacesController@update',
        'as'=>'sightseeing_place.update'
    ]);
    Route::get('/sightseeing_place/delete/{id}', [
        'uses'=>'SightseeingPlacesController@destroy',
        'as'=>'sightseeing_place.delete'
    ]);

    Route::get('/events', [
        'uses'=>'EventsController@index',
        'as'=>'events'
    ]);
    Route::get('/event/create', [
        'uses'=>'EventsController@create',
        'as'=>'event.create'
    ]);
    Route::post('/event/store', [
        'uses'=>'EventsController@store',
        'as'=>'event.store'
    ]);
    Route::get('/event/edit/{id}', [
        'uses'=>'EventsController@edit',
        'as'=>'event.edit'
    ]);
    Route::post('/event/update/{id}', [
        'uses'=>'EventsController@update',
        'as'=>'event.update'
    ]);
    Route::get('/event/delete/{id}', [
        'uses'=>'EventsController@destroy',
        'as'=>'event.delete'
    ]);

    Route::get('/food_and_drinks', [
        'uses'=>'FoodAndDrinksController@index',
        'as'=>'food_and_drinks'
    ]);
    Route::get('/food_and_drink/create', [
        'uses'=>'FoodAndDrinksController@create',
        'as'=>'food_and_drink.create'
    ]);
    Route::post('/food_and_drink/store', [
        'uses'=>'FoodAndDrinksController@store',
        'as'=>'food_and_drink.store'
    ]);
    Route::get('/food_and_drink/edit/{id}', [
        'uses'=>'FoodAndDrinksController@edit',
        'as'=>'food_and_drink.edit'
    ]);
    Route::post('/food_and_drink/update/{id}', [
        'uses'=>'FoodAndDrinksController@update',
        'as'=>'food_and_drink.update'
    ]);
    Route::get('/food_and_drink/delete/{id}', [
        'uses'=>'FoodAndDrinksController@destroy',
        'as'=>'food_and_drink.delete'
    ]);

    Route::get('/news', [
        'uses'=>'NewsController@index',
        'as'=>'news'
    ]);
    Route::get('/news/create', [
        'uses'=>'NewsController@create',
        'as'=>'news.create'
    ]);
    Route::post('/news/store', [
        'uses'=>'NewsController@store',
        'as'=>'news.store'
    ]);
    Route::get('/news/edit/{id}', [
        'uses'=>'NewsController@edit',
        'as'=>'news.edit'
    ]);
    Route::post('/news/update/{id}', [
        'uses'=>'NewsController@update',
        'as'=>'news.update'
    ]);
    Route::get('/news/delete/{id}', [
        'uses'=>'NewsController@destroy',
        'as'=>'news.delete'
    ]);

    Route::get('/blogs', [
        'uses'=>'BlogsController@index',
        'as'=>'blogs'
    ]);
    Route::get('/blog/create', [
        'uses'=>'BlogsController@create',
        'as'=>'blog.create'
    ]);
    Route::post('/blog/store', [
        'uses'=>'BlogsController@store',
        'as'=>'blog.store'
    ]);
    Route::get('/blog/edit/{id}', [
        'uses'=>'BlogsController@edit',
        'as'=>'blog.edit'
    ]);
    Route::post('/blog/update/{id}', [
        'uses'=>'BlogsController@update',
        'as'=>'blog.update'
    ]);
    Route::get('/blog/delete/{id}', [
        'uses'=>'BlogsController@destroy',
        'as'=>'blog.delete'
    ]);

    Route::get('/trustees', [
        'uses'=>'TrusteesController@index',
        'as'=>'trustees'
    ]);
    Route::get('/trustee/create', [
        'uses'=>'TrusteesController@create',
        'as'=>'trustee.create'
    ]);
    Route::post('/trustee/store', [
        'uses'=>'TrusteesController@store',
        'as'=>'trustee.store'
    ]);
    Route::get('/trustee/edit/{id}', [
        'uses'=>'TrusteesController@edit',
        'as'=>'trustee.edit'
    ]);
    Route::post('/trustee/update/{id}', [
        'uses'=>'TrusteesController@update',
        'as'=>'trustee.update'
    ]);
    Route::get('/trustee/delete/{id}', [
        'uses'=>'TrusteesController@destroy',
        'as'=>'trustee.delete'
    ]);

    Route::get('/certificates', [
        'uses'=>'CertificatesController@index',
        'as'=>'certificates'
    ]);
    Route::get('/certificate/create', [
        'uses'=>'CertificatesController@create',
        'as'=>'certificate.create'
    ]);
    Route::post('/certificate/store', [
        'uses'=>'CertificatesController@store',
        'as'=>'certificate.store'
    ]);
    Route::get('/certificate/edit/{id}', [
        'uses'=>'CertificatesController@edit',
        'as'=>'certificate.edit'
    ]);
    Route::post('/certificate/update/{id}', [
        'uses'=>'CertificatesController@update',
        'as'=>'certificate.update'
    ]);
    Route::get('/certificate/delete/{id}', [
        'uses'=>'CertificatesController@destroy',
        'as'=>'certificate.delete'
    ]);

    Route::get('/videos', [
        'uses'=>'VideosController@index',
        'as'=>'videos'
    ]);
    Route::get('/video/create', [
        'uses'=>'VideosController@create',
        'as'=>'video.create'
    ]);
    Route::post('/video/store', [
        'uses'=>'VideosController@store',
        'as'=>'video.store'
    ]);
    Route::get('/video/edit/{id}', [
        'uses'=>'VideosController@edit',
        'as'=>'video.edit'
    ]);
    Route::post('/video/update/{id}', [
        'uses'=>'VideosController@update',
        'as'=>'video.update'
    ]);
    Route::get('/video/delete/{id}', [
        'uses'=>'VideosController@destroy',
        'as'=>'video.delete'
    ]);

    Route::get('/photos', [
        'uses'=>'PhotosController@index',
        'as'=>'photos'
    ]);
    Route::get('/photo/create', [
        'uses'=>'PhotosController@create',
        'as'=>'photo.create'
    ]);
    Route::post('/photo/store', [
        'uses'=>'PhotosController@store',
        'as'=>'photo.store'
    ]);
    Route::get('/photo/edit/{id}', [
        'uses'=>'PhotosController@edit',
        'as'=>'photo.edit'
    ]);
    Route::post('/photo/update/{id}', [
        'uses'=>'PhotosController@update',
        'as'=>'photo.update'
    ]);
    Route::get('/photo/delete/{id}', [
        'uses'=>'PhotosController@destroy',
        'as'=>'photo.delete'
    ]);
});

Route::group(
    [
        'namespace'  => 'Backpack\Base\app\Http\Controllers',
        'middleware' => 'web',
        'prefix'     => config('backpack.base.route_prefix'),
    ],
    function () {
        // if not otherwise configured, setup the auth routes
        if (config('backpack.base.setup_auth_routes')) {
            // Authentication Routes...
            Route::get('login', 'Auth\LoginController@showLoginForm')->name('backpack.auth.login');
            Route::post('login', 'Auth\LoginController@login');
            Route::get('logout', 'Auth\LoginController@logout')->name('backpack.auth.logout');
            Route::post('logout', 'Auth\LoginController@logout');

            // Registration Routes...
            Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('backpack.auth.register');
            Route::post('register', 'Auth\RegisterController@register');

            // Password Reset Routes...
            Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('backpack.auth.password.reset');
            Route::post('password/reset', 'Auth\ResetPasswordController@reset');
            Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('backpack.auth.password.reset.token');
            Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('backpack.auth.password.email');
        }

        // if not otherwise configured, setup the dashboard routes
        if (config('backpack.base.setup_dashboard_routes')) {
            Route::get('dashboard', 'AdminController@dashboard')->name('backpack.dashboard');
            Route::get('/', 'AdminController@redirect')->name('backpack');
        }

        // if not otherwise configured, setup the "my account" routes
        if (config('backpack.base.setup_my_account_routes')) {
            Route::get('edit-account-info', 'Auth\MyAccountController@getAccountInfoForm')->name('backpack.account.info');
            Route::post('edit-account-info', 'Auth\MyAccountController@postAccountInfoForm');
            Route::get('change-password', 'Auth\MyAccountController@getChangePasswordForm')->name('backpack.account.password');
            Route::post('change-password', 'Auth\MyAccountController@postChangePasswordForm');
        }
    });

Route::group([
    'namespace'  => 'Backpack\LangFileManager\app\Http\Controllers',
    'prefix'     => config('admin'),
    'middleware' => ['web', 'admin'],
    ], function () {
    // Language
    Route::get('language/texts/{lang}/{file?}', 'LanguageCrudController@showTexts')->name('backpack.languages');
});

Route::group([
    'namespace'  => 'Backpack\LangFileManager\app\Http\Controllers',
    'prefix'     => 'en/admin',
    'middleware' => ['web', 'admin'],
], function () {
    // Language
    Route::post('language/texts/{lang}/{file}', 'LanguageCrudController@updateTexts')->name('backpack.store_languages');
    CRUD::resource('language', 'LanguageCrudController');
});

Route::group(['namespace'=>'App\Http\Controllers'], function() {

    Route::get('/', [
        'uses' => 'WebsiteController@index',
        'as' => 'website'
    ]);
    Route::get('/tours', [
        'uses' => 'WebsiteToursController@index',
        'as' => 'website_tours'
    ]);
    Route::get('/news', [
        'uses' => 'WebsiteNewsController@index',
        'as' => 'website_news'
    ]);
    Route::get('/news/{slug}', [
        'uses' => 'NewsController@show',
        'as' => 'news.show'
    ]);
    Route::get('/blog/{slug}', [
        'uses' => 'BlogsController@show',
        'as' => 'blog.show'
    ]);
    Route::get('/contact', [
        'uses' => 'WebsiteContactController@index',
        'as' => 'contact'
    ]);
    Route::post('/contact', [
        'uses' => 'WebsiteContactController@index_post',
        'as' => 'contact'
    ]);
    Route::post('/contact/mail', [
        'uses' => 'MailerController@send',
        'as' => 'contact.mail'
    ]);
    Route::post('/hotel_mail', [
        'uses' => 'MailerController@send_hotel_request',
        'as' => 'hotel.mail'
    ]);
    Route::post('/your_own_tour_mail', [
        'uses' => 'MailerController@send_your_own_tour_request',
        'as' => 'your_own_tour.mail'
    ]);
    Route::get('/about', [
        'uses' => 'WebsiteAboutController@index',
        'as' => 'about'
    ]);
    Route::get('/services', [
        'uses' => 'WebsiteServicesController@index',
        'as' => 'services'
    ]);
    Route::get('/armenia', [
        'uses' => 'WebsiteArmeniaController@index',
        'as' => 'armenia'
    ]);
    Route::get('/tour/{slug}', [
        'uses' => 'ToursController@show',
        'as' => 'tour.show'
    ]);
    Route::get('/your_own_tour', [
        'uses' => 'WebsiteToursController@your_own_tour',
        'as' => 'your_own_tour'
    ]);
    Route::any('/modal',[
        'uses'=>'ModalController@index',
        'as'=>'modal'
    ]);
    Route::get('lang/{language}/{hash?}', ['as' => 'lang.switch', 'uses' => 'LanguageController@switchLang']);
    Route::get('admin/lang/{language}', ['as' => 'admin.lang_switch', 'uses' => 'LanguageController@switchLangAdmin']);

});

//Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
