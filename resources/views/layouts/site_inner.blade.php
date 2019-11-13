<?php
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
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
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
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml            : true,
                version          : 'v5.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <!-- Your customer chat code -->
    <div class="fb-customerchat"
         attribution=setup_tool
         page_id="1255397087852894"
         theme_color="#0056b3"
         logged_in_greeting="Welcome to Armenia Travel "
         logged_out_greeting="Welcome to Armenia Travel ">
    </div>
    <div class="preloader_container">
        <picture>
            <source type=”image/webp” srcset="{{asset('uploads/images/main/globus.webp')}}"/>
            <img class="not-intersection" src="{{asset('uploads/images/main/globus.png')}}" alt="preloader"/>
        </picture>
    </div>
<div id="MainBlock" style="visibility: hidden">
    <!-- header section -->
    <header class="header{{$header_class}}" id="headerBlock">
        <div class="wrapper">
            <div class="header--wrapper">
                <a href="{{route('website')}}" class="header__logo">
                    @include('svgs.header-logo')
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