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
    <div class="panel panel-default" id="main">

        <div class="panel-body">
            <h2>
                {{trans('admin.add_a_new_sightseeing_place')}}
            </h2>
            <form action="{{route('sightseeing_place.store')}}" method="post" enctype="multipart/form-data">
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
                                <input type="text" id="name_{{$lang}}" name="name_{{$lang}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="ckeditor-content_{{$lang}}">{{Lang::get('admin.description',[],$lang)}}</label>
                                <textarea id="ckeditor-content_{{$lang}}" class="ckeditor-content" name="description_{{$lang}}" class="form-control"></textarea>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <label for="sightseeing_type_id">{{trans('admin.type')}}</label>
                    <select name="sightseeing_type_id" id="sightseeing_type_id" class="form-control">
                        @foreach($sightseeing_types as $sightseeing_type)
                            <option value="{{$sightseeing_type->id}}">{{$sightseeing_type->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">{{trans('admin.image')}}</label>
                    <input type="file" name="image" id="image" class="form-control">
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
<script src="{{asset('js/app.js')}}"></script>
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