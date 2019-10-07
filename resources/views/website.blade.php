@extends('layouts.site_inner', ['header_class' => ''])
@section('before_styles')
<link href="{{asset('css/svgStyle.css')}}" rel="stylesheet">
@endsection
@section('after_styles')
<link href="{{asset('css/extra.css')}}" rel="stylesheet">
@endsection
@section('after_scripts')

<!-- animation library -->
<script src="{{asset('js/anime-master/anime.min.js')}}"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenMax.min.js"></script> -->
<script src="{{asset('js/svgPath.js')}}"></script>
@endsection
@section('custom_meta')
@foreach($custom_meta_tags as $custom_meta_tag)
{!! MetaTag::tag($custom_meta_tag->name, $custom_meta_tag->description) !!}
@endforeach
@endsection


@section('content')


<div style='position:absolute; height:0'>

    <style>
        @media screen and (max-width:768px) {
            .messageContainer {
                top: -105px !important;
                right: 55px !important;
                width: 220px !important;
                height: 149px !important;
            }

            .wcitFicedIcon {
                left: calc(100vw - 70px) !important;
                width: 48px !important;
                height: 48px !important
            }

        }
    </style>


    <div class="wcitFicedIcon" style="
    width: 52px;
    height: 52px;
    border: 5px solid;
    border-radius: 50%;
    display: flex;
    align-items: flex-end;
    position: fixed;
    z-index: 99;
    bottom: 13px;
    color: black;
    left: calc(100vw - 124px);
    background: #fff;
    box-shadow: 0px 0px 0px 4px #fff, 0 1pt 12pt 10px rgba(0, 0, 0, .15);
    cursor: pointer;
    ">

        <div class="messageContainer" style="
                                      position: absolute;
                                      top: -170px;
                                      background: #fff;
                                      /* box-shadow: 0px 0px 9px 1px black; */
                                      /* border-radius: 7px; */
                                      /* width: 300px; */
                                      height: 150px;
                                      text-align: center;
                                      right: 0;
                                      cursor:initial;
                                      color: #1c1e21;
                                      direction: ltr;
                                      font-size: 11px;
                                      line-height: 1.28;
                                      -webkit-tap-highlight-color: transparent;
                                      background-color: #fff;
                                      border-radius: 12px;
                                      bottom: 0;
                                      box-shadow: 0 1pt 12pt rgba(0, 0, 0, .15);
                                      display: none;
                                      flex-direction: column;
                                      /* font-family: SF Pro Text, Helvetica Neue, Segoe UI, Helvetica, Arial, sans-serif; */
                                      /* height: 100%; */
                                      position: absolute;
                                      width: 360px;
                                      ">
            <p style="font-size:16px; padding:10px">We are the official travel partner of WCIT2019. Discover Armenia with our unique excursions. </p>
            <a href="/wcit" class="homePageButton" style="font-size: 16px;
                                                        padding: 8px 19px;
                                                        font-size: 17px;
                                                        display: inline-block;
                                                        color: black;
                                                        text-decoration: none;
                                                        border: 1px solid;
                                                        background-color: #fff;
                                                        border-radius: 2px;
                                                        text-align: center;
                                                        margin: auto;
                                                        /* height: 43px; */
                                                        margin-right: 18px;">Book now</a>
        </div>
        <div style="
            width: 67%;
            border-radius: 50%;
            border: 5px solid;
            display: flex;
            height: 67%;
            justify-content: center;
            align-items: center;
        ">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="26px" height="26px" viewBox="0 0 26 26" version="1.1" style="
                width: 50%;
                height: 50%;
            ">
                <!-- Generator: Sketch 52.6 (67491) - http://www.bohemiancoding.com/sketch -->
                <title>Fill 1</title>
                <desc>Created with Sketch.</desc>
                <g id="About-Event" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="About" transform="translate(-706.000000, -3965.000000)" fill="#000000">
                        <polygon id="Fill-1" transform="translate(719.000000, 3978.000000) rotate(90.000000) translate(-719.000000, -3978.000000) " points="732 3970.99149 724.991991 3978 732 3985.00758 726.008009 3991 719 3983.99242 711.991991 3991 706 3985.00758 713.008009 3978 706 3970.99149 711.991991 3965 719 3972.00851 726.008009 3965"></polygon>
                    </g>
                </g>
            </svg>
        </div>
    </div>


    <script>
        var wcitIcon = document.querySelector('.wcitFicedIcon');

        wcitIcon.onclick = function(e) {

            var target = e.target;

            if (target.closest('.messageContainer')) return;
            var showContent = wcitIcon.querySelector('.messageContainer');
            var display = wcitIcon.querySelector('.messageContainer').style.display;

            if (display == 'none')
                showContent.style.display = 'flex';
            else
                showContent.style.display = 'none';
        }
    </script>

</div>

<!-- for mozilla  -->
<div class="getBackgroundImageReady changeBackground"></div>
<!-- svg html path -->


<div class="hiddenScrollbar">
    <div> </div>
