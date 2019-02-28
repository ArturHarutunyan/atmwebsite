@extends('backpack::layout')
@push('after_styles')
<link href="{{asset('css/custom.css')}}" rel="stylesheet">
<link href="{{asset('css/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet">
<link href="{{asset('css/jquery-ui/jquery-ui.theme.min.css')}}" rel="stylesheet">
<link href="{{asset('css/jquery-ui/jquery-ui.structure.min.css')}}" rel="stylesheet">
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
                {{trans('admin.edit_the_certificate')}}
            </h2>
            <form action="{{route('certificate.update',['id'=>$certificate->id])}}" method="post" enctype="multipart/form-data">
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
                                <label for="title_{{$lang}}">{{Lang::get('admin.title',[],$lang)}}</label>
                                <input type="text" name="title_{{$lang}}" id="title_{{$lang}}" value="{{$certificate->getTranslation($lang)->title}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="text_content_{{$lang}}">{{Lang::get('admin.text_content',[],$lang)}}</label>
                                <textarea id="text_content_{{$lang}}" class="ckeditor-content" name="text_content_{{$lang}}" class="form-control">{{$certificate->getTranslation($lang)->text_content}}</textarea>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <label for="image">{{trans('admin.image')}}</label>
                    @if($certificate->image)
                        <img class="img-responsive old-image" src="{{asset($certificate->image)}}">
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
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
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