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
                {{trans('admin.edit_the_home_page_content')}}
            </h2>
            <form action="{{route('home_page_content.update',['id'=>$home_page_content->id])}}" method="post" enctype="multipart/form-data">
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
                                <label for="ckeditor-who_we_are_content_{{$lang}}">{{trans('admin.who_we_are_content')}}</label>
                                <textarea id="ckeditor-who_we_are_content_{{$lang}}" class="ckeditor-content" name="who_we_are_content_{{$lang}}" class="form-control">{{$home_page_content->getTranslation($lang)->who_we_are_content}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="ckeditor-the_best_tours_content_{{$lang}}">{{trans('admin.the_best_tours_content')}}</label>
                                <textarea id="ckeditor-the_best_tours_content_{{$lang}}" class="ckeditor-content" name="the_best_tours_content_{{$lang}}" class="form-control">{{$home_page_content->getTranslation($lang)->the_best_tours_content}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="ckeditor-unique_services_content_{{$lang}}">{{trans('admin.unique_services_content')}}</label>
                                <textarea id="ckeditor-unique_services_content_{{$lang}}" class="ckeditor-content" name="unique_services_content_{{$lang}}" class="form-control">{{$home_page_content->getTranslation($lang)->unique_services_content}}</textarea>
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
    <script>
        $(document).ready(function(){
            ClassicEditor
                .create( document.querySelector( '#who_we_are_content' ) )
                .then( editor => {
                window.myEditor = editor
            });
            ClassicEditor
                .create( document.querySelector( '#the_best_tours_content' ) )
                .then( editor => {
                window.myEditor = editor
            });
        });
    </script>
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