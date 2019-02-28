@extends('backpack::layout')
@push('after_styles')
<link href="{{asset('css/custom.css')}}" rel="stylesheet">
@endpush
@section('content')
    @if(count($errors)>0)
        <ul class="list-group">
            @foreach($errors->all() as $error)
                <li class="list-group-item text-danger">
                    {{$error}}
                </li>
            @endforeach
        </ul>
    @endif
    <div class="panel panel-default">

        <div class="panel-body">
            <h2>
                {{trans('admin.edit_the_tour')}}
            </h2>
            <form action="{{route('tour.update',['id'=>$tour->id])}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <ul class="nav nav-tabs">
                    @foreach(config('translatable.locales') as $key=>$value)
                        <li id="li-{{$key}}" class="@if(App::isLocale($key)) active @endif" onclick="activate('{{$key}}')" href="#{{$key}}"><a data-toggle="tab" >{{$value}}</a></li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    @foreach(array_keys(config('translatable.locales')) as $lang)
                        <div id="{{$lang}}" class="tab-pane fade @if(App::isLocale($lang))in active @endif">
                            <div class="form-group">
                                <label for="name_{{$lang}}">{{Lang::get('admin.name',[],$lang)}}</label>
                                <input type="text" name="name_{{$lang}}" id="name_{{$lang}}" value="{{$tour->getTranslation($lang)->name}}" class="form-control">
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <label for="tour_image">{{trans('admin.tour_image')}}</label>
                    @if($tour->tour_image)
                        <img class="img-responsive old-image" src="{{asset($tour->tour_image)}}">
                    @endif
                    <input type="file" name="tour_image" id="tour_image" class="form-control">
                </div>
                <div class="form-group">
                    <label>{{trans('admin.select_types')}}</label>
                    @foreach($tour_types as $tour_type)
                        <div class="checkbox">
                            <label><input type="checkbox" name="types[]" value="{{$tour_type->id}}"
                                @foreach($tour->tour_types as $t)

                                    @if($tour_type->id==$t->id)
                                        <?='checked="checked"'?>
                                            @else
                                        {{--nothing--}}
                                            @endif
                                        @endforeach
                                >{{$tour_type->name}}</label>
                        </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <label for="season_id">{{trans('admin.season')}}</label>
                    <select name="season_id" id="season_id" class="form-control">
                        @foreach($tour_seasons as $tour_season)
                            <option value="{{$tour_season->id}}"
                                    @if($tour->season->id==$tour_season->id)
                                    selected
                                    @endif
                            >{{$tour_season->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="period_id">{{trans('admin.period')}}</label>
                    <select name="period_id" id="period_id" class="form-control">
                        @foreach($tour_periods as $tour_period)
                            <option value="{{$tour_period->id}}"
                                    @if($tour->period->id==$tour_period->id)
                                    selected
                                    @endif
                            >{{$tour_period->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="group_size_id">{{trans('admin.group_size')}}</label>
                    <select name="group_size_id" id="group_size_id" class="form-control">
                        @foreach($tour_group_sizes as $tour_group_size)
                            <option value="{{$tour_group_size->id}}"
                                    @if($tour->group_size->id==$tour_group_size->id)
                                    selected
                                    @endif
                            >{{$tour_group_size->size}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="start_price">{{trans('admin.start_price')}}</label>
                    <input type="text" name="start_price" value="{{$tour->start_price}}" id="start_price" class="form-control">
                    <select name="currency_id" id="currency_id" class="form-control">
                        @foreach($currencies as $currency)
                            <option value="{{$currency->id}}"
                                @if($tour->currency->id==$currency->id)
                                    selected
                                @endif
                            >{{$currency->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="days_count">{{trans('admin.days')}}</label>
                    <input type="number" name="days_count" id="days_count" value="{{$tour->days_count}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="nights_count">{{trans('admin.nights')}}</label>
                    <input type="number" name="nights_count" id="nights_count" value="{{$tour->nights_count}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="hotel_id">{{trans('admin.hotel')}}</label>
                    <select name="hotel_id" id="hotel_id" class="form-control">
                        @foreach($hotels as $hotel)
                            <option value="{{$hotel->id}}"
                                    @if($tour->hotel->id==$hotel->id)
                                    selected
                                    @endif
                            >{{$hotel->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>{{trans('admin.guaranteed')}}</label>
                    @if($tour->guaranteed==1)
                        <label for="yes">{{trans('admin.yes')}}</label>
                        <input type="radio" name="guaranteed" id="yes" value="1" checked="checked">
                        <label for="no">{{trans('admin.no')}}</label>
                        <input type="radio" name="guaranteed" id="no" value="2">
                    @else
                        <label for="yes">{{trans('admin.yes')}}</label>
                        <input type="radio" name="guaranteed" id="yes" value="1">
                        <label for="no">{{trans('admin.no')}}</label>
                        <input type="radio" name="guaranteed" id="no" value="2" checked="checked">
                    @endif
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">{{trans('admin.update')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('after_scripts')
<script src="{{asset('js/tabs.js')}}"></script>
@endpush