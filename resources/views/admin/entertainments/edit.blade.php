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
                {{trans('admin.edit_the_entertainment')}}
            </h2>
            <form action="{{route('entertainment.update',['id'=>$entertainment->id])}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <ul class="nav nav-tabs">
                    @foreach(config('translatable.locales') as $key=>$value)
                        <li id="li-{{$key}}" class="@if(App::isLocale($key)) active @endif" onclick="activate('{{$key}}')" href="#{{$key}}"><a data-toggle="tab" >{{$value}}</a></li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    @foreach(array_keys(config('translatable.locales')) as $lang)
                        @if($entertainment->hasTranslation($lang))
                            <div id="{{$lang}}" class="tab-pane fade @if(App::isLocale($lang))in active @endif">
                                <div class="form-group">
                                    <label for="name_{{$lang}}">{{Lang::get('admin.name',[],$lang)}}</label>
                                    <input type="text" name="name_{{$lang}}" id="name_{{$lang}}" value="{{$entertainment->getTranslation($lang)->name}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="description_{{$lang}}">{{Lang::get('admin.description',[],$lang)}}</label>
                                    <textarea id="description_{{$lang}}" class="ckeditor-content" name="description_{{$lang}}" class="form-control">{{$entertainment->getTranslation($lang)->description}}</textarea>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="form-group">
                    <label for="image">{{trans('admin.image')}}</label>
                    @if($entertainment->image)
                        <img class="img-responsive old-image" src="{{asset($entertainment->image)}}">
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