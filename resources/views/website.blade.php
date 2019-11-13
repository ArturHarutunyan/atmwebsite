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

{{--<div style='position:absolute; height:0'>

    <style>
        @media screen and (max-width:768px) {
            .messageContainer {
                top: -120px !important;
                right: 55px !important;
                width: 220px !important;
                height: 169px !important;

            }

            .messageContainer p {
                text-align: justify;
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
                                     top: -156px;
    background: rgb(255, 255, 255);
    min-height: 120px;
    text-align: center;
    right: 0px;
    cursor: initial;
    color: rgb(28, 30, 33);
    direction: ltr;
    font-size: 11px;
    line-height: 1.28;
    -webkit-tap-highlight-color: transparent;
    border-radius: 12px;
    bottom: 0px;
    box-shadow: rgba(0, 0, 0, 0.15) 0px 1pt 12pt;
    display: flex;
    flex-direction: column;
    position: absolute;
    height: 140px;
    width: 360px;
                                      ">
            <p style="font-size:16px;padding:10px;padding-top: 21px;">We are the official travel partner of WCIT2019. Discover Armenia with our unique excursions. </p>
            <a href="/wcit" class="homePageButton" style="    font-size: 16px;
    padding: 8px 19px;
    font-size: 17px;
    display: inline-block;
    color: #fff;
    text-decoration: none;
    border: 1px solid;
    background-color: #000;
    border-radius: 2px;
    text-align: center;
    margin: auto;
    /* height: 43px; */
    margin-right: 18px;
    margin-top: 11px;
    margin-bottom: 0;">Book now</a>
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

</div>--}}

<!-- for mozilla  -->
<div class="getBackgroundImageReady changeBackground"></div>
<!-- svg html path -->


<div class="hiddenScrollbar">
    <div> </div>
</div>
<div class="svgContainer">
    @include('svgs.path')
</div>
<main class="main">
    <section class="main__innerBlock" style="background:#004270">
        <!-- banner section -->
        <div class="banner background_container ">
            <div class="wrapper">
                <div class="banner__row">
                    <h2 class="banner__title ml3 hide_discover_with_armenia transition_1s position_relative">{!! trans('site.discover_text') !!}</h2>
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
                        @include('svgs.service-reserve-icon')
                        <span>{{trans('site.accommodation')}}</span>
                    </a>
                    <a href="{{route('services')}}" class='seeAllServicesLink'>{{trans('site.see_all_services')}} →</a>
                </div>
                <div class="icon_item">
                    <a href="{{route('services')}}#service-meals">
                        @include('svgs.service-meals-icon')
                        <span>{{trans('site.meals_and_catering')}}</span>
                    </a>
                </div>
                <div class="icon_item">
                    <a href="{{route('services')}}#service-transport">
                        @include('svgs.service-transport-icon')
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