</div>
<div class="svgContainer">


    <svg xmlns:xlink="http://www.w3.org/1999/xlink" viewbox="-1600 0 2900 200" id="SVGpath" style='overflow:visible' fill="none" preserveAspectRatio="none">


        <!-- __________________________ first with path background _______________________ -->

        <path id="first_path_background" d="
         M 1256 -1205 Q 630 -561 184 -709Q -400 -904 -1043 -521Q -1800 -80.4355 -1300 300    "></path>


        <mask id="mask1">
            <use class="mask" xlink:href="#first_path_background">
        </mask>

        <use class="paths" fill='#fff' xlink:href="#first_path_background" mask="url(#mask1)" />

        <!-- ___________________________ secend path background __________________________ -->
        <path stroke="#004171" stroke-width="1.5" id="secend_path_background" data-id='secend_path_background2' d="
           M -1302 301.7 Q -420 1168.7 -1087.86 1242.89Q -1870 1403.54 -1031.935 2258.96Q -274.449 2527.01 -1200 3300"></path>





        <!-- __________________________ first  path  _______________________ -->

        <path stroke="#ffffff" stroke-width="3.5" id="first_path" d="
            M 1256 -1205 Q 630 -561 184 -709Q -400 -904 -1043 -521Q -1800 -80.4355 -1300 300   "></path>

        <!-- ___________________________ secend path  __________________________ -->
        <path stroke="#004171" stroke-width="3.5" id="secend_path" d="
               M -1302 301.7 Q -420 1168.7 -1087.86 1242.89Q -1870 1403.54 -1031.935 2258.96Q -274.449 2527.01 -1200 3300"></path>



        <!-- ____________________ circls_______________ -->
        <!-- ________________ circle 01_______________ -->

        <defs>
            <pattern id="firstBreackpointImage" height="100%" width="100%" patternContentUnits="objectBoundingBox">
                <image xlink:href="{{asset('uploads/images/main/firstBreackpoint.png')}}" preserveAspectRatio="none" width="1.05" height="1.05">

                </image>
            </pattern>
        </defs>
        <circle cx="0" cy="0" class="shadow" r="0" fill="url(#firstBreackpointImage)" id="firstBreackpoint">
        </circle>

        <!-- ________________ circle 02 _______________ -->
        <defs>
            <pattern id="secendBreackpointImage" height="100%" width="100%" patternContentUnits="objectBoundingBox">
                <image xlink:href="{{asset('uploads/images/main/secondBreackpoint.png')}}" preserveAspectRatio="none" width="1.01" height="1.01">

                </image>
            </pattern>
        </defs>
        <circle cx="0" cy="0" class="shadow" r="0" fill="url(#secendBreackpointImage)" id="secendBreackpoint">
        </circle>

        <!-- ________________ circle 03 _______________ -->

        <defs>
            <pattern id="thirdBreackpointImage" height="100%" width="100%" patternContentUnits="objectBoundingBox">
                <image xlink:href="{{asset('uploads/images/main/secondBreackpoint.png')}}" preserveAspectRatio="none" width="1.01" height="1.01">

                </image>
            </pattern>
        </defs>
        <circle cx="0" cy="0" class="shadow" r="0" fill="url(#thirdBreackpointImage)" id="thirdBreackpoint">
        </circle>

        <!-- id fordBreackpoint -->


        <defs>
            <pattern id="fordBreackpointImage" height="100%" width="100%" patternContentUnits="objectBoundingBox">
                <image xlink:href="{{asset('uploads/images/main/secondBreackpoint.png')}}" preserveAspectRatio="none" width="1.01" height="1.01">

                </image>
            </pattern>
        </defs>
        <circle cx="0" cy="0" class="shadow" r="0" fill="url(#fordBreackpointImage)" id="fordBreackpoint">
        </circle>


        <!-- ________________ circle 04 _______________ -->
        <defs>
            <pattern id="lastBreackpointImage" height="100%" width="100%" patternContentUnits="objectBoundingBox">
                <image xlink:href="{{asset('uploads/images/main/secondBreackpoint.png')}}" preserveAspectRatio="none" width="1.01" height="1.01">

                </image>
            </pattern>
        </defs>
        <circle cx="0" cy="0" class="shadow" r="0" fill="url(#lastBreackpointImage)" id="lastBreackpoint">
        </circle>
        <!-- __________________  globus circle _________________ -->
        <defs>
            <pattern id="circleImage" height="0" width="0" patternContentUnits="objectBoundingBox">
                <image xlink:href="{{asset('uploads/images/main/Circle_frame.svg')}}" preserveAspectRatio="none" width="0" height="0">

                </image>
            </pattern>
        </defs>
        <circle cx="0" cy="0" class="circlGlobus" r="0" fill="url(#circleImage)" id="circl">
        </circle>
        <!-- ______________________ globus ______________ -->
        <defs>
            <pattern id="attachedImage" height="100%" width="100%" patternContentUnits="objectBoundingBox">
                <image xlink:href="{{asset('uploads/images/main/globus.gif')}}" preserveAspectRatio="none" id="globusImage" width="1.01" height="1.01">

                </image>
            </pattern>
        </defs>
        <circle cx="0" cy="0" class="shadow" r="35" fill="url(#attachedImage)" style='border:1px solid black' id="dot">
        </circle>


    </svg>
