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
                {{trans('admin.add_new_about_page_content')}}
            </h2>
            <form action="{{route('about_content.store')}}" method="post" enctype="multipart/form-data">
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
                                <label for="company_content_{{$lang}}">{{Lang::get('admin.company_content',[],$lang)}}</label>
                                <textarea id="company_content_{{$lang}}" class="ckeditor-content form-control" name="company_content_{{$lang}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="our_projects_content_{{$lang}}">{{Lang::get('admin.our_projects_content',[],$lang)}}</label>
                                <textarea id="our_projects_content_{{$lang}}" class="ckeditor-content form-control" name="our_projects_content_{{$lang}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="dmc_content_{{$lang}}">{{Lang::get('admin.dmc_content',[],$lang)}}</label>
                                <textarea id="dmc_content_{{$lang}}" class="ckeditor-content form-control" name="dmc_content_{{$lang}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="excursion_content_{{$lang}}">{{Lang::get('admin.excursion_content',[],$lang)}}</label>
                                <textarea id="excursion_content_{{$lang}}" class="ckeditor-content form-control" name="excursion_content_{{$lang}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="logistics_content_{{$lang}}">{{Lang::get('admin.logistics_content',[],$lang)}}</label>
                                <textarea id="logistics_content_{{$lang}}" class="ckeditor-content form-control" name="logistics_content_{{$lang}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="special_events_content_{{$lang}}">{{Lang::get('admin.special_events_content',[],$lang)}}</label>
                                <textarea id="special_events_content_{{$lang}}" class="ckeditor-content form-control" name="special_events_content_{{$lang}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="for_partners_content_{{$lang}}">{{Lang::get('admin.for_partners_content',[],$lang)}}</label>
                                <textarea id="for_partners_content_{{$lang}}" class="ckeditor-content form-control" name="for_partners_content_{{$lang}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="login_password_content_{{$lang}}">{{Lang::get('admin.login_password_content',[],$lang)}}</label>
                                <textarea id="login_password_content_{{$lang}}" class="ckeditor-content form-control" name="login_password_content_{{$lang}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="your_account_content_{{$lang}}">{{Lang::get('admin.your_account_content',[],$lang)}}</label>
                                <textarea id="your_account_content_{{$lang}}" class="ckeditor-content form-control" name="your_account_content_{{$lang}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="special_content_{{$lang}}">{{Lang::get('admin.special_content',[],$lang)}}</label>
                                <textarea id="special_content_{{$lang}}" class="ckeditor-content form-control" name="special_content_{{$lang}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="why_me_first_title_{{$lang}}">{{Lang::get('admin.why_me_first_title',[],$lang)}}</label>
                                <input type="text" name="why_me_first_title_{{$lang}}" id="why_me_first_title_{{$lang}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="why_me_first_content_{{$lang}}">{{Lang::get('admin.why_me_first_content',[],$lang)}}</label>
                                <textarea id="why_me_first_content_{{$lang}}" class="ckeditor-content form-control" name="why_me_first_content_{{$lang}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="why_me_second_title_{{$lang}}">{{Lang::get('admin.why_me_second_title',[],$lang)}}</label>
                                <input type="text" name="why_me_second_title_{{$lang}}" id="why_me_second_title_{{$lang}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="why_me_second_content_{{$lang}}">{{Lang::get('admin.why_me_second_content',[],$lang)}}</label>
                                <textarea id="why_me_second_content_{{$lang}}" class="ckeditor-content form-control" name="why_me_second_content_{{$lang}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="why_me_third_title_{{$lang}}">{{Lang::get('admin.why_me_third_title',[],$lang)}}</label>
                                <input type="text" name="why_me_third_title_{{$lang}}" id="why_me_third_title_{{$lang}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="why_me_third_content_{{$lang}}">{{Lang::get('admin.why_me_third_content',[],$lang)}}</label>
                                <textarea id="why_me_third_content_{{$lang}}" class="ckeditor-content form-control" name="why_me_third_content_{{$lang}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="why_me_fourth_title_{{$lang}}">{{Lang::get('admin.why_me_fourth_title',[],$lang)}}</label>
                                <input type="text" name="why_me_fourth_title_{{$lang}}" id="why_me_fourth_title_{{$lang}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="why_me_fourth_content_{{$lang}}">{{Lang::get('admin.why_me_fourth_content',[],$lang)}}</label>
                                <textarea id="why_me_fourth_content_{{$lang}}" class="ckeditor-content form-control" name="why_me_fourth_content_{{$lang}}"></textarea>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <label for="why_me_first_image">{{trans('admin.why_me_first_image')}}</label>
                    <textarea id="why_me_first_image" class="ckeditor-content form-control" name="why_me_first_image"></textarea>
                </div>
                <div class="form-group">
                    <label for="why_me_second_image">{{trans('admin.why_me_second_image')}}</label>
                    <textarea id="why_me_second_image" class="ckeditor-content form-control" name="why_me_second_image"></textarea>
                </div>
                <div class="form-group">
                    <label for="why_me_third_image">{{trans('admin.why_me_third_image')}}</label>
                    <textarea id="why_me_third_image" class="ckeditor-content form-control" name="why_me_third_image"></textarea>
                </div>
                <div class="form-group">
                    <label for="why_me_fourth_image">{{trans('admin.why_me_fourth_image')}}</label>
                    <textarea id="why_me_fourth_image" class="ckeditor-content form-control" name="why_me_fourth_image"></textarea>
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