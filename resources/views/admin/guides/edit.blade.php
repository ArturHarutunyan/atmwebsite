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
                {{trans('admin.edit_the_guide')}}
            </h2>
            <form action="{{route('guide.update',['id'=>$guide->id])}}" method="post" enctype="multipart/form-data">
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
                                <label for="name_{{$lang}}">{{Lang::get('admin.staff_name',[],$lang)}}</label>
                                <input type="text" name="name_{{$lang}}" id="name_{{$lang}}" value="{{$guide->getTranslation($lang)->name}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="surname_{{$lang}}">{{Lang::get('admin.surname',[],$lang)}}</label>
                                <input type="text" name="surname_{{$lang}}" id="surname_{{$lang}}" value="{{$guide->getTranslation($lang)->surname}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="language_{{$lang}}">{{Lang::get('admin.language',[],$lang)}}</label>
                                <input type="text" name="language_{{$lang}}" id="language_{{$lang}}" value="{{$guide->getTranslation($lang)->language}}" class="form-control">
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <label for="facebook">Facebook</label>
                    <input type="text" name="facebook" id="facebook" value="{{$guide->facebook}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="linkedin">Linked In</label>
                    <input type="text" name="linkedin" id="linkedin" value="{{$guide->linkedin}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="image">{{trans('admin.image')}}</label>
                    @if($guide->image)
                        <img class="img-responsive old-image" src="{{asset($guide->image)}}">
                    @endif
                    <input type="file" name="image" id="image" class="form-control">
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