</div>
<main class="main">
    <section class="main__innerBlock" style="background:#004270">
        <!-- banner section -->



        <div class="banner background_container ">
            <div class="wrapper">
                <div class="banner__row">
                    <h2 class="banner__title ml3 hide_discover_with_armenia transition_1s position_relative">{!! trans('site.discover_text') !!}</h2>
                    <!-- <div class="home_page_button_container higherThanSvg">
                            
                                <a href="{{route('armenia')}}" class="homePageButton">{{trans('site.learn_more')}}</a>
                            </div> -->
                </div>
            </div>
        </div>
        <!-- about section -->
        <div class="container_about">
            <div class="about  mobileTopAnimation position_relative transition_1s" id="about">
                <div class="wrapper">
                    <div class="about--wrapper">
                        <div class="about__block">
                            <div class="about__col-number">
                                <p class="main__number svgFirstBreakpoint">01</p>
                            </div>
                            <div class="about__col-title">
                                <h5 class="main__title">
                                    {{trans('site.who_we_are_part_1')}}
                                    <span class="main__title--block">{{trans('site.who_we_are_part_2')}}</span>
                                    @if(App::getLocale()!='ru')
                                    <span class="main__title--block">{{trans('site.who_we_are_part_3')}}</span>
                                    @endif
                                </h5>
                            </div>
                            <article class="about__col-article">
                                @foreach($home_page_contents as $home_page_content)
                                <div class="about__text">{!! $home_page_content->who_we_are_content !!}</div>
                                @endforeach
                            </article>
                        </div>
                    </div>
                </div>
                <div class="home_page_button_container higherThanSvg">

                    <a href="{{route('about')}}" class="homePageButton ">{{trans('site.more_about_us')}}</a>
                </div>
            </div>
        </div>
    </section>
    <!-- achievements section -->
    <section class="achievement scroll-count">
        <div class="wrapper">
            <div class="achievement--wrapper">
                <div class="min-wrapper">
                    <div class="achievement__col-number">
                        <p class="main__number svgSecendBreackpoint">02</p>
                    </div>
                    <div class="achievement__col-title">
                        <h5 class="main__title">
                            {{trans('site.achievements_part_one')}}
                            {{trans('site.achievements_part_two')}}
                            {{trans('site.achievements_part_three')}}
                        </h5>
                    </div>
                    <div class="achievement__col-article">
                        <div class="achievement__col-article__row">
                            <div class="achievement__col-article__block">
                                <div class="achievement__col-article__number"><span class="count">0</span>+</div>
                                <p class="achievement__col-article__text">{{trans('site.years')}}</p>
                            </div>
                            <div class="achievement__col-article__block">
                                <div class="achievement__col-article__number"><span class="count">0</span>K+</div>
                                <p class="achievement__col-article__text">{{trans('site.tourist')}}</p>
                            </div>
                        </div>
                        <div class="achievement__col-article__row2">
                            <div class="achievement__col-article__block">
                                <div class="achievement__col-article__number"><span class="count">0</span>+</div>
                                <p class="achievement__col-article__text">{{trans('site.groups')}}</p>
                            </div>
                            <div class="achievement__col-article__block">
                                <div class="achievement__col-article__number"><span class="count">0</span>+</div>
                                <p class="achievement__col-article__text">{{trans('site.events')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- tour section -->
    <section class="tour  mobileTopAnimation transition_1s fullRigth  opacity_03 position_relative higherThanSvg" id="tours">
        <div class="wrapper">
            <div class="tour--wrapper">
                <div class="tour__col-number">
                    <p class="main__number">03</p>
                </div>
                <div class="tour__col-title">
                    <h5 class="main__title">{{trans('site.best_tours_part_one')}}
                        <span class="main__title--block">{{trans('site.best_tours_part_two')}}</span>
                        @if(App::getLocale()!='ru')
                        <span class="main__title--block">{{trans('site.best_tours_part_three')}}</span>
                        @endif
                    </h5>
                </div>
                <article class="tour__col-article">
                    @foreach($home_page_contents as $home_page_content)
                    <div class="tour__text">{!! $home_page_content->the_best_tours_content !!}</div>
                    @endforeach
                    <a href="{{route('website_tours')}}" class='see_all'>{{trans('site.see_all_tours')}} → </a>
                </article>
            </div>
        </div>
    </section>
    <!-- gallery section -->
    <section class="gallery mobileTopAnimation fullRigth opacity_03 transition_1s position_relative higherThanSvg">
        <div class="wrapper gallery--wrapper">
            <a class="gallery__col1" href="{{route('tour.show', ['slug'=>$firsttour->getTranslation(App::getLocale())->slug])}}">
                <?php
                $i = 0;
                ?>
                <div class="gallery__leftBig">
                    <div class="gallery__leftInside">
                        <h5 class="gallery__title">{{$firsttour->name}}</h5>
                        <p class="gallery__text">{{$firsttour->nights_count}}{{trans('site.nights')}}, {{$firsttour->days_count}}{{trans('site.days')}}</p>
                        <!-- <p class="gallery__money">{{trans('site.starts_from')}} {{$firsttour->currency->sign}}{{$firsttour->start_price}} </p> -->
                    </div>
                </div>
                @if($firsttour->tour_image)
                <div class="gallery__rightBig lazy-bg" style="background-image: url('{{asset($firsttour->tour_image)}}'); "></div>
                @else
                <div class="gallery__rightBig lazy-bg" style="background-image: url('{{asset("uploads/sample_image.jpg")}}'); "></div>
                @endif
            </a>
            <div class="gallery__col2">
                <?php
                $i = 0;
                $count = count($tours);
                ?>
                @foreach($tours as $tour)
                @if($i!=$count-1)
                <a class="gallery__block" href="{{route('tour.show', ['slug'=>$tour->getTranslation(App::getLocale())->slug])}}">
                    <div class="gallery__left">
                        <div class="gallery__leftInside">
                            <h5 class="gallery__title">{{$tour->name}}</h5>
                            <p class="gallery__text">{{$tour->nights_count}}{{trans('site.nights')}}, {{$tour->days_count}}{{trans('site.days')}}</p>
                            <!-- <p class="gallery__money">{{trans('site.starts_from')}} {{$tour->currency->sign}}{{$tour->start_price}} </p> -->
                        </div>
                    </div>
                    @if($tour->tour_image)
                    <div class="gallery__right lazy-bg" style="background-image: url('{{asset($tour->tour_image)}}'); "></div>
                    @else
                    <div class="gallery__right lazy-bg" style="background-image: url('{{asset("uploads/sample_image.jpg")}}'); "></div>
                    @endif
                </a>
                @endif
                <?php
                $i++;
                ?>
                @endforeach
            </div>
        </div>
    </section>



    <!-- shold comment it  -->

    <section class="unicue_services  higherThanSvg">
        <div class="unicue_services_content">
            <div class="testimonials--wrapper service_title">
                <div class="testimonials__col-number">
                    <p class="main__number services_number">04</p>
                </div>
                <div class="testimonials__col-title ">
                    <h5 class="main__title services_title">{{trans('site.unique')}}
                        <span class="main__title--block">{{trans('site.services')}}</span>
                    </h5>
                </div>
            </div>
            {!! $home_page_content->unique_services_content !!}
            <div class='services_icons'>
                <div class="icon_item">
                    <a href="{{route('services')}}#service-reserve">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve">
                            <style type="text/css">
                                .st0 {
                                    fill: #114470;
                                }
                            </style>
                            <g>
                                <path class="st0" d="M97.3,95.8V45.3c0-0.5-0.3-1-0.7-1.3L65.8,23.9V10.5c0.9,0,1.6-0.7,1.6-1.6V2.7c0-0.9-0.7-1.6-1.6-1.6H2.7   c-0.9,0-1.6,0.7-1.6,1.6V9c0,0.9,0.7,1.6,1.6,1.6v85.2c-0.9,0-1.6,0.7-1.6,1.6s0.7,1.6,1.6,1.6h94.7c0.9,0,1.6-0.7,1.6-1.6   S98.2,95.8,97.3,95.8L97.3,95.8z M94.2,46.1v49.7H65.8V27.7L94.2,46.1z M4.2,4.2h60v3.2h-60V4.2z M5.8,10.5h56.8v85.2h-11V73.7   c0.9,0,1.6-0.7,1.6-1.6v-6.3c0-0.9-0.7-1.6-1.6-1.6H16.9c-0.9,0-1.6,0.7-1.6,1.6v6.3c0,0.9,0.7,1.6,1.6,1.6v22.1h-11V10.5z    M50,70.5H18.4v-3.2H50V70.5z M32.6,73.7v22.1H20V73.7H32.6z M35.8,73.7h12.6v22.1H35.8V73.7z M35.8,73.7"></path>
                                <path class="st0" d="M76.8,83.1h6.3c0.9,0,1.6-0.7,1.6-1.6v-6.3c0-0.9-0.7-1.6-1.6-1.6h-6.3c-0.9,0-1.6,0.7-1.6,1.6v6.3   C75.3,82.4,76,83.1,76.8,83.1L76.8,83.1z M78.4,76.8h3.2V80h-3.2V76.8z M78.4,76.8"></path>
                                <path class="st0" d="M76.8,68.9h6.3c0.9,0,1.6-0.7,1.6-1.6V61c0-0.9-0.7-1.6-1.6-1.6h-6.3c-0.9,0-1.6,0.7-1.6,1.6v6.3   C75.3,68.2,76,68.9,76.8,68.9L76.8,68.9z M78.4,62.6h3.2v3.2h-3.2V62.6z M78.4,62.6"></path>
                                <path class="st0" d="M76.8,54.7h6.3c0.9,0,1.6-0.7,1.6-1.6v-6.3c0-0.9-0.7-1.6-1.6-1.6h-6.3c-0.9,0-1.6,0.7-1.6,1.6v6.3   C75.3,54,76,54.7,76.8,54.7L76.8,54.7z M78.4,48.4h3.2v3.2h-3.2V48.4z M78.4,48.4"></path>
                                <path class="st0" d="M43.7,42.1H50c0.9,0,1.6-0.7,1.6-1.6v-6.3c0-0.9-0.7-1.6-1.6-1.6h-6.3c-0.9,0-1.6,0.7-1.6,1.6v6.3   C42.1,41.4,42.8,42.1,43.7,42.1L43.7,42.1z M45.3,35.8h3.2V39h-3.2V35.8z M45.3,35.8"></path>
                                <path class="st0" d="M43.7,26.3H50c0.9,0,1.6-0.7,1.6-1.6v-6.3c0-0.9-0.7-1.6-1.6-1.6h-6.3c-0.9,0-1.6,0.7-1.6,1.6v6.3   C42.1,25.6,42.8,26.3,43.7,26.3L43.7,26.3z M45.3,20h3.2v3.2h-3.2V20z M45.3,20"></path>
                                <path class="st0" d="M31.1,42.1h6.3c0.9,0,1.6-0.7,1.6-1.6v-6.3c0-0.9-0.7-1.6-1.6-1.6h-6.3c-0.9,0-1.6,0.7-1.6,1.6v6.3   C29.5,41.4,30.2,42.1,31.1,42.1L31.1,42.1z M32.6,35.8h3.2V39h-3.2V35.8z M32.6,35.8"></path>
                                <path class="st0" d="M18.4,57.9h6.3c0.9,0,1.6-0.7,1.6-1.6V50c0-0.9-0.7-1.6-1.6-1.6h-6.3c-0.9,0-1.6,0.7-1.6,1.6v6.3   C16.9,57.2,17.6,57.9,18.4,57.9L18.4,57.9z M20,51.6h3.2v3.2H20V51.6z M20,51.6"></path>
                                <path class="st0" d="M18.4,42.1h6.3c0.9,0,1.6-0.7,1.6-1.6v-6.3c0-0.9-0.7-1.6-1.6-1.6h-6.3c-0.9,0-1.6,0.7-1.6,1.6v6.3   C16.9,41.4,17.6,42.1,18.4,42.1L18.4,42.1z M20,35.8h3.2V39H20V35.8z M20,35.8"></path>
                                <path class="st0" d="M18.4,26.3h18.9c0.9,0,1.6-0.7,1.6-1.6v-6.3c0-0.9-0.7-1.6-1.6-1.6H18.4c-0.9,0-1.6,0.7-1.6,1.6v6.3   C16.9,25.6,17.6,26.3,18.4,26.3L18.4,26.3z M20,20h15.8v3.2H20V20z M20,20"></path>
                                <path class="st0" d="M31.1,57.9H50c0.9,0,1.6-0.7,1.6-1.6V50c0-0.9-0.7-1.6-1.6-1.6H31.1c-0.9,0-1.6,0.7-1.6,1.6v6.3   C29.5,57.2,30.2,57.9,31.1,57.9L31.1,57.9z M32.6,51.6h15.8v3.2H32.6V51.6z M32.6,51.6"></path>
                            </g>
                        </svg>
                        <span>{{trans('site.accommodation')}}</span>
                    </a>
                    <a href="{{route('services')}}" class='seeAllServicesLink'>{{trans('site.see_all_services')}} →</a>
                </div>
                <div class="icon_item">
                    <a href="{{route('services')}}#service-meals">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve">
                            <style type="text/css">
                                .st0 {
                                    fill: #114470;
                                }
                            </style>
                            <g>
                                <path class="st0" d="M94.5,20.5v27.5h-1.9L91.4,48V34.4C91.4,29.6,92.5,24.8,94.5,20.5 M95,56c0.9,11.1,1.5,24,1.5,25.6   c0,1.7-0.9,2.8-1.5,2.8c-0.6,0-1.5-1.1-1.5-2.8C93.5,80,94.1,67.2,95,56 M96.5,12.8c-0.3,0-0.5,0.1-0.7,0.3   c-4.6,6.1-7.2,13.6-7.2,21.3V48c0,1.6,1.3,2.8,2.8,2.8h1.2c-1.2,12-1.9,28.8-1.9,30.8c0,3.1,1.9,5.6,4.3,5.6c2.4,0,4.3-2.5,4.3-5.6   c0-2-0.8-18.8-1.9-30.8V13.6c0-0.4-0.2-0.7-0.6-0.8C96.6,12.8,96.5,12.8,96.5,12.8L96.5,12.8z"></path>
                                <path class="st0" d="M52,20.5c15.7,0,28.4,12.7,28.4,28.4S67.7,77.3,52,77.3S23.6,64.6,23.6,48.9S36.4,20.5,52,20.5 M52,17.7   c-17.2,0-31.2,14-31.2,31.2s14,31.2,31.2,31.2s31.2-14,31.2-31.2S69.3,17.7,52,17.7L52,17.7z"></path>
                                <path class="st0" d="M52,31.6c9.6,0,17.3,7.8,17.3,17.3S61.6,66.2,52,66.2c-9.6,0-17.3-7.8-17.3-17.3S42.5,31.6,52,31.6 M52,28.8   c-11.1,0-20.1,9-20.1,20.1S40.9,69,52,69s20.1-9,20.1-20.1S63.1,28.8,52,28.8L52,28.8z"></path>
                                <path class="st0" d="M13.2,43.5c2.4-1.4,3.9-4,3.9-7l-1.2-19.1c0-0.7-0.6-1.3-1.4-1.3c-0.4,0-0.7,0.2-1,0.4c-0.3,0.3-0.4,0.6-0.4,1   l0.8,15.3c0,0.9-0.7,1.6-1.6,1.6s-1.6-0.7-1.6-1.6l-0.4-15.3c0-0.8-0.7-1.5-1.5-1.5c-0.8,0-1.5,0.6-1.5,1.5L7.1,32.9   c0,0.9-0.7,1.6-1.6,1.6s-1.6-0.7-1.6-1.6l0.8-15.3c0-0.4-0.1-0.7-0.4-1c-0.3-0.3-0.6-0.4-1-0.4c-0.7,0-1.3,0.6-1.4,1.3L0.8,36.5   c0,3,1.6,5.5,3.9,7c1.5,0.9,2.4,2.7,2.2,4.5c-1.3,12-2.2,31.6-2.2,33.7c0,3.1,1.9,5.6,4.3,5.6s4.3-2.5,4.3-5.6   c0-2.1-0.9-21.7-2.2-33.7C10.8,46.1,11.6,44.4,13.2,43.5z M8.9,84.5c-0.6,0-1.5-1.1-1.5-2.8C7.4,79.9,8,67.1,8.9,56   c0.9,11,1.5,23.8,1.5,25.6C10.4,83.3,9.5,84.5,8.9,84.5z M8.9,44.1c-0.6-1.2-1.6-2.3-2.8-3c-1.4-0.9-2.3-2.3-2.5-3.9h10.6   c-0.2,1.6-1.1,3-2.5,3.9C10.5,41.8,9.5,42.9,8.9,44.1z"></path>
                            </g>
                        </svg>
                        <span>{{trans('site.meals_and_catering')}}</span>
                    </a>
                </div>
                <div class="icon_item">
                    <a href="{{route('services')}}#service-transport">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve">
                            <style type="text/css">
                                .st0 {
                                    fill: #114470;
                                }
                            </style>
                            <g>
                                <g>
                                    <path class="st0" d="M16.5,65c1.9,0,3.4-1.5,3.4-3.4s-1.5-3.4-3.4-3.4s-3.4,1.5-3.4,3.4S14.6,65,16.5,65z M15.1,61.6    c0-0.7,0.6-1.3,1.3-1.3c0.7,0,1.3,0.6,1.3,1.3c0,0.7-0.6,1.3-1.3,1.3C15.7,62.9,15.1,62.3,15.1,61.6z"></path>
                                    <path class="st0" d="M40.7,65c1.9,0,3.4-1.5,3.4-3.4s-1.5-3.4-3.4-3.4s-3.4,1.5-3.4,3.4S38.9,65,40.7,65z M39.4,61.6    c0-0.7,0.6-1.3,1.3-1.3c0.7,0,1.3,0.6,1.3,1.3c0,0.7-0.6,1.3-1.3,1.3C40,62.9,39.4,62.3,39.4,61.6z"></path>
                                    <path class="st0" d="M23.2,65H34c0.7,0,1.3-0.6,1.3-1.3v-4.2c0-0.7-0.6-1.3-1.3-1.3H23.2c-0.7,0-1.3,0.6-1.3,1.3v4.2    C21.9,64.4,22.5,65,23.2,65z M33.3,60.2v2.7h-9.4v-2.7H33.3z"></path>
                                    <path class="st0" d="M54.3,32.7v-4.1c0-1.1-0.9-2.1-2.1-2.1h-3.5c-0.6-2.3-2.7-4-5.2-4H13.6c-2.4,0-4.5,1.7-5.2,4H4.9    c-1.1,0-2.1,0.9-2.1,2.1v4.1c-1.4,0.4-2.4,1.7-2.4,3.2v3.8c0,1.9,1.5,3.4,3.4,3.4c1.9,0,3.4-1.5,3.4-3.4V36c0-1.4-0.9-2.7-2.3-3.2    l0-4.1h3.4V64c0,1.9,1,3.6,2.6,4.6v3.8c0,2.6,2.1,4.7,4.7,4.7c2.6,0,4.7-2.1,4.7-4.7v-3h16.6v3c0,2.6,2.1,4.7,4.7,4.7    c2.6,0,4.7-2.1,4.7-4.7v-3.9c1.5-1,2.5-2.7,2.5-4.5V50.4l0.1-0.1l-0.1-0.1V28.6l3.4,0v4.1C50.9,33.2,50,34.5,50,36v3.8    c0,1.9,1.5,3.4,3.4,3.4s3.4-1.5,3.4-3.4V36C56.7,34.5,55.7,33.1,54.3,32.7z M54.7,36v3.8c0,0.7-0.6,1.3-1.3,1.3S52,40.5,52,39.8    V36c0-0.7,0.6-1.3,1.3-1.3S54.7,35.2,54.7,36z M27.6,54.1H14.9l-4.6-4.6V33.3h17.3V54.1z M35.5,26.1H21.7c-1.1,0-2.1,0.9-2.1,2.1    v3.1h-9.3v-3.3c0-1.8,1.5-3.3,3.3-3.3h29.9c1.8,0,3.3,1.5,3.3,3.3v3.3h-9.2v-3.1C37.6,27,36.6,26.1,35.5,26.1z M21.7,28.1l13.8,0    v3.1H21.7L21.7,28.1z M29.6,54.1V33.3h17.2v16.3L42,54.1H29.6z M46.8,52.4V64c0,1.8-1.5,3.3-3.3,3.3H13.6c-1.8,0-3.3-1.5-3.3-3.3    V52.4l3.7,3.8h28.8L46.8,52.4z M18.2,69.3v3c0,1.5-1.2,2.7-2.7,2.7s-2.7-1.2-2.7-2.7v-3.1c0.2,0,0.5,0.1,0.7,0.1H18.2z M44.3,69.3    v3.1c0,1.5-1.2,2.7-2.7,2.7c-1.5,0-2.7-1.2-2.7-2.7v-3h4.6C43.8,69.3,44.1,69.3,44.3,69.3z M5.1,36v3.8c0,0.7-0.6,1.3-1.3,1.3    c-0.7,0-1.3-0.6-1.3-1.3V36c0-0.7,0.6-1.3,1.3-1.3C4.5,34.6,5.1,35.2,5.1,36z"></path>
                                </g>
                                <g>
                                    <path class="st0" d="M62.9,60.4c-1.3,0-3.4,0.5-3.4,3.6c0,1.9,1.6,3,4.4,3c2.7,0,4.4-1.1,4.4-3C68.2,61.8,65,60.4,62.9,60.4z     M66.5,64c0,1.2-1.9,1.3-2.7,1.3c-0.8,0-2.7-0.1-2.7-1.3c0-1.4,0.5-1.9,1.7-1.9C64.5,62.1,66.5,63.1,66.5,64z"></path>
                                    <path class="st0" d="M81,62.4H70.8c-0.8,0-1.4,0.6-1.4,1.4c0,1.6,1.3,2.9,2.9,2.9h7.4c1.6,0,2.9-1.3,2.9-2.9    C82.5,63.1,81.8,62.4,81,62.4z M80.7,64.1c-0.1,0.5-0.6,0.9-1.1,0.9h-7.4c-0.5,0-1-0.4-1.1-0.9H80.7z"></path>
                                    <path class="st0" d="M89,60.4c-2.2,0-5.4,1.4-5.4,3.6c0,1.9,1.6,3,4.4,3s4.4-1.1,4.4-3C92.4,61.7,91.1,60.4,89,60.4z M90.6,64    c0,1.2-1.9,1.3-2.7,1.3s-2.7-0.1-2.7-1.3c0-0.9,2-1.9,3.7-1.9C90.2,62.1,90.6,62.6,90.6,64z"></path>
                                    <path class="st0" d="M98.2,52.8h-3.4c-0.4,0-0.7,0.1-1,0.4l-0.4,0.3c-1.2-2.7-2.9-5.4-5.2-8.2c-1.4-1.7-3.4-2.6-5.5-2.6H69.1    c-2.1,0-4.2,1-5.5,2.6c-2.4,2.9-4,5.5-5.2,8.2L58,53.1c-0.3-0.2-0.6-0.4-1-0.4h-3.4c-0.8,0-1.4,0.6-1.4,1.4v2.3    c0,0.7,0.6,1.3,1.3,1.4l3,0.2c0,0,0,0.1,0,0.1c-0.5,1.8-0.8,4-0.8,6.7c0,2.7,0.5,4.7,1.5,6v5.3c0,0.7,0.5,1.2,1.2,1.2h3.9    c0.7,0,1.2-0.5,1.2-1.2v-3h24.6v3c0,0.7,0.5,1.2,1.2,1.2h3.9c0.7,0,1.2-0.5,1.2-1.2v-5.3c1-1.3,1.5-3.3,1.5-6    c0-2.6-0.3-4.8-0.8-6.6c0-0.1,0-0.1,0-0.2l3-0.2c0.7,0,1.3-0.6,1.3-1.4v-2.3C99.6,53.4,99,52.8,98.2,52.8z M92.8,72.4v3.3h-2.9    v-2.5C91.2,73.1,92.2,72.8,92.8,72.4z M81.2,70.2v1.2H70.7v-1.2H81.2z M57.6,55.1c-0.2,0.4-0.4,0.8-0.5,1.2L54,56.2v-1.7h3    L57.6,55.1z M59,56.3l0.7-1.7c1.2-2.7,2.8-5.3,5.2-8.2c1-1.3,2.6-2,4.2-2h13.7c1.6,0,3.2,0.7,4.2,2c2.3,2.8,4,5.5,5.2,8.3l0.5,1.3    c0,0,0.1,0.2,0.1,0.4H59z M93.2,69.8L93.2,69.8L93,70c0,0.1-0.9,1.4-3.4,1.4h-6.7V70c0-0.8-0.7-1.5-1.5-1.5h-11    c-0.8,0-1.5,0.7-1.5,1.5v1.4h-6l0,0l-0.3,0c-2.3,0.1-3.4-0.9-3.7-1.3l-0.2-0.2c-0.8-1-1.2-2.7-1.2-5c0-3.4,0.5-5.5,0.9-6.7l0-0.1    h35.1l0,0.1c0.4,1.2,0.9,3.3,0.9,6.7C94.4,67.1,94,68.8,93.2,69.8z M61.9,73.2v2.5H59v-3.3C59.7,72.7,60.6,73.1,61.9,73.2z     M97.9,54.5v1.7l-3.2,0.2c-0.1-0.4-0.3-0.8-0.5-1.2l0.7-0.7H97.9z"></path>
                                </g>
                            </g>
                        </svg>
                        <span>{{trans('site.transportation')}}</span>
                    </a>
                </div>
            </div>
        </div>
    </section>


    <!-- testimonials section -->
    <section class="testimonials mobileTopAnimation animated testimonialsAnimation position_relative  transition_1s" id="testimonials">
        <div class="wrapper">
            <div class="testimonials--wrapper">
                <div class="testimonials__col-number">
                    <p class="main__number">05</p>
                </div>
                <div class="testimonials__col-title">
                    <h5 class="main__title">{{trans('site.clients_testimonials_part_one')}}
                        <span class="main__title--block">{{trans('site.clients_testimonials_part_two')}}</span>
                    </h5>
                </div>
            </div>
        </div>

    </section>
    <!-- Owl carousel -->
    <section class="testimonialsAnimation mobileTopAnimation animated position_relative  transition_1s">
        <div class="wrapper">
            <div class="welcome--wrapper">
                <div class="owl-carousel owl-theme carousel1">
                    @foreach($testimonials as $testimonial)
                    <div class="item">
                        <div class="slider">
                            <div class="welcome__carousel">
                                <div class="welcome__carousel__block">
                                    <div class="welcome__carousel__imgBlock">
                                        @if($testimonial->author_image)
                                        <img data-src="{{asset($testimonial->author_image)}}" class="welcome__carousel__imgBlock--img" alt="{{$testimonial->author}}" />
                                        @elseif($testimonial->gender==1)
                                        <img src="{{asset('uploads/images/main/woman.svg')}}" class="not-intersection welcome__carousel__imgBlock--img" alt="{{$testimonial->author}}" />
                                        @else
                                        <img src="{{asset('uploads/images/main/man.svg')}}" class="not-intersection welcome__carousel__imgBlock--img" alt="{{$testimonial->author}}" />
                                        @endif
                                    </div>
                                </div>
                                <article class="welcome__carousel__article">
                                    <div class="welcome__carousel__opinion">{!! $testimonial->text_content !!}</div>
                                    <h5 class="welcome__carousel__userName">{{$testimonial->author}}</h5>
                                </article>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <div class="home_page_button_container higherThanSvg testimonialsButton">
        <a href="{{route('website_news')}}#tab-4" class="homePageButton ">{{trans('site.see_more_testimonials')}}</a>
    </div>
    <!-- welcome section -->
    <section class="welcome higherThanSvg lazy-bg" style="background-image: url({{asset('uploads/images/main/welcome.png')}})">

        <a class='Welcome_link' href='{{route('armenia')}}'></a>
        <div class="welcome__quotes">
            <img data-src="{{asset('uploads/images/main/quotes.png')}}" alt="quotes" />
        </div>
    </section>
    <!-- partners section -->
    <div class="partners__heading">
        {{trans('site.in_cooperation_with')}}
    </div>
    <section class="partners">

        <div class="wrapper">
            <!-- Owl carousel -->
            <div class="owl-carousel owl-theme carousel2">
                @foreach($partners as $partner)
                <div class="item">
                    <div class="slider">
                        <a href="{{$partner->link}}" class="partners__carousel" target="_blank">
                            <div class="partners__img">
                                <img class="not-intersection" src="{{asset($partner->partner_image)}}" alt="{{$partner->name}}" />
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</main>
@endsection