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
                {{trans('admin.edit_the_hotel')}}
            </h2>
            <form action="{{route('hotel.update',['id'=>$hotel->id])}}" method="post" enctype="multipart/form-data">
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
                                <input type="text" name="name_{{$lang}}" id="name_{{$lang}}" value="{{$hotel->getTranslation($lang)->name}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="address_{{$lang}}">{{Lang::get('admin.address',[],$lang)}}</label>
                                <input type="text" name="address_{{$lang}}" id="address_{{$lang}}" value="{{$hotel->getTranslation($lang)->address}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="description_{{$lang}}">{{Lang::get('admin.description',[],$lang)}}</label>
                                <textarea id="description_{{$lang}}" class="ckeditor-content" name="description_{{$lang}}" class="form-control">{{$hotel->getTranslation($lang)->description}}</textarea>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <label for="category_id">{{trans('admin.category')}}</label>
                    <select name="category_id" id="category_id" class="form-control">
                        @foreach($hotel_categories as $category)
                            <option value="{{$category->id}}"
                                @if($hotel->category->id==$category->id)
                                    selected
                                @endif
                            >{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    @if($hotel->is_in_yerevan==1)
                        <label for="in_yerevan">{{trans('admin.in_yerevan')}}</label>
                        <input type="radio" name="is_in_yerevan" id="in_yerevan" value="1" checked="checked">
                        <label for="not_in_yerevan">{{trans('admin.not_in_yerevan')}}</label>
                        <input type="radio" name="is_in_yerevan" id="not_in_yerevan" value="0">
                    @else
                        <label for="in_yerevan">{{trans('admin.in_yerevan')}}</label>
                        <input type="radio" name="is_in_yerevan" id="in_yerevan" value="1">
                        <label for="not_in_yerevan">{{trans('admin.not_in_yerevan')}}</label>
                        <input type="radio" name="is_in_yerevan" id="not_in_yerevan" value="0" checked="checked">
                    @endif
                </div>
                <div class="form-group">
                    <label for="link">Link</label>
                    <input type="text" name="link" id="link" value="{{$hotel->link}}" class="form-control">
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