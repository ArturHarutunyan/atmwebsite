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
                {{trans('admin.add_new_about_armenia_content')}}
            </h2>
            <form action="{{route('about_armenia_content.store')}}" method="post" enctype="multipart/form-data">
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
                                <label for="history_content_{{$lang}}">{{Lang::get('admin.history_content',[],$lang)}}</label>
                                <textarea id="history_content_{{$lang}}" class="ckeditor-content form-control" name="history_content_{{$lang}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="culture_content_one_{{$lang}}">{{Lang::get('admin.culture_content_one',[],$lang)}}</label>
                                <textarea id="culture_content_one_{{$lang}}" class="ckeditor-content form-control" name="culture_content_one_{{$lang}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="culture_content_two_{{$lang}}">{{Lang::get('admin.culture_content_two',[],$lang)}}</label>
                                <textarea id="culture_content_two_{{$lang}}" class="ckeditor-content form-control" name="culture_content_two_{{$lang}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="religion_content_{{$lang}}">{{Lang::get('admin.religion_content',[],$lang)}}</label>
                                <textarea id="religion_content_{{$lang}}" class="ckeditor-content form-control" name="religion_content_{{$lang}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="climate_content_{{$lang}}">{{Lang::get('admin.climate_content',[],$lang)}}</label>
                                <textarea id="climate_content_{{$lang}}" class="ckeditor-content form-control" name="climate_content_{{$lang}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="climate_content_two_{{$lang}}">{{Lang::get('admin.climate_content_two',[],$lang)}}</label>
                                <textarea id="climate_content_two_{{$lang}}" class="ckeditor-content form-control" name="climate_content_two_{{$lang}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="winter_content_{{$lang}}">{{Lang::get('admin.winter_content',[],$lang)}}</label>
                                <textarea id="winter_content_{{$lang}}" class="ckeditor-content form-control" name="winter_content_{{$lang}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="spring_content_{{$lang}}">{{Lang::get('admin.spring_content',[],$lang)}}</label>
                                <textarea id="spring_content_{{$lang}}" class="ckeditor-content form-control" name="spring_content_{{$lang}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="summer_content_{{$lang}}">{{Lang::get('admin.summer_content',[],$lang)}}</label>
                                <textarea id="summer_content_{{$lang}}" class="ckeditor-content form-control" name="summer_content_{{$lang}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="autumn_content_{{$lang}}">{{Lang::get('admin.autumn_content',[],$lang)}}</label>
                                <textarea id="autumn_content_{{$lang}}" class="ckeditor-content form-control" name="autumn_content_{{$lang}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="first_reason_content_{{$lang}}">{{Lang::get('admin.first_reason_content',[],$lang)}}</label>
                                <textarea id="first_reason_content_{{$lang}}" class="ckeditor-content form-control" name="first_reason_content_{{$lang}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="second_reason_content_{{$lang}}">{{Lang::get('admin.second_reason_content',[],$lang)}}</label>
                                <textarea id="second_reason_content_{{$lang}}" class="ckeditor-content form-control" name="second_reason_content_{{$lang}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="third_reason_content_{{$lang}}">{{Lang::get('admin.third_reason_content',[],$lang)}}</label>
                                <textarea id="third_reason_content_{{$lang}}" class="ckeditor-content form-control" name="third_reason_content_{{$lang}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="third_reason_content_{{$lang}}">{{Lang::get('admin.third_reason_content',[],$lang)}}</label>
                                <textarea id="third_reason_content_{{$lang}}" class="ckeditor-content form-control" name="third_reason_content_{{$lang}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="fourth_reason_content_{{$lang}}">{{Lang::get('admin.fourth_reason_content',[],$lang)}}</label>
                                <textarea id="fourth_reason_content_{{$lang}}" class="ckeditor-content form-control" name="fourth_reason_content_{{$lang}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="fifth_reason_content_{{$lang}}">{{Lang::get('admin.fifth_reason_content',[],$lang)}}</label>
                                <textarea id="fifth_reason_content_{{$lang}}" class="ckeditor-content form-control" name="fifth_reason_content_{{$lang}}"></textarea>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <label for="history_image">{{trans('admin.history_image')}}</label>
                    <input type="file" name="history_image" id="history_image" class="form-control">
                </div>
                <div class="form-group">
                    <label for="religion_image">{{trans('admin.religion_image')}}</label>
                    <input type="file" name="religion_image" id="religion_image" class="form-control">
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">{{trans('admin.store')}}</button>
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