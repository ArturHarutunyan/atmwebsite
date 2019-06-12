@extends('layouts.site_inner', ['header_class' => ''])
@section('custom_meta')
    @foreach($custom_meta_tags as $custom_meta_tag)
        {!! MetaTag::tag($custom_meta_tag->name, $custom_meta_tag->description) !!}
    @endforeach
@endsection
@section('content')
    <main class="main">
        <!-- service banner section -->
        <section class="service-banner" style="background-image: url({{asset('uploads/images/main/services/service-banner.png')}});">
            <div class="wrapper"></div>
        </section>
        <!-- service menu section -->
        <section class="service-menu" id="service-menuScroll">
            <div class="wrapper-min">
                <div class="service-menu__mobile">
                    <div class="service-menu__mobile__link">{{trans('site.show_sections')}}
                        <img data-src="{{asset('uploads/images/main/about/about-arrowDown.png')}}" class="service-menu__mobile__icon" alt="arrow"/>
                    </div>
                </div>
                <ul class="service-menu__list">
                    <li class="service-menu__item">
                        <a href="#service-packages" class="service-menu__link service-menu__active">{{trans('site.tour_packages_part_1')}} {{trans('site.tour_packages_part_2')}}</a>
                    </li>
                    <li class="service-menu__item">
                        <a href="#service-reserve" class="service-menu__link">{{trans('site.hotel_reservation_part_1')}} {{trans('site.hotel_reservation_part_2')}}</a>
                    </li>
                    <li class="service-menu__item">
                        <a href="#service-transport" class="service-menu__link">{{trans('site.transport')}}</a>
                    </li>
                    <li class="service-menu__item">
                        <a href="#service-meals" class="service-menu__link">{{trans('site.meals_and_catering')}}</a>
                    </li>
                    <li class="service-menu__item">
                        <a href="#service-guides" class="service-menu__link">{{trans('site.excursions_part_1')}} {{trans('site.excursions_part_2')}}</a>
                    </li>
                    <li class="service-menu__item">
                        <a href="#service-organization" class="service-menu__link">{{trans('site.mice_organization')}}</a>
                    </li>
                </ul>
            </div>
        </section>
        <!-- service packages section -->
        <section class="service-packages" data-anchor="service-packages" id="service-packages">
            <div class="wrapper-min service-packages--wrapper">
                <article class="service-packages__col">
                    <h5 class="service__title">{{trans('site.tour_packages_part_1')}}
                        <span class="service__title__block">{{trans('site.tour_packages_part_2')}}</span>
                    </h5>
                    <div class="service__text">
                        {!! $services_content[0]->tour_packages_content !!}
                    </div>
                    <a href="{{route('website_tours')}}" class="service__link">{{trans('site.our_tour_packages')}}</a>
                </article>
                <aside class="service-packages__col">
                    <div class="service-packages__colBlock">
                        <a href="{{route('tour.show', ['slug'=>$tour_one->getTranslation(App::getLocale())->slug])}}">
                            <figure class="service-packages__figure">
                                @if($tour_one->tour_image)
                                    <div class="service-packages__figure__imgBox lazy-bg" style="background-image: url('{{asset($tour_one->tour_image)}}')"></div>
                                @else
                                    <div class="service-packages__figure__imgBox lazy-bg" style="background-image: url('{{asset('uploads/sample_image.jpg')}}');"></div>
                                @endif
                                <figcaption class="service-packages__figcaption">
                                    <h5 class="service-packages__figcaption__title">{{$tour_one->name}}</h5>
                                    <p class="service-packages__figcaption__text">{{$tour_one->nights_count}} {{trans('site.nights')}}, {{$tour_one->days_count}} {{trans('site.days')}}</p>
                                    <!-- <p class="service-packages__figcaption__money">{{trans('site.starts_from')}}
                                        <span class="service-packages__figcaption__money--span">{{$tour_one->currency->sign}}{{$tour_one->start_price}}</span>
                                    </p> -->
                                    <div class="service-packages__figcaption__arrow">
                                        <img data-src="{{asset('uploads/images/main/tour/tours-arrowRight.png')}}" alt="arrow">
                                    </div>
                                </figcaption>
                            </figure>
                        </a>
                        <a href="{{route('tour.show', ['slug'=>$tour_two->getTranslation(App::getLocale())->slug])}}">
                            <figure class="service-packages__figure">
                                @if($tour_two->tour_image)
                                    <div class="service-packages__figure__imgBox lazy-bg" style="background-image: url('{{asset($tour_two->tour_image)}}')"></div>
                                @else
                                    <div class="service-packages__figure__imgBox lazy-bg" style="background-image: url('{{asset('uploads/sample_image.jpg')}}');"></div>
                                @endif
                                <figcaption class="service-packages__figcaption">
                                    <h5 class="service-packages__figcaption__title">{{$tour_two->name}}</h5>
                                    <p class="service-packages__figcaption__text">{{$tour_two->nights_count}} {{trans('site.nights')}}, {{$tour_two->days_count}} {{trans('site.days')}}</p>
                                   <!--  <p class="service-packages__figcaption__money">{{trans('site.starts_from')}}
                                        <span class="service-packages__figcaption__money--span">{{$tour_two->currency->sign}}{{$tour_two->start_price}}</span>
                                    </p> -->
                                    <div class="service-packages__figcaption__arrow">
                                        <img data-src="{{asset('uploads/images/main/tour/tours-arrowRight.png')}}" alt="arrow">
                                    </div>
                                </figcaption>
                            </figure>
                        </a>
                    </div>
                </aside>
            </div>
        </section>
        <!-- service reserve section -->
        <section class="service-reserve" data-anchor="service-reserve" id="service-reserve">
            <div class="wrapper-min service-reserve--wrapper">
                <article class="service-reserve__col">
                    <h5 class="service__title">{{trans('site.hotel_reservation_part_1')}}
                        <span class="service__title__block">{{trans('site.hotel_reservation_part_2')}}</span>
                    </h5>
                    <div class="service__text">
                        {!! $services_content[0]->hotel_reservation_content !!}
                    </div>
                    <button class="service__link" data-toggle="modal" data-target="#exampleModal">{{trans('site.send_request')}}</button>
                </article>
                <aside class="service-reserve__col">
                    @foreach($hotels_3 as $hotel)
                        <div class="service-reserve__row">
                            <h5 class="service-reserve__title">{{$hotel->name}}</h5>
                            <div class="service-reserve__text">
                                {!! $hotel->description !!}
                            </div>
                        </div>
                    @endforeach
                </aside>
            </div>
        </section>
        <!-- service transport section -->
        <section class="service-transport" data-anchor="service-transport" id="service-transport">
            <div class="wrapper-min">
                <h5 class="service__title">{{trans('site.transport')}}</h5>
                <div class="service-transport--wrapper">
                    <article class="service-transport__col">
                        <div class="service__text">
                            {!! $services_content[0]->transport_content !!}
                        </div>
                        <form hidden action="{{route('contact')}}" method="post" id="transport_form">
                            {{csrf_field()}}
                            <input type="hidden" name="subject" value="{{trans('transport')}}">
                        </form>
                        <a href="#" onclick="event.preventDefault();$('#transport_form').submit();" class="service__link">{{trans('site.contact_us')}}</a>
                    </article>
                    <aside class="service-transport__col">
                        <div class="service-transport__row">
                            <div class="service-transport__box">
                                <img data-src="{{asset('uploads/images/main/services/service_bus.png')}}" alt="bus"/>
                                <h6 class="service-transport__title">{{trans('site.buses')}}</h6>
                                <p class="service-transport__text">({{trans('site.with_drivers_or_without')}})</p>
                            </div>
                            <div class="service-transport__box">
                                <img data-src="{{asset('uploads/images/main/services/service_car.png')}}" alt="car"/>
                                <h6 class="service-transport__title">{{trans('site.cars')}}</h6>
                                <p class="service-transport__text">({{trans('site.with_drivers_or_without')}})</p>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </section>
        <!-- service meals & Catering section -->
        <section class="service-meals" data-anchor="service-meals" id="service-meals">
            <div class="wrapper-min service-meals--wrapper">
                <article class="service-meals__col">
                    <h5 class="service__title">{{trans('site.meals_and_catering_one')}}
                        <span class="service__title__block">{{trans('site.meals_and_catering_two')}}</span>
                    </h5>
                    <div class="service__text">
                        {!! $services_content[0]->meals_content !!}
                    </div>
                    <form hidden action="{{route('contact')}}" method="post" id="meals_and_catering_form">
                        {{csrf_field()}}
                        <input type="hidden" name="subject" value="{{trans('site.meals_and_catering')}}">
                    </form>
                    <a href="#" class="service__link" onclick="event.preventDefault(); $('#meals_and_catering_form').submit();">{{trans('site.send_request')}}</a>
                </article>
                <aside class="service-meals__col">
                    @foreach($meals_3 as $meal)
                        <div class="service-meals__row">
                            <h5 class="service-meals__title">{{$meal->name}}</h5>
                            <div class="service-meals__text">
                                {!! $meal->description !!}
                            </div>
                        </div>
                    @endforeach
                </aside>
            </div>
        </section>
        <!-- service guides section -->
        <section class="service-guides" data-anchor="service-guides" id="service-guides">
            <div class="wrapper-min service-guides--wrapper">
                <article class="service-guides__col">
                    <h5 class="service__title">{{trans('site.excursions_part_1')}}
                        <span class="service__title__block">{{trans('site.excursions_part_2')}}</span>
                    </h5>
                    <div class="service-reserve__text">
                        {!! $services_content[0]->excursions_content !!}
                    </div>
                    <a href="{{route('website_tours')}}" class="service__link">{{trans('site.our_tours')}}</a>
                </article>
                <aside class="service-guides__col">
                    <h6 class="service-guides__header">{{trans('site.meet_our_guides')}}</h6>
                    <div class="service-guides__row">
                        @foreach($guides as $guide)
                            <div class="service-guides__teamBlock">
                                <div class="service-guides__imgBox">
                                    @if($guide->image)
                                        <img data-src="{{asset($guide->image)}}" alt="{{$guide->name}} {{$guide->surname}}"/>
                                    @else
                                        <img data-src="{{asset('uploads/sample_image.jpg')}}" alt="{{$guide->name}} {{$guide->surname}}"/>
                                    @endif
                                    <div class="service-guides__textBox">
                                        <a href="#" target="_blank" class="service-guides__social">
                                            <img data-src="{{asset('uploads/images/main/about/about-fb.png')}}" alt="facebook">
                                        </a>
                                        <a href="#" target="_blank" class="service-guides__social">
                                            <img data-src="{{asset('uploads/images/main/about/about-in.png')}}" alt="linkedin">
                                        </a>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="service-guides__title">{{$guide->name}} {{$guide->surname}}</h5>
                                    <p class="service-guides__text">{{trans('site.guide')}} ({{$guide->language}})</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </aside>
            </div>
        </section>
        <!-- service organization section -->
        <section class="service-organization" data-anchor="service-organization" id="service-organization">
            <div class="wrapper-min">
                <h5 class="service__title">{{trans('site.mice_part_1')}}
                    <span class="service__title__block">{{trans('site.mice_part_2')}}</span>
                </h5>
                <div class="service-organization--wrapper">
                    <article class="service-organization__col">
                        <div class="service__text">
                            {!! $services_content[0]->mice_content_one !!}
                        </div>
                        <button class="service__link" data-toggle="modal" data-target="#projectsModal" class="service__link">{{trans('site.view_portfolio')}}</button>
                    </article>
                    <article class="service-organization__col">
                        <div class="service__text">
                            {!! $services_content[0]->mice_content_two !!}
                        </div>
                    </article>
                </div>
            </div>
        </section>
        <!-- Modal -->
        <form action="#" method="POST" class="service-modalForm" id="request_form" name="request_form">
            <div class="modal fade service-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{trans('site.accommodation')}}</h4>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="message">
                            </div>
                            <div class="service-modalForm__row">
                                <div class="service-modalForm__inputBlock">
                                    <label for="name" class="service-modalForm__label">{{trans('site.name')}}
                                        <span class="service-modalForm__star">*</span>
                                    </label>
                                    <input type="text" id="name" name="name" required="" class="service-modalForm__input">
                                </div>
                                <div class="service-modalForm__inputBlock">
                                    <label for="email" class="service-modalForm__label">{{trans('site.email')}}
                                        <span class="service-modalForm__star">*</span>
                                    </label>
                                    <input type="email" id="email" name="email" required="" class="service-modalForm__input">
                                </div>
                                <div class="service-modalForm__inputBlock">
                                    <label for="hotel" class="service-modalForm__label">{{trans('site.subject')}}
                                        <span class="service-modalForm__star">*</span>
                                    </label>
                                    <input type="text" id="hotel" name="subject" required="" class="service-modalForm__input">
                                </div>
                            </div>
                            <div class="service-modal-hotel">
                                <h5 class="service-modal__title">{{trans('site.hotels_list')}}</h5>
                                <ul class="service-modal-hotel__list">
                                    @foreach($hotels as $hotel)
                                        <li class="service-modal-hotel__radio">
                                            <label for="hotel-{{$hotel->id}}" class="row">
                                                <p class="col-md-9 hotel-block__name">
                                                    <input type="radio" name="hotel" id="hotel-{{$hotel->id}}" value="{{$hotel->name}}">
                                                    {{$hotel->name}}
                                                </p>
                                                <p class="col-md-3 hotel-block__stars">
                                                @if(strpos($hotel->category->name, '*')==1)
                                                    @for($i=0; $i<intval(explode("*",$hotel->category->name)[0]); ++$i)
                                                        <i class="fa fa-star"></i>
                                                    @endfor
                                                @else
                                                    {{$hotel->category->name}}
                                                @endif
                                                </p>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="service-modal-count">
                                <h5 class="service-modal__title">{{trans('site.people_quantity')}}</h5>
                                <div class="service-modal__countRow">
                                    <p class="service-modal__countText">{{trans('site.adults')}}</p>
                                    <div class="service-modal__minusPlus adults-div">
                                        <button type="button" class="service-modal__minus">
                                            -
                                        </button>
                                        <input type="text" class="service-modal__input" name="adults" value="1" maxlength="2">
                                        <button type="button" class="service-modal__plus">
                                            +
                                        </button>
                                    </div>
                                </div>
                                <div class="service-modal__countRow">
                                    <p class="service-modal__countText">{{trans('site.children')}}</p>
                                    <div class="service-modal__minusPlus children-div">
                                        <button type="button" class="service-modal__minus">
                                            -
                                        </button>
                                        <input type="text" class="service-modal__input" name="children" value="0" maxlength="2">
                                        <button type="button" class="service-modal__plus">
                                            +
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="service-modal-dates">
                                <h5 class="service-modal__title">{{trans('site.dates')}}</h5>
                                <div class="service-modal-datesRow">
                                    <div class="service-modal-datesBlock">
                                        <input type="text" class="service-modal-dateInput" id="start_date" name="start_date" autocomplete="off">
                                    </div>
                                    <div class="service-modal-datesBlock">
                                        <input type="text" class="service-modal-dateInput" id="end_date" name="end_date" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="service-modalForm__rowTextarea">
                                <label for="message" class="service-modalForm__label">{{trans('site.message')}}
                                    <span class="service-modalForm__star">*</span>
                                </label>
                                <textarea name="message" id="message" rows="4" required="" class="service-modalForm__input"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="service-modalForm__button" onclick="send_hotel_request($('#request_form').serializeArray())">{{trans('site.send')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Modal -->
        <div class="modal fade armenia-modal" id="projectsModal" tabindex="-1" role="dialog" aria-labelledby="projectsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img data-src="{{asset('uploads/images/main/armenia/modal-close.png')}}" alt="close">
                        </button>
                        <img class="modal-image" data-src="https://armeniatravel.am/uploads/about_armenia_contents/1540393149img_1.png" alt="image"/>
                    </div>
                    <div class="armenia-modal__body">
                        <div class="armenia-modal__text">
                            <ul>
                                @foreach($projects as $project)
                                    <li class="about-project__item">{{$project->name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                                        <img class="not-intersection" src="{{asset($partner->partner_image)}}" alt="{{$partner->name}}"/>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
    <script src="{{asset('js/jquery.hash-magic.min.js')}}"></script>
    <script src="{{asset('js/jquery.scrollTo.min.js')}}"></script>

@endsection