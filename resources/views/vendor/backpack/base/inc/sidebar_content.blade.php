<?php
$lang=App::getLocale();
?>
<!-- Users, Roles Permissions -->

<li class="treeview">
    <a href="#">
        @foreach(config('translatable.locales') as $key=>$value)
            @if($key==App::getLocale())
                <span>{{ $value }}</span>
            @endif
        @endforeach
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
    @foreach(config('translatable.locales') as $key=>$value)
        <li><a href="{{route('lang.switch',['language'=>$key])}}">{{$value}}</a></li>
    @endforeach
    </ul>
</li>

<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ route('backpack.dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
<li><a href="{{ backpack_url( 'language') }}"><i class="fa fa-flag-o"></i> <span>{{ trans('site.languages') }}</span></a></li>
<li><a href="{{ route('backpack.languages', ['lang'=>$lang]) }}"><i class="fa fa-language"></i> <span>{{ trans('site.language_files') }}</span></a></li>
{{--
<li><a href="en/admin/language/texts"><i class="fa fa-language"></i> <span>Language Files</span></a></li>
--}}
{{--
<li><a href="{{ backpack_url('page') }}"><i class="fa fa-file-o"></i> <span>{{ trans('site.pages') }}</span></a></li>
--}}

<li><a href="{{ backpack_url("elfinder") }}"><i class="fa fa-files-o"></i> <span>{{ trans('site.file_manager') }}</span></a></li>
{{--
<li><a href="{{route('admin.elfinder', ['lang'=>$lang, 'token'=>csrf_token()])}}"><i class="fa fa-files-o"></i> <span>{{ trans('site.file_manager') }}</span></a></li>
--}}
<li><a href="{{ backpack_url('backup') }}"><i class="fa fa-hdd-o"></i> <span>{{ trans('site.backups') }}</span></a></li>
<li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/log') }}"><i class="fa fa-terminal"></i> <span>{{ trans('site.logs') }}</span></a></li>
<li class="treeview">
    <a href="#"><i class="fa fa-group"></i> <span>Users, Roles, Permissions</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li><a href="{{ backpack_url('user') }}"><i class="fa fa-user"></i> <span>Users</span></a></li>
        <li><a href="{{ backpack_url('role') }}"><i class="fa fa-group"></i> <span>Roles</span></a></li>
        <li><a href="{{ backpack_url('permission') }}"><i class="fa fa-key"></i> <span>Permissions</span></a></li>
    </ul>
</li>
<li><a href="{{route('testimonials')}}"><i class="fa fa-star-o"></i> <span>{{ trans('site.testimonials') }}</span></a></li>
<li><a href="{{route('partners')}}"><i class="fa fa-handshake-o"></i> <span>{{ trans('site.partners') }}</span></a></li>
<li><a href="{{route('projects')}}"> <span>{{ trans('admin.projects') }}</span></a></li>
<li class="treeview">
    <a href="#">
        <i class="fa fa-cogs"></i>
        <span>{{ trans('site.tour_data') }}</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{route('tours')}}">{{ trans('site.tours') }}</a></li>
        <li><a href="{{route('tour_types')}}">{{ trans('site.tour_types') }}</a></li>
        <li><a href="{{route('currencies')}}">{{ trans('site.currencies') }}</a></li>
        <li><a href="{{route('tour_periods')}}">{{ trans('site.tour_periods') }}</a></li>
        <li><a href="{{route('tour_seasons')}}">{{ trans('site.tour_seasons') }}</a></li>
        <li><a href="{{route('tour_group_sizes')}}">{{ trans('site.tour_group_sizes') }}</a></li>
        <li><a href="{{route('tour_days')}}">{{ trans('site.tour_days') }}</a></li>
    </ul>
</li>
<li><a href="{{route('hotel_categories')}}"><span>{{ trans('site.hotel_categories') }}</span></a></li>
<li><a href="{{route('hotels')}}"><i class="fa fa-h-square" aria-hidden="true"></i> <span>{{ trans('site.hotels') }}</span></a></li>
<li><a href="{{route('meals_and_caterings')}}"><i class="fa fa-cutlery" aria-hidden="true"></i> <span>{{ trans('admin.meals_and_caterings') }}</span></a></li>
<li><a href="{{route('staff_members')}}"><i class="fa fa-users" aria-hidden="true"></i> <span>{{ trans('site.staff_members') }}</span></a></li>
<li><a href="{{route('guides')}}"><i class="fa fa-users" aria-hidden="true"></i> <span>{{ trans('admin.guides') }}</span></a></li>
<li><a href="{{route('entertainments')}}"><span>{{ trans('admin.entertainments') }}</span></a></li>
<li><a href="{{route('sightseeing_types')}}"><span>{{ trans('admin.sightseeing_types') }}</span></a></li>
<li><a href="{{route('sightseeing_places')}}"><span>{{ trans('admin.sightseeing_places') }}</span></a></li>
<li><a href="{{route('events')}}"><span>{{ trans('admin.events') }}</span></a></li>
<li><a href="{{route('food_and_drinks')}}"><i class="fa fa-cutlery" aria-hidden="true"></i> <span>{{ trans('admin.food_and_drinks') }}</span></a></li>
<li><a href="{{route('news')}}"><span>{{ trans('admin.news') }}</span></a></li>
<li><a href="{{route('blogs')}}"><span>{{ trans('admin.blog') }}</span></a></li>
<li><a href="{{route('trustees')}}"><span>{{ trans('admin.trustees') }}</span></a></li>
<li><a href="{{route('certificates')}}"><span>{{ trans('admin.certificates') }}</span></a></li>
<li><a href="{{route('photos')}}"><span>{{ trans('admin.photos') }}</span></a></li>
<li><a href="{{route('videos')}}"><span>{{ trans('admin.videos') }}</span></a></li>
<li><a href="{{route('page_names')}}"><span>{{ trans('admin.page_names') }}</span></a></li>
<li><a href="{{route('custom_meta_tags')}}"><span>{{ trans('admin.custom_meta_tags') }}</span></a></li>
<li><a href="{{route('home_page_contents')}}"><span>{{ trans('site.home_page_contents') }}</span></a></li>
<li><a href="{{route('about_contents')}}"><span>{{ trans('site.about_page_content') }}</span></a></li>
<li><a href="{{route('about_armenia_contents')}}"><span>{{ trans('admin.about_armenia_page_content') }}</span></a></li>
<li><a href="{{route('services_contents')}}"><span>{{ trans('admin.services_page_content') }}</span></a></li>
<li><a href="{{route('tourist_info_contents')}}"><span>{{ trans('admin.tourist_info_content') }}</span></a></li>