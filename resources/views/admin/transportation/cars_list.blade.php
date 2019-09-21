@extends('backpack::layout')
@push('after_styles')
<link href="{{asset('css/custom.css')}}" rel="stylesheet">
<style>
    tbody.collapse.in {
        display: table-row-group;
    }
    .carousel.slide{
        height:100px;
        width: 200px;
    }
    .carousel.slide *{
        height: 100%;
    }
    .fold-block{
        background: lavender;
        margin-left: 0;
        margin-right: 0;
    }
    .fold-block p{
        padding-top: 5px;
        padding-bottom: 5px;
        margin: 0;
    }
</style>
@endpush
@section('content')
    <div class="panel panel-default">
        <table class="table table-responsive table-hover table-condensed">
            <thead>
                <tr>
                    <th>&numero;</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Images</th>
                    <th>Color</th>
                    <th>Year</th>
                    <th>Prices</th>
                    <th>Actions</th>
                </tr>
            </thead>
            @foreach($cars as $car_index => $car)
                <tbody>
                <tr class="clickable" data-toggle="collapse" data-target="#group-of-rows-{{$car_index}}" aria-expanded="false" aria-controls="group-of-rows-{{$car_index}}">
                    <td>{{$car_index+1}}</td>
                    <td>{{$car->car_model->car_make->name}}</td>
                    <td>{{$car->car_model->name}}</td>
                    <td>
                        <div id="myCarousel-{{$car->id}}" class="carousel slide" data-ride="carousel">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                @foreach($car->car_images as $car_image_index => $car_image)
                                    <div class="item @if($car_image_index==1) active @endif">
                                        <img class="img omg-responsive" src="{{asset($car_image->name)}}" alt="Car image #{{$car_image_index}}">
                                    </div>
                                @endforeach
                            </div>
                            <!-- Left and right controls -->
                            @if(count($car->car_images))
                                <a class="left carousel-control" href="#myCarousel-{{$car->id}}" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#myCarousel-{{$car->id}}" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            @endif
                        </div>
                    </td>
                    <td>{{$car->color}}</td>
                    <td>{{$car->year}}</td>
                    <td>
                        <table class="table table-bordered">
                            @if($car->price->per_km)
                                <tr>
                                    <td>Per km: </td>
                                    <td>AMD{{number_format($car->price->per_km)}}</td>
                                </tr>
                            @endif
                            @if($car->price->per_km_driver)
                                <tr>
                                    <td>Per km (with driver): </td>
                                    <td>AMD{{number_format($car->price->per_km_driver)}}</td>
                                </tr>
                            @endif
                            @if(count($car->price->routes))
                                @foreach($car->price->routes as $route)
                                    <tr>
                                        <td>{{$route->name}}</td>
                                        <td>AMD{{number_format($route->pivot->amount)}}</td>
                                    </tr>
                                @endforeach
                            @endif
                            @if(count($car->price->custom_routes))
                                @foreach($car->price->custom_routes as $custom_route)
                                    <tr>
                                        <td>{{$custom_route->name}}</td>
                                        <td>AMD{{number_format($custom_route->amount)}}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </td>
                    <td>
                        <div>
                            <button id="btn-success-{{$car->id}}" class="btn btn-sm btn-success"> A </button>
                            <button id="btn-danger-{{$car->id}}" class="btn btn-sm btn-danger"> B </button>
                        </div>
                    </td>
                </tr>
                </tbody>
                <tbody id="group-of-rows-{{$car_index}}" class="collapse">
                <tr>
                    <td colspan="8">
                        <div class="row fold-block">
                            <div class="col-md-3">
                                <h5>Customer Info</h5>
                                <p>Jur. Name: {{$car->price->customer->legal_name}}</p>
                                <p>Phone: {{$car->price->customer->phone}}</p>
                                <p>Email: {{$car->price->customer->email}}</p>
                                <p>TIN: {{$car->price->customer->tin}}</p>
                            </div>
                            <div class="col-md-3">
                                <h5>Car Info</h5>
                                <p>Seat quantity: {{$car->seat_quantity}}</p>
                                <p>Baggage quantity: {{$car->baggage_quantity}}</p>
                                <p>Leather (?): {{$car->is_leather?'Yes':'No'}}</p>
                                <p>Foldable (?): {{$car->is_foldable?'Yes':'No'}}</p>
                                <p>Has Air-conditioning (?): {{$car->has_air_conditioning?'Yes':'No'}}</p>
                                <p>Fuel Type: {{$car->fuel_type->name}}</p>
                                <p>Volume: {{$car->volume}} L</p>
                            </div>
                            <div class="col-md-3">
                                <h5>Additional Services</h5>
                                @foreach($car->additional_services as $additional_service)
                                    <p>{{$additional_service->name}}</p>
                                @endforeach
                            </div>
                            <div class="col-md-3">
                                <h5>Notes</h5>
                                <p>{{$car->price->customer->notes}}</p>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            @endforeach
        </table>
    </div>
@endsection
@push('after_scripts')
<script src="{{asset('js/tabs.js')}}"></script>
@endpush