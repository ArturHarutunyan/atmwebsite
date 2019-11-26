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
                {{trans('admin.edit_the_services_content')}}
            </h2>
            <form action="{{route('services_content.update',['id'=>$services_content->id])}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <ul class="nav nav-tabs">
                    @foreach(config('translatable.locales') as $key=>$value)
                        <li id="li-{{$key}}" class="@if(App::isLocale($key)) active @endif" onclick="activate('{{$key}}')" href="#{{$key}}"><a data-toggle="tab" >{{$value}}</a></li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    @foreach(array_keys(config('translatable.locales')) as $lang)
                        @if($services_content->hasTranslation($lang))
                            <div id="{{$lang}}" class="tab-pane fade @if(App::isLocale($lang))in active @endif">
                            <div class="form-group">
                                <label for="tour_packages_content_{{$lang}}">{{Lang::get('admin.tour_packages_content',[],$lang)}}</label>
                                <textarea id="tour_packages_content_{{$lang}}" class="ckeditor-content form-control" name="tour_packages_content_{{$lang}}">{{$services_content->getTranslation($lang)->tour_packages_content}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="hotel_reservation_content_{{$lang}}">{{Lang::get('admin.hotel_reservation_content',[],$lang)}}</label>
                                <textarea id="hotel_reservation_content_{{$lang}}" class="ckeditor-content form-control" name="hotel_reservation_content_{{$lang}}">{{$services_content->getTranslation($lang)->hotel_reservation_content}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="choose_hotel_content_{{$lang}}">{{Lang::get('admin.choose_hotel_content',[],$lang)}}</label>
                                <textarea id="choose_hotel_content_{{$lang}}" class="ckeditor-content form-control" name="choose_hotel_content_{{$lang}}">{{$services_content->getTranslation($lang)->choose_hotel_content}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="select_dates_content_{{$lang}}">{{Lang::get('admin.select_dates_content',[],$lang)}}</label>
                                <textarea id="select_dates_content_{{$lang}}" class="ckeditor-content form-control" name="select_dates_content_{{$lang}}">{{$services_content->getTranslation($lang)->select_dates_content}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="welcome_to_armenia_content_{{$lang}}">{{Lang::get('admin.welcome_to_armenia_content',[],$lang)}}</label>
                                <textarea id="welcome_to_armenia_content_{{$lang}}" class="ckeditor-content form-control" name="welcome_to_armenia_content_{{$lang}}">{{$services_content->getTranslation($lang)->welcome_to_armenia_content}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="transport_content_{{$lang}}">{{Lang::get('admin.transport_content',[],$lang)}}</label>
                                <textarea id="transport_content_{{$lang}}" class="ckeditor-content form-control" name="transport_content_{{$lang}}">{{$services_content->getTranslation($lang)->transport_content}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for=meals_content_{{$lang}}">{{Lang::get('admin.meals_content',[],$lang)}}</label>
                                <textarea id=meals_content_{{$lang}}" class="ckeditor-content form-control" name="meals_content_{{$lang}}">{{$services_content->getTranslation($lang)->meals_content}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="excursions_content_{{$lang}}">{{Lang::get('admin.excursions_content',[],$lang)}}</label>
                                <textarea id="excursions_content_{{$lang}}" class="ckeditor-content form-control" name="excursions_content_{{$lang}}">{{$services_content->getTranslation($lang)->excursions_content}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="mice_content_one_{{$lang}}">{{Lang::get('admin.mice_content_one',[],$lang)}}</label>
                                <textarea id="mice_content_one_{{$lang}}" class="ckeditor-content form-control" name="mice_content_one_{{$lang}}">{{$services_content->getTranslation($lang)->mice_content_one}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="mice_content_two_{{$lang}}">{{Lang::get('admin.mice_content_two',[],$lang)}}</label>
                                <textarea id="mice_content_two_{{$lang}}" class="ckeditor-content form-control" name="mice_content_two_{{$lang}}">{{$services_content->getTranslation($lang)->mice_content_two}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="translation_content_{{$lang}}">{{Lang::get('admin.translation_content',[],$lang)}}</label>
                                <textarea id="translation_content_{{$lang}}" class="ckeditor-content form-control" name="translation_content_{{$lang}}">{{$services_content->getTranslation($lang)->translation_content}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="equipment_content_{{$lang}}">{{Lang::get('admin.equipment_content',[],$lang)}}</label>
                                <textarea id="equipment_content_{{$lang}}" class="ckeditor-content form-control" name="equipment_content_{{$lang}}">{{$services_content->getTranslation($lang)->equipment_content}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="for_fit_content_{{$lang}}">{{Lang::get('admin.for_fit_content',[],$lang)}}</label>
                                <textarea id="for_fit_content_{{$lang}}" class="ckeditor-content form-control" name="for_fit_content_{{$lang}}">{{$services_content->getTranslation($lang)->for_fit_content}}</textarea>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
                <div class="form-group">
                    <label for="tour_id_one">{{trans('admin.tour_one')}}</label>
                    <select name="tour_id_one" id="tour_id_one" class="form-control">
                        @foreach($tours as $tour)
                            <option value="{{$tour->id}}"
                                    @if($services_content->tour_id_one==$tour->id)
                                    selected
                                    @endif
                            >{{$tour->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tour_id_two">{{trans('admin.tour_two')}}</label>
                    <select name="tour_id_two" id="tour_id_two" class="form-control">
                        @foreach($tours as $tour)
                            <option value="{{$tour->id}}"
                                    @if($services_content->tour_id_two==$tour->id)
                                    selected
                                    @endif
                            >{{$tour->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="for_fit_image">{{trans('admin.for_fit_image')}}</label>
                    @if($services_content->for_fit_image)
                        <img class="img-responsive old-image" src="{{asset($services_content->for_fit_image)}}">
                    @endif
                    <input type="file" name="for_fit_image" id="for_fit_image" class="form-control">
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
<script src="{{ asset('vendor/backpack/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('vendor/backpack/ckeditor/adapters/jquery.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.ckeditor-content').ckeditor({
            "filebrowserBrowseUrl": "{{ url(config('backpack.base.route_prefix').'/elfinder/ckeditor') }}",
        });
    });
</script>
@endpush