@extends('layouts.site_inner', ['header_class' => ''])
@section('custom_meta')
    @foreach($custom_meta_tags as $custom_meta_tag)
        {!! MetaTag::tag($custom_meta_tag->name, $custom_meta_tag->description) !!}
    @endforeach
@endsection
@section('content')
    <main class="main">
        <!-- armenia banner section -->
        <section class="armenia-banner" style="background-image: url('{{asset('uploads/images/main/armenia/armenia.jpg')}}')">
            <div class="wrapper"></div>
        </section>
        <!-- armenia tab section -->
        <section class="armenia-tabs">
            <!-- armenia tab menu section -->
            <div class="armenia-tabs__menu" id="armenia-menuScroll">
                <div class="about-menu__mobile">
                    <div class="about-menu__mobile__link">{{trans('site.show_sections')}}
                        <img data-src="{{asset('uploads/images/main/about/about-arrowDown.png')}}" class="about-menu__mobile__icon" alt="arrow"/>
                    </div>
                </div>
                <ul class="armenia-tabs__list wrapper">
                    <li class="armenia-tabs__link current" data-tab="tab-1">{{trans('site.about_armenia')}}</li>
                    <li class="armenia-tabs__link" data-tab="tab-3">{{trans('site.sightseeing')}}</li>
                    <li class="armenia-tabs__link" data-tab="tab-2">{{trans('site.event_calendar')}}</li>
                    <li class="armenia-tabs__link" data-tab="tab-4">{{trans('site.entertainments')}}</li>
                    <li class="armenia-tabs__link" data-tab="tab-5">{{trans('site.food_and_drink')}}</li>
                    <li class="armenia-tabs__link" data-tab="tab-6">{{trans('site.tourist_info')}}</li>
                </ul>
            </div>
            <!-- armenia tab content section -->
            <div class="armenia-tabs__container">
                <section id="tab-1" class="armenia-tabs__content current">
                    <div class="armenia-about">
                        <div class="armenia-about__history">
                            <div class="wrapper-min armenia-about__history--wrapper">
                                <article class="armenia-about__col" data-id="history">
                                    <h3 class="armenia-about__title">{{trans('site.history')}}</h3>
                                    @if(strlen(strip_tags($about_armenia_content[0]->history_content))>1000)
                                        <div class="armenia-about__text full_text">
                                            {!! str_limit($about_armenia_content[0]->history_content, 1000, '...') !!}
                                            @if(strlen($about_armenia_content[0]->history_content)>1000)
                                                <span class="armenia-sightseeing__article__show" onclick="toggle_view_text('history')">{{trans('site.view_more')}}</span>
                                            @endif
                                        </div>
                                        <div class="armenia-about__text partial_text">
                                            {!! $about_armenia_content[0]->history_content !!}
                                            <span class="armenia-sightseeing__article__show" onclick="toggle_view_text('history')">{{trans('site.view_less')}}</span>
                                        </div>
                                    @else
                                        <div class="armenia-about__text">
                                            {!! $about_armenia_content[0]->history_content !!}
                                        </div>
                                    @endif
                                </article>
                                <aside class="armenia-about__col">
                                    <img data-src="{{asset($about_armenia_content[0]->history_image)}}" alt="history image"/>
                                </aside>
                            </div>
                        </div>
                        <div class="armenia-about__culture">
                            <div class="wrapper-min">
                                <h3 class="armenia-about__title">{{trans('site.culture_part_1')}}
                                    <span class="armenia-about__titleSpan">{{trans('site.culture_part_2')}}</span>
                                </h3>
                                <article class="armenia-about__culture__article">
                                    <div class="armenia-about__culture__articleCol">
                                        <div class="armenia-about__text">
                                            {!! $about_armenia_content[0]->culture_content_one !!}
                                        </div>
                                    </div>
                                    <div class="armenia-about__culture__articleCol">
                                        <div class="armenia-about__text">
                                            {!! $about_armenia_content[0]->culture_content_two !!}
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                        <div class="armenia-about__religion">
                            <div class="wrapper-min armenia-about__religion--wrapper">
                                <article class="armenia-about__col" data-id="religion">
                                    <h3 class="armenia-about__title">{{trans('site.religion')}}</h3>
                                    @if(strlen(strip_tags($about_armenia_content[0]->religion_content))>1000)
                                        <div class="armenia-about__text full_text">
                                            {!! str_limit($about_armenia_content[0]->religion_content, 1000, '...') !!}
                                            @if(strlen($about_armenia_content[0]->religion_content)>1000)
                                                <span class="armenia-sightseeing__article__show" onclick="toggle_view_text('religion')">{{trans('site.view_more')}}</span>
                                            @endif
                                        </div>
                                        <div class="armenia-about__text partial_text">
                                            {!! $about_armenia_content[0]->religion_content !!}
                                            <span class="armenia-sightseeing__article__show" onclick="toggle_view_text('religion')">{{trans('site.view_less')}}</span>
                                        </div>
                                    @else
                                        <div class="armenia-about__text">
                                            {!! $about_armenia_content[0]->religion_content !!}
                                        </div>
                                    @endif
                                </article>
                                <aside class="armenia-about__col">
                                    <img data-src="{{asset($about_armenia_content[0]->religion_image)}}" alt="religion image"/>
                                </aside>
                            </div>
                        </div>
                        <div class="armenia-about__climate">
                            <div class="wrapper-min">
                                <h3 class="armenia-about__title">{{trans('site.climate_part_1')}}
                                    <span class="armenia-about__titleSpan">{{trans('site.climate_part_2')}}</span>
                                </h3>
                                <div class="armenia-about__climate--wrapper">
                                    <article class="armenia-about__col">
                                        <div class="armenia-about__text">
                                            {!! $about_armenia_content[0]->climate_content !!}
                                        </div>
                                    </article>
                                    <article class="armenia-about__col">
                                        <div class="armenia-about__text">
                                            {!! $about_armenia_content[0]->climate_content_two !!}
                                        </div>
                                    </article>
                                </div>
                            </div>
                        </div>
                        <div class="armenia-about__reasons">
                            <div class="wrapper-min">
                                <h3 class="armenia-about__title">{{trans('site.5_reasons_part_1')}}
                                    <span class="armenia-about__titleSpan">{{trans('site.5_reasons_part_2')}}</span>
                                </h3>
                                <div class="armenia-about__reasons__row">
                                    <div class="armenia-about__reasons__col">
                                        <h6 class="armenia-about__reasons__title">{{trans('site.first_reason')}}</h6>
                                        <div class="armenia-about__reasons__text">
                                            {!! $about_armenia_content[0]->first_reason_content !!}
                                        </div>
                                    </div>
                                    <div class="armenia-about__reasons__col">
                                        <h6 class="armenia-about__reasons__title">{{trans('site.second_reason')}}</h6>
                                        <div class="armenia-about__reasons__text">
                                            {!! $about_armenia_content[0]->second_reason_content !!}
                                        </div>
                                    </div>
                                    <div class="armenia-about__reasons__col">
                                        <h6 class="armenia-about__reasons__title">{{trans('site.third_reason')}}</h6>
                                        <div class="armenia-about__reasons__text">
                                            {!! $about_armenia_content[0]->third_reason_content !!}
                                        </div>
                                    </div>
                                    <div class="armenia-about__reasons__col">
                                        <h6 class="armenia-about__reasons__title">{{trans('site.fourth_reason')}}</h6>
                                        <div class="armenia-about__reasons__text">
                                            {!! $about_armenia_content[0]->fourth_reason_content !!}
                                        </div>
                                    </div>
                                    <div class="armenia-about__reasons__col">
                                        <h6 class="armenia-about__reasons__title">{{trans('site.fifth_reason')}}</h6>
                                        <div class="armenia-about__reasons__text">
                                            {!! $about_armenia_content[0]->fifth_reason_content !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- armenia tab sightseeing section -->
                <section id="tab-3" class="armenia-tabs__content">
                    <div class="wrapper-min">
                        <ul id="armenia-sightseeing__inner">
                            @foreach($sightseeing_places as $sightseeing_place)
                                <li class="armenia-sightseeing__row type_{{$sightseeing_place->sightseeing_type_id}}">
                                    <aside class="armenia-sightseeing__aside">
                                        @if($sightseeing_place->image)
                                            <div class="armenia-sightseeing__aside__imgBox lazy-bg" style="background-image: url('{{asset($sightseeing_place->image)}}')"></div>
                                        @else
                                            <div class="armenia-sightseeing__aside__imgBox lazy-bg" style="background-image: url({{asset('uploads/sample_image.jpg')}})"></div>
                                        @endif
                                    </aside>
                                    <article class="armenia-sightseeing__article" data-id="{{$sightseeing_place->id}}">
                                        <h4 class="armenia-sightseeing__article__title">{{$sightseeing_place->name}}</h4>
                                        @if(strlen(strip_tags($sightseeing_place->description))>1000)
                                            <div class="armenia-sightseeing__article__text full_text">
                                                {!! str_limit($sightseeing_place->description, 1000, '...') !!}
                                                @if(strlen($sightseeing_place->description)>1000)
                                                    <span class="armenia-sightseeing__article__show" onclick="toggle_view_text('{{$sightseeing_place->id}}')">{{trans('site.view_more')}}</span>
                                                @endif
                                            </div>
                                            <div class="armenia-sightseeing__article__text partial_text">
                                                {!! $sightseeing_place->description !!}
                                                <span class="armenia-sightseeing__article__show" onclick="toggle_view_text('{{$sightseeing_place->id}}')">{{trans('site.view_less')}}</span>
                                            </div>
                                        @else
                                            <div class="armenia-sightseeing__article__text">
                                                {!! $sightseeing_place->description !!}
                                            </div>
                                        @endif
                                    </article>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <!-- armenia tab event calendar section -->
                <section id="tab-2" class="armenia-tabs__content">
                    <div class="wrapper-min">
                        <h2 class="armenia-event__title">{{trans('site.events')}} {{trans('site.and')}} <span class="armenia-calendar__titleSpan">{{trans('site.festivals')}}</span></h2>
                        <div class="armenia-event">
                            @foreach($events as $event)
                                <figure class="armenia-event__figure  cardEfect" onclick="modalOpen('{{$event->id}}','event','{{asset($event->image?$event->image:'uploads/sample_image.jpg')}}','{{App::getLocale()}}')">
                                    @if($event->image)
                                        <div class="armenia-event__imgBox cardEfectImage lazy-bg" style="background-image: url('{{asset($event->image)}}')"></div>
                                        <div class="armenia-event__background-text cardEfectBackground">
                                        {!! $event->description !!}
                                        </div>
                                    @else
                                        <div class="armenia-event__imgBox lazy-bg" style="background-image: url('{{asset('uploads/sample_image.jpg')}}')"></div>
                                        <div class="armenia-event__background-text">
                                        {!! $event->description !!}
                                        </div>
                                    @endif
                                    <figcaption class="armenia-event__figcaption">
                                        <p class="armenia-event__figcaption__text">{{$event->name}}</p>
                                        <p class="armenia-event__figcaption__calendar">{{trans('site.month_'.date("n",strtotime($event->date))).' '.
                                                                                       date("d",strtotime($event->date)).', '.
                                                                                       date("Y",strtotime($event->date))}}
                                        </p>
                                    </figcaption>
                                </figure>
                            @endforeach
                        </div>
                    </div>
                </section>
                <!-- armenia tab entertainments section -->
                <section id="tab-4" class="armenia-tabs__content">
                    <div class="wrapper-min">
                        <div class="armenia-entertain">
                            @foreach($entertainments as $entertainment)
                                <figure class="armenia-entertain__figure" onclick="modalOpen('{{$entertainment->id}}','entertainment','{{asset($entertainment->image?$entertainment->image:'uploads/sample_image.jpg')}}','{{App::getLocale()}}')">
                                    @if($entertainment->image)
                                        <div class="armenia-entertain__imgBox lazy-bg" style="background-image: url('{{asset($entertainment->image)}}');"></div>
                                    @else
                                        <div class="armenia-entertain__imgBox lazy-bg" style="background-image: url('{{asset('uploads/sample_image.jpg')}}');"></div>
                                    @endif
                                    <figcaption class="armenia-entertain__figcaption">{{$entertainment->name}}</figcaption>
                                </figure>
                            @endforeach
                        </div>
                    </div>
                </section>
                <!-- armenia tab food and drink section -->
                <section id="tab-5" class="armenia-tabs__content">
                    <div class="wrapper-min">
                        <div class="armenia-food">
                            @foreach($food_and_drinks as $food_and_drink)
                                <figure class="armenia-food__figure cardEfect" onclick="modalOpen('{{$food_and_drink->id}}','food_and_drink','{{asset($food_and_drink->image?$food_and_drink->image:'uploads/sample_image.jpg')}}','{{App::getLocale()}}')">
                                    @if($food_and_drink->image)
                                        <div class="armenia-food__imgBox cardEfectImage lazy-bg" style="background-image: url('{{asset($food_and_drink->image)}}');"></div>
                                       <div class="cardEfectBackground">
                                           {!!$food_and_drink->description!!}
                                       </div>
                                    @else
                                        <div class="armenia-food__imgBox cardEfectImage lazy-bg" style="background-image: url('{{asset('uploads/sample_image.jpg')}}');"></div>
                                        <div class="cardEfectBackground">
                                            {!!$food_and_drink->description!!}
                                        </div>
                                    @endif
                                    <figcaption class="armenia-food__figcaption">{{$food_and_drink->name}}</figcaption>
                                </figure>
                            @endforeach
                        </div>
                    </div>
                </section>
                <!-- armenia tab tourist info section -->
                <section id="tab-6" class="armenia-tabs__content">
                    <div class="wrapper-min">
                        <div class="armenia-tourist__row">
                            <h5 class="armenia-tourist__title">{{trans('site.visa_support')}}</h5>
                            {!! $tourist_info_content[0]->visa_content !!}
                        </div>
                        <div class="armenia-tourist__row">
                            <h5 class="armenia-tourist__title">{{trans('site.climate_in_armenia')}}</h5>
                            {!! $tourist_info_content[0]->climate_content !!}
                        </div>
                        <div class="armenia-tourist__row">
                            <h5 class="armenia-tourist__title">{{trans('site.currency')}}</h5>
                            {!! $tourist_info_content[0]->currency_content !!}
                        </div>
                        <div class="armenia-tourist__row">
                            <h5 class="armenia-tourist__title">{{trans('site.safety')}}</h5>
                            {!! $tourist_info_content[0]->safety_content !!}
                        </div>
                    </div>
                </section>
            </div>
        </section>
        <!-- Modal -->
        <div class="modal fade armenia-modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <img data-src="{{asset('uploads/images/main/armenia/modal-close.png')}}" alt="close">
                        </button>
                        <img class="modal-image not-intersection" src="{{asset('uploads/sample_image.jpg')}}" alt="image"/>
                    </div>
                    <div class="armenia-modal__body">
                        <h6 class="armenia-modal__title"></h6>
                        <div class="armenia-modal__text">

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
@endsection