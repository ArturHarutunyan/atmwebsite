<?php
use App\CustomMetaTag;
use App\TourType;

$types=TourType::all();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! MetaTag::openGraph() !!}
    {!! MetaTag::twitterCard() !!}
    @yield('custom_meta')
    <title>{{trans('site.armenia_travel')}}</title>
    @yield('before_styles')
    <link rel="icon" href="{{asset('uploads/images/main/favicon.ico')}}"  type="image/x-icon">
    <link href="{{ asset('css/libs.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/site.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui/jquery-ui.structure.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui/jquery-ui.theme.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @yield('after_styles')
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/libs.min.js')}}"></script>
    <script src="{{asset('js/owl_carousel_custom.js')}}"></script>
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>
    @yield('before_scripts')
    <script src="{{asset('js/site.js')}}"></script>

    
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" > (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter48067601 = new Ya.Metrika({ id:48067601, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img class="not-intersection" src="https://mc.yandex.ru/watch/48067601" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->

    <!-- Global site tag (gtag.js) - Google Analytics -->

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-115536897-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-115536897-1');
    </script>
</head>
<body class="body">
<div class="preloader_container">
        <img class="not-intersection" src="{{asset('uploads/images/main/globus.gif')}}" alt="preloader">
</div>
<div id="MainBlock" style="visibility: hidden">
<!-- header section -->
<header class="header{{$header_class}}" id="headerBlock">
    <div class="wrapper">
        <div class="header--wrapper">
            <a href="{{route('website')}}" class="header__logo">
                <!-- <img class="not-intersection" src="{{asset('uploads/images/main/logo.png')}}" alt="header-logo"/> -->
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" width="300px" height="62px" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd; " viewBox="0 0 2732 354">
							 <defs>
							  <style type="text/css">
							   
							    .fil14 {fill:#606062}
							    .fil7 {fill:url(#id0)}
							    .fil3 {fill:url(#id1)}
							    .fil11 {fill:url(#id2)}
							    .fil6 {fill:url(#id3)}
							    .fil4 {fill:url(#id4)}
							    .fil2 {fill:url(#id5)}
							    .fil5 {fill:url(#id6)}
							    .fil12 {fill:url(#id7)}
							    .fil1 {fill:url(#id8)}
							    .fil9 {fill:url(#id9)}
							    .fil0 {fill:url(#id10)}
							    .fil13 {fill:url(#id11)}
							    .fil10 {fill:url(#id12)}
							    .fil8 {fill:url(#id13)}
							   
							  </style>
							  <linearGradient id="id0" gradientUnits="userSpaceOnUse" x1="342.738" y1="94.6062" x2="430.872" y2="399.154">
							   <stop offset="0" style="stop-opacity:1; stop-color:#FAC42C"/>
							   <stop offset="1" style="stop-opacity:1; stop-color:#F0553B"/>
							  </linearGradient>
							  <linearGradient id="id1" gradientUnits="userSpaceOnUse" x1="342.146" y1="-27.5978" x2="77.0886" y2="355.721">
							   <stop offset="0" style="stop-opacity:1; stop-color:#353B6C"/>
							   <stop offset="0.858824" style="stop-opacity:1; stop-color:#C83437"/>
							   <stop offset="1" style="stop-opacity:1; stop-color:#A83436"/>
							  </linearGradient>
							  <linearGradient id="id2" gradientUnits="userSpaceOnUse" x1="210.026" y1="63.9899" x2="372.502" y2="404.445">
							   <stop offset="0" style="stop-opacity:1; stop-color:#FAD727"/>
							   <stop offset="1" style="stop-opacity:1; stop-color:#E77437"/>
							  </linearGradient>
							  <linearGradient id="id3" gradientUnits="userSpaceOnUse" x1="210.026" y1="54.1175" x2="372.501" y2="406.155">
							   <stop offset="0" style="stop-opacity:1; stop-color:#FAC42C"/>
							   <stop offset="1" style="stop-opacity:1; stop-color:#E55838"/>
							  </linearGradient>
							  <linearGradient id="id4" gradientUnits="userSpaceOnUse" x1="72.6755" y1="295.154" x2="113.984" y2="89.8318">
							   <stop offset="0" style="stop-opacity:1; stop-color:#D55839"/>
							   <stop offset="0.760784" style="stop-opacity:1; stop-color:#F6AC31"/>
							   <stop offset="1" style="stop-opacity:1; stop-color:#BF4237"/>
							  </linearGradient>
							  <linearGradient id="id5" gradientUnits="userSpaceOnUse" x1="409.422" y1="-27.8529" x2="86.974" y2="355.736">
							   <stop offset="0" style="stop-opacity:1; stop-color:#343C69"/>
							   <stop offset="0.858824" style="stop-opacity:1; stop-color:#C73437"/>
							   <stop offset="1" style="stop-opacity:1; stop-color:#9F3335"/>
							  </linearGradient>
							  <linearGradient id="id6" gradientUnits="userSpaceOnUse" x1="389.728" y1="-25.8773" x2="84.0807" y2="339.487">
							   <stop offset="0" style="stop-opacity:1; stop-color:#353C66"/>
							   <stop offset="0.65098" style="stop-opacity:1; stop-color:#D33438"/>
							   <stop offset="1" style="stop-opacity:1; stop-color:#9A383A"/>
							  </linearGradient>
							  <linearGradient id="id7" gradientUnits="userSpaceOnUse" x1="375.972" y1="265.504" x2="445.487" y2="369.61">
							   <stop offset="0" style="stop-opacity:1; stop-color:#FDC300"/>
							   <stop offset="1" style="stop-opacity:1; stop-color:#E94F09"/>
							  </linearGradient>
							  <linearGradient id="id8" gradientUnits="userSpaceOnUse" x1="683.681" y1="9.16976" x2="724.277" y2="354.841">
							   <stop offset="0" style="stop-opacity:1; stop-color:#328ECC"/>
							   <stop offset="1" style="stop-opacity:1; stop-color:#394697"/>
							  </linearGradient>
							  <linearGradient id="id9" gradientUnits="userSpaceOnUse" x1="553.204" y1="-17.0169" x2="626.854" y2="356.871">
							   <stop offset="0" style="stop-opacity:1; stop-color:#3E96D1"/>
							   <stop offset="1" style="stop-opacity:1; stop-color:#4C54A2"/>
							  </linearGradient>
							  <linearGradient id="id10" gradientUnits="userSpaceOnUse" x1="553.204" y1="-23.7422" x2="626.854" y2="357.388">
							   <stop offset="0" style="stop-opacity:1; stop-color:#1582C4"/>
							   <stop offset="1" style="stop-opacity:1; stop-color:#3D3E82"/>
							  </linearGradient>
							  <linearGradient id="id11" gradientUnits="userSpaceOnUse" xlink:href="#id3" x1="28.7917" y1="82.1995" x2="66.1085" y2="340.408">
							  </linearGradient>
							  <linearGradient id="id12" gradientUnits="userSpaceOnUse" x1="712.455" y1="162.65" x2="745.763" y2="343.039">
							   <stop offset="0" style="stop-opacity:1; stop-color:#2D8AC9"/>
							   <stop offset="1" style="stop-opacity:1; stop-color:#3A499B"/>
							  </linearGradient>
							  <linearGradient id="id13" gradientUnits="userSpaceOnUse" x1="346.312" y1="58.6994" x2="469.041" y2="12.2815">
							   <stop offset="0" style="stop-opacity:1; stop-color:#3F3868"/>
							   <stop offset="1" style="stop-opacity:1; stop-color:#2F2F41"/>
							  </linearGradient>
							 </defs>
							 <g id="Layer_x0020_1">
							  <metadata id="CorelCorpID_0Corel-Layer"/>
							  <g id="_262561888">
							   <g>
							    <path class="fil0" d="M844 309c-115,-34 -161,-186 -256,-263 -70,-55 -180,-62 -250,-14 211,-122 243,410 506,277z"/>
							    <path class="fil1" d="M844 309c-115,-34 -161,-186 -256,-263 -7,-5 -15,-11 -23,-15 61,36 27,162 91,251 49,46 108,67 188,27z"/>
							    <path class="fil2" d="M471 44c-89,25 -136,144 -202,223 -61,72 -150,94 -238,30 35,14 73,0 116,-40 25,-24 56,-61 93,-112 34,-47 51,-76 98,-113 54,-31 96,-20 133,12z"/>
							    <path class="fil3" d="M308 215c-13,18 -26,36 -39,52 -61,72 -150,94 -238,30 35,14 73,0 116,-40 25,-24 56,-61 93,-112 34,-47 51,-76 98,-113 20,-11 38,-17 55,-18 -54,41 -68,122 -85,201z"/>
							    <path class="fil4" d="M190 126c-62,10 -149,121 -82,161l0 0c-28,16 -53,20 -77,10 -69,-65 -10,-148 54,-189 44,-24 77,-9 105,18z"/>
							    <path class="fil5" d="M69 319c-12,-5 -25,-13 -38,-22 35,14 73,0 116,-40 25,-24 56,-61 93,-112 34,-47 51,-76 98,-113 43,-25 78,-23 110,-5 -27,-8 -56,-5 -91,15 -48,38 -66,68 -101,116 -38,52 -69,91 -95,114 -33,32 -64,48 -92,47z"/>
							    <path class="fil6" d="M225 167c74,97 123,231 275,174 -115,-45 -137,-166 -239,-232 -58,-36 -118,-34 -176,-1 64,-34 104,11 140,59z"/>
							    <path class="fil7" d="M375 341c33,16 73,19 125,0 -110,-43 -135,-155 -225,-222 41,35 20,130 70,200 10,8 19,16 30,22z"/>
							    <path class="fil8" d="M471 44c-13,3 -25,9 -36,16 -27,-21 -56,-34 -89,-32 50,-26 89,-14 125,16z"/>
							    <path class="fil9" d="M844 309c-6,-25 0,0 0,0 -23,3 -57,7 -78,1 -97,-25 -161,-169 -241,-250 -53,-53 -119,-75 -187,-28 0,0 0,0 0,0l0 0 0 0c211,-122 243,410 506,277z"/>
							    <path class="fil10" d="M844 309c-23,3 -57,7 -78,1 -59,-15 -105,-74 -151,-136 7,37 17,75 41,108 8,7 15,14 23,19 1,0 1,1 1,1 2,1 4,3 7,4 0,1 1,1 2,2 2,1 4,2 5,3 1,1 3,1 4,2 1,1 3,2 4,2 2,1 3,2 5,3 1,0 2,1 3,1 2,1 4,2 6,2 1,1 2,1 3,2 2,0 4,1 6,2 1,0 2,0 3,0 2,1 5,2 7,2 1,0 1,0 2,1 3,0 5,0 8,1 0,0 1,0 2,0 2,0 5,1 7,1 1,0 1,0 2,0 3,0 6,0 9,0 0,0 1,0 1,0 3,0 6,0 9,0 1,0 1,0 1,0 3,-1 7,-1 10,-2 0,0 0,0 1,0 3,0 6,-1 10,-2 0,0 0,0 0,0 4,-1 8,-2 11,-3 0,0 1,0 1,0 3,-1 7,-2 11,-4 0,0 0,0 0,0 4,-1 8,-3 12,-4 0,-1 0,-1 0,-1 4,-1 8,-3 12,-5 0,0 0,0 0,0z"/>
							    <path class="fil11" d="M225 167c74,97 123,231 275,174l0 -1c-135,31 -192,-84 -262,-184 -35,-50 -78,-80 -137,-56 -5,2 -11,5 -16,8 64,-34 104,11 140,59z"/>
							    <path class="fil12" d="M379 343l0 0c2,1 3,2 5,2l0 0c1,1 3,1 4,2l1 0c1,1 3,1 4,2l1 0c1,0 3,1 4,1l1 0c1,0 3,1 4,1l1 0c1,1 3,1 4,1l1 0c1,1 3,1 5,1l0 0c2,0 3,0 5,1 0,0 0,0 0,0 2,0 4,0 6,0l0 0c1,0 3,0 5,0l0 0c2,0 4,0 6,0l0 0c2,0 4,0 6,0 0,0 0,0 0,0 2,0 4,0 5,-1l1 0c2,0 4,0 6,0l0 0c2,-1 4,-1 6,-1l0 0c2,-1 4,-1 6,-1l0 -1c2,0 5,0 7,-1l0 0c2,-1 4,-1 6,-2l1 0c2,0 4,-1 6,-2l0 0c2,0 5,-1 7,-2l0 0c2,-1 5,-2 7,-2l0 -1c-81,18 -133,-15 -178,-66 12,33 25,53 57,69z"/>
							    <path class="fil13" d="M89 296c-20,8 -40,8 -58,1 -69,-65 -10,-148 54,-189 3,-2 7,-3 10,-5 -67,32 -90,157 -6,193z"/>
							   </g>
							   <path class="fil14" d="M1070 252l-90 0 -21 57 -23 0 79 -209 20 0 78 209 -22 0 -21 -57zm99 -73c-7,6 -11,14 -13,23l0 107 -22 0 0 -157 19 0 2 21c13,-20 34,-28 56,-21l-3 20c-14,-1 -27,-3 -39,7zm83 -7c4,-6 9,-11 16,-15 9,-5 19,-8 30,-8 11,0 21,3 30,9 8,6 13,13 16,21 4,-8 10,-15 18,-20 9,-7 20,-10 32,-10 16,0 29,5 39,17 12,14 14,35 14,52l0 91 -22 0 0 -92c0,-11 -1,-28 -9,-38 -7,-7 -16,-10 -26,-10 -10,0 -20,3 -28,11 -7,9 -11,19 -12,30 0,1 0,2 0,2 0,1 0,2 0,3l0 94 -22 0 0 -92c0,-11 -2,-28 -10,-37 -6,-8 -15,-11 -25,-11 -10,0 -19,2 -27,8 -7,6 -11,14 -13,23l0 109 -22 0 0 -157 19 0 2 20zm246 61l0 2c0,15 4,29 13,41 9,11 20,16 34,16 8,0 17,-1 26,-4 6,-3 12,-7 18,-12l2 -2 10 16 -2 1c-6,7 -14,12 -22,15 -10,4 -21,6 -32,6 -20,0 -36,-8 -49,-22 -14,-16 -20,-35 -20,-55l0 -8c0,-21 6,-40 19,-55 13,-15 29,-23 48,-23 17,0 33,6 45,19 13,13 17,31 17,49l0 16 -107 0zm156 -60c4,-6 10,-11 16,-16 10,-5 20,-8 31,-8 15,0 29,5 39,16 11,13 14,33 14,49l0 95 -22 0 0 -95c0,-11 -1,-27 -9,-35 -7,-8 -16,-10 -26,-10 -10,0 -19,2 -27,9 -7,6 -12,14 -15,23l0 108 -22 0 0 -157 20 0 1 21zm162 136l-21 0 0 -157 21 0 0 157zm0 -195l-21 0 0 -29 21 0 0 29zm136 174c-5,6 -11,11 -19,15 -10,6 -21,9 -32,9 -13,0 -27,-4 -36,-13 -10,-9 -13,-20 -13,-33 0,-15 6,-27 19,-36 14,-10 33,-13 50,-13l31 0 0 -16c0,-9 -3,-17 -9,-24 -8,-6 -18,-8 -28,-8 -10,0 -19,2 -27,8 -7,5 -11,11 -11,20l0 2 -20 0 -1 -3 0 0c0,-14 7,-24 17,-33 12,-10 27,-14 43,-14 15,0 30,4 42,14 11,10 16,23 16,38l0 75c0,5 0,10 1,15 0,5 1,10 3,14l1 4 -23 0 -1 -2c-1,-5 -2,-9 -2,-14 0,-1 -1,-3 -1,-5zm138 -169l0 190 -22 0 0 -190 -70 0 0 -19 162 0 0 19 -70 0zm142 52c-9,0 -17,2 -24,8 -7,6 -11,14 -13,23l0 107 -22 0 0 -157 19 0 2 21c4,-6 8,-11 14,-15 8,-6 18,-9 28,-9 2,0 4,1 7,1 1,0 3,1 5,1l2 1 -3 20 -15 -1zm131 117c-5,6 -11,11 -19,15 -10,6 -21,9 -32,9 -14,0 -27,-4 -36,-13 -10,-9 -13,-20 -13,-33 0,-15 6,-27 19,-36 14,-10 33,-13 50,-13l31 0 0 -16c0,-9 -3,-17 -10,-24 -7,-6 -17,-8 -27,-8 -10,0 -20,2 -28,8 -6,5 -10,11 -10,20l0 2 -20 0 -1 -3 0 0c-1,-14 6,-24 17,-33 12,-10 27,-14 43,-14 15,0 30,4 42,14 11,10 16,23 16,38l0 75c0,5 0,10 1,15 0,5 1,10 3,14l0 4 -22 0 -1 -2c-1,-5 -2,-9 -2,-14 0,-1 -1,-3 -1,-5zm110 -10l3 -11 42 -115 23 0 -59 157 -17 0 -60 -157 23 0 42 115 3 11zm100 -45l0 2c0,15 4,29 13,41 9,11 20,16 34,16 9,0 18,-1 26,-4 7,-3 13,-7 18,-12l2 -2 10 16 -1 1c-7,7 -15,12 -23,15 -10,4 -21,6 -32,6 -20,0 -36,-8 -49,-22 -14,-16 -20,-35 -20,-55l0 -8c0,-21 6,-40 20,-55 12,-15 28,-23 47,-23 17,0 33,6 45,19 13,13 17,31 17,49l0 16 -107 0zm159 76l-22 0 0 -224 22 0 0 224zm-1745 -77l75 0 -37 -102 -38 102zm512 -18l84 0 0 -2c0,-11 -3,-22 -11,-31 -8,-9 -18,-12 -29,-12 -12,0 -22,4 -30,13 -8,9 -12,20 -14,32zm453 50l0 -29 -31 0c-12,0 -25,2 -35,9 -8,6 -13,13 -13,23 0,7 3,13 8,18 6,5 14,7 22,7 11,0 21,-2 30,-8 8,-5 15,-12 19,-20zm411 0l0 -29 -31 0c-12,0 -25,2 -35,9 -8,6 -13,13 -13,23 0,7 3,13 8,18 6,5 14,7 22,7 10,0 21,-2 30,-8 8,-5 15,-12 19,-20zm212 -50l83 0 0 -2c0,-11 -3,-22 -11,-31 -7,-9 -18,-12 -29,-12 -12,0 -22,4 -30,13 -8,9 -12,20 -13,32z"/>
							  </g>
							 </g>
							</svg>
            </a>
            <a href="{{route('website')}}" class="header__logo--small">
                <img class="not-intersection" src="{{asset('uploads/images/main/logo-s.png')}}" alt="header-logo"/>
            </a>
            <div class="header-mobile">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <ul class="header__list">
            <li class="header__item header__mobile-languagePicker">
                @foreach(config('translatable.locales') as $key=>$value)
                    @if($key!==App::getLocale()&&$key!=='de')
                        <a href="{{route('lang.switch',['language'=>$key, 'hash'=>'#'])}}" class="header__mobile-languagePicker__link">{{$key}}</a>
                    @endif
                @endforeach
            </li>
            <li class="header__item">
                <a href="{{route('about')}}" class="header__link {{Route::is('about') ? 'header__link--active' : ''}}">{{trans('site.about')}}</a>
            </li>
            <li class="header__item">
                <a href="{{route('website_tours')}}" class="header__link {{Route::is('website_tours') ? 'header__link--active' : ''}}">{{trans('site.tours')}}</a>
            </li>
            <li class="header__item">
                <a href="{{route('services')}}" class="header__link {{Route::is('services') ? 'header__link--active' : ''}}">{{trans('site.services')}}</a>
            </li>
            <li class="header__item">
                <a href="{{route('website_news')}}" class="header__link {{Route::is('website_news') ? 'header__link--active' : ''}}">{{trans('site.pr')}}</a>
            </li>
            <li class="header__item">
                <a href="{{route('armenia')}}" class="header__link {{Route::is('armenia') ? 'header__link--active' : ''}}">{{trans('site.armenia')}}</a>
            </li>
            <li class="header__item">
                <a href="{{route('contact')}}" class="header__link {{Route::is('contact') ? 'header__link--active' : ''}}">{{trans('site.contact_us')}}</a>
            </li>
            <li class="header__item header__item--hidden">
                <div class="header__languagePicker" onclick="dropdown_function()">
                    <button class="header__languagePicker__button">{{App::getLocale()}}</button>
                    <img class="not-intersection" src="{{asset('uploads/images/main/lang-arrow.png')}}" alt="language arrow">
                </div>
                <div id="header__languagePicker-dropDown" class="header__languagePicker__content show">
                    @foreach(config('translatable.locales') as $key=>$value)
                        @if($key!==App::getLocale()&&$key!=='de')
                            <a href="{{route('lang.switch',['language'=>$key, 'hash'=>'#'])}}" class="header__languagePicker__link">{{$key}}</a>
                        @endif
                    @endforeach
                </div>
            </li>
        </ul>
    </div>
</header>

@yield('content')

<!-- footer section -->
<footer class="footer higherThanSvg">
    <div class="wrapper">
        <div class="footer-top">
            <div class="footer-top__col">
                <h5 class="footer__title">{{trans('site.about')}}</h5>
                <ul class="footer__list">
                    <li class="footer__item">
                        <a href="{{route('about')}}#about_company" class="footer__link">{{trans('site.company')}}</a>
                    </li>
                    <li class="footer__item">
                        <a href="{{route('about')}}#about-team" class="footer__link">{{trans('site.team')}}</a>
                    </li>
                    <li class="footer__item">
                        <a href="{{route('about')}}#about-project" class="footer__link">{{trans('site.our')}} {{trans('site.projects')}}</a>
                    </li>
                    <li class="footer__item">
                        <a href="{{route('about')}}#about-dmc" class="footer__link">{{trans('site.dmc_text')}}</a>
                    </li>
                    <li class="footer__item">
                        <a href="{{route('about')}}#about-pratner" class="footer__link">{{trans('site.for_partners')}}</a>
                    </li>
                    <li class="footer__item">
                        <a href="{{route('about')}}#about-whyMe" class="footer__link">{{trans('site.why_me')}}</a>
                    </li>
                </ul>
            </div>
            <div class="footer-top__col">
                <h5 class="footer__title">{{trans('site.tours')}}</h5>
                <ul class="footer__list">
                    @foreach($types as $type)
                        <li class="footer__item">
                            <a href="{{route('website_tours')}}#{{$type->id}}" class="footer__link">{{$type->name}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="footer-top__col">
                <h5 class="footer__title">{{trans('site.services')}}</h5>
                <ul class="footer__list">
                    <li class="footer__item">
                        <a href="{{route('services')}}#service-packages" class="footer__link">{{trans('site.tour_packages_part_1')}} {{trans('site.tour_packages_part_2')}}</a>
                    </li>
                    <li class="footer__item">
                        <a href="{{route('services')}}#service-reserve" class="footer__link">{{trans('site.hotel_reservation_part_1')}} {{trans('site.hotel_reservation_part_2')}}</a>
                    </li>
                    <li class="footer__item">
                        <a href="{{route('services')}}#service-transport" class="footer__link">{{trans('site.transport')}}</a>
                    </li>
                    <li class="footer__item">
                        <a href="{{route('services')}}#service-guides" class="footer__link">{{trans('site.excursions_part_1')}} {{trans('site.excursions_part_2')}}</a>
                    </li>
                    <li class="footer__item">
                        <a href="{{route('services')}}#service-organization" class="footer__link">{{trans('site.mice_organization')}}</a>
                    </li>
                </ul>
            </div>

            <div class="footer-top__col">
                <h5 class="footer__title">{{trans('site.pr')}}</h5>
                <ul class="footer__list">
                    <li class="footer__item">
                        <a href="{{route('website_news')}}#tab-1" class="footer__link">{{trans('site.news')}}</a>
                    </li>
                    <li class="footer__item">
                        <a href="{{route('website_news')}}#tab-2" class="footer__link">{{trans('site.gallery')}}</a>
                    </li>
                    <li class="footer__item">
                        <a href="{{route('website_news')}}#tab-3" class="footer__link">{{trans('site.blog')}}</a>
                    </li>
                    <li class="footer__item">
                        <a href="{{route('website_news')}}#tab-4" class="footer__link">{{trans('site.reviews')}}</a>
                    </li>
                    <li class="footer__item">
                        <a href="{{route('website_news')}}#tab-5" class="footer__link">{{trans('site.certificates')}}</a>
                    </li>
                    <li class="footer__item">
                        <a href="{{route('website_news')}}#tab-6" class="footer__link">{{trans('site.trustees')}}</a>
                    </li>
                </ul>
            </div>
            <div class="footer-top__col">
                <h5 class="footer__title">{{trans('site.armenia')}}</h5>
                <ul class="footer__list">
                    <li class="footer__item">
                        <a href="{{route('armenia')}}#tab-1" class="footer__link">{{trans('site.about_armenia')}}</a>
                    </li>
                    <li class="footer__item">
                        <a href="{{route('armenia')}}#tab-3" class="footer__link">{{trans('site.sightseeing')}}</a>
                    </li>
                    <li class="footer__item">
                        <a href="{{route('armenia')}}#tab-2" class="footer__link">{{trans('site.event_calendar')}}</a>
                    </li>
                    <li class="footer__item">
                        <a href="{{route('armenia')}}#tab-4" class="footer__link">{{trans('site.entertainments')}}</a>
                    </li>
                    <li class="footer__item">
                        <a href="{{route('armenia')}}#tab-5" class="footer__link">{{trans('site.food_and_drink')}}</a>
                    </li>
                    <li class="footer__item">
                        <a href="{{route('armenia')}}#tab-6" class="footer__link">{{trans('site.tourist_info')}}</a>
                    </li>
                </ul>
            </div>

            
            <div class="footer-top__col">
                <h5 class="footer__title">{{trans('site.contact_us')}}</h5>
                <ul class="footer__list">
                    <li class="footer__item">{{trans('site.company_address')}}</li>
                    <li class="footer__item">(+374) 10 56 36 67</li>
                    <li class="footer__item">
                        <a class="link-unstyled" href="mailto:incoming@armeniatravel.am" target="_top">incoming@armeniatravel.am</a>
                    </li>
                    <li class="footer__item footer-top__social">
                        <a href="https://www.facebook.com/AarmeniaTravelIncoming/" target="_blank" class="footer-top__social__block">
                            <img data-src="{{asset('uploads/images/main/fb-s.png')}}" alt="facebook"/>
                        </a>
                        <a href="https://twitter.com/ArmeniaTravel_" target="_blank" class="footer-top__social__block">
                            <img data-src="{{asset('uploads/images/main/tw-s.png')}}" alt="twitter"/>
                        </a>
                        <a href="https://plus.google.com/b/101216774593900676378/101216774593900676378" target="_blank" class="footer-top__social__block">
                            <img data-src="{{asset('uploads/images/main/google-s.png')}}" alt="google"/>
                        </a>
                    </li>
                </ul>
            </div>
            
        </div>
    </div>
    <div class="footer-bottom">
        <div class="wrapper footer__wrapper">
            <p class="footer__copyright">© {{trans('site.copyright')}} {{date("Y")}}. {{trans('site.copyright_text')}}</p>
            <p class="footer__design">{{trans('site.design_created')}} <img data-src="{{asset('uploads/images/main/heart.png')}}" alt="heart"/> <a class="footer__design" href="http://braind.am">{{trans('site.by_braind')}}</a></p>
        </div>
    </div>
   
</footer>
</div>
@yield('after_scripts')
</body>
</html>