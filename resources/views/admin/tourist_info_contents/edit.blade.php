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
                {{trans('admin.edit_the_tourist_info_content')}}
            </h2>
            <form action="{{route('tourist_info_content.update',['id'=>$tourist_info_content->id])}}" method="post" enctype="multipart/form-data">
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
                                <label for="visa_content_{{$lang}}">{{Lang::get('admin.visa_content',[],$lang)}}</label>
                                <textarea id="visa_content_{{$lang}}" class="ckeditor-content form-control" name="visa_content_{{$lang}}">{{$tourist_info_content->getTranslation($lang)->visa_content}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="climate_content_{{$lang}}">{{Lang::get('admin.climate_content',[],$lang)}}</label>
                                <textarea id="climate_content_{{$lang}}" class="ckeditor-content form-control" name="climate_content_{{$lang}}">{{$tourist_info_content->getTranslation($lang)->climate_content}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="currency_content_{{$lang}}">{{Lang::get('admin.currency_content',[],$lang)}}</label>
                                <textarea id="currency_content_{{$lang}}" class="ckeditor-content form-control" name="currency_content_{{$lang}}">{{$tourist_info_content->getTranslation($lang)->currency_content}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="safety_content_{{$lang}}">{{Lang::get('admin.safety_content',[],$lang)}}</label>
                                <textarea id="safety_content_{{$lang}}" class="ckeditor-content form-control" name="safety_content_{{$lang}}">{{$tourist_info_content->getTranslation($lang)->safety_content}}</textarea>
                            </div>
                        </div>
                    @endforeach
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