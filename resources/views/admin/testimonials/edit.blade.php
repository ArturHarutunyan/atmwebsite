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
                {{trans('admin.edit_the_testimonial')}}
            </h2>
            <form action="{{route('testimonial.update',['id'=>$testimonial->id])}}" method="post" enctype="multipart/form-data">
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
                                <label for="author_{{$lang}}">{{Lang::get('admin.author',[],$lang)}}</label>
                                <input type="text" name="author_{{$lang}}" id="author_{{$lang}}" value="{{$testimonial->getTranslation($lang)->author}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="ckeditor-content_{{$lang}}">{{Lang::get('admin.content',[],$lang)}}</label>
                                <textarea id="ckeditor-content_{{$lang}}" class="ckeditor-content" name="text_content_{{$lang}}" class="form-control">{{$testimonial->getTranslation($lang)->text_content}}</textarea>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <label>{{trans('admin.author_gender')}}</label>
                    @if($testimonial->gender==0)
                        <label for="male">{{trans('admin.male')}}</label>
                        <input type="radio" name="gender" id="male" value="0" checked="checked">
                        <label for="female">{{trans('admin.female')}}</label>
                        <input type="radio" name="gender" id="female" value="1">
                    @else
                        <label for="male">{{trans('admin.male')}}</label>
                        <input type="radio" name="gender" id="male" value="0">
                        <label for="female">{{trans('admin.female')}}</label>
                        <input type="radio" name="gender" id="female" value="1" checked="checked">
                    @endif
                </div>
                <div class="form-group">
                    <label for="author_image">{{trans('admin.author_image')}}</label>
                    @if($testimonial->author_image)
                        <img class="img-responsive old-image" src="{{asset($testimonial->author_image)}}">
                    @endif
                    <input type="file" name="author_image" id="author_image" class="form-control">
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