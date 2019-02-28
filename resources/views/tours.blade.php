@extends('layouts.site_inner', ['header_class' => ''])
@section('custom_meta')
    @foreach($custom_meta_tags as $custom_meta_tag)
        {!! MetaTag::tag($custom_meta_tag->name, $custom_meta_tag->description) !!}
    @endforeach
@endsection

@section('content')
    <main class="main" id="main">
        <!-- Tour banner section -->
        <section class="tours-banner" style="background-image: url({{asset('uploads/images/main/tour/tours-banner.png')}})"></section>
        <!-- Tour filter section -->
        <section class="tours-filter">
            <!-- tour filter outer -->
            <div class="tours-filter-outer">
                <div class="wrapper">
                    <h5 class="tours-filter__title">{{trans('site.type')}}</h5>
                    <div class="tours-filter-outer__form">
                        <div class="tours-filter-outer__form__block">
                            <input type="checkbox" class="tours-filter-outer__form__input" value="0"/>
                            <input type="button" data-value="0" id="parent" class="tours-filter-outer__form__input tours-filter__active" value="{{trans('site.all')}}" @click="set_all_types()"/>
                        </div>
                        @foreach($tour_types as $tour_type)
                            <div class="tours-filter-outer__form__block">
                                <input type="checkbox" class="tours-filter-outer__form__input" value="{{$tour_type->id}}"/>
                                <input type="button" data-value="{{$tour_type->id}}" @click="set_types({{$tour_type->id}})" class="child tours-filter-outer__form__input" value="{{$tour_type->name}}"/>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- tour filter inside -->
            <div class="tours-filter-inside">
                <div class="wrapper">
                    <div class="tours-filter-inside__rowTop">
                        <div class="tours-filter-inside__rowTop__col">
                            <h5 class="tours-filter__title">{{trans('site.period')}}</h5>
                            <div class="tours-filter-inside__formPeriod">
                                @foreach($tour_periods as $tour_period)
                                    <div class="tours-filter-inside__formPeriod__block">
                                        <input type="button" class="tours-filter-inside__formPeriod__input" value="{{$tour_period->name}}" @click="set_period({{$tour_period->id}})"/>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div  class="tours-filter-inside__rowTop__col">
                            <h5 class="tours-filter__title">{{trans('site.season')}}</h5>
                            <div class="tours-filter-inside__formSeason">
                                @foreach($tour_seasons as $tour_season)
                                    <div class="tours-filter-inside__formSeason__block">
                                        <input type="button" class="inner-child tours-filter-inside__formSeason__input" value="{{$tour_season->name}}" @click="set_season({{$tour_season->id}})"/>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div  class="tours-filter-inside__rowTop__col">
                            <h5 class="tours-filter__title">{{trans('site.group_size')}}</h5>
                            <div class="tours-filter-inside__formGroup">
                                @foreach($tour_group_sizes as $tour_group_size)
                                    <div class="tours-filter-inside__formGroup__block">
                                        <input type="button" class="inner-child tours-filter-inside__formGroup__input" value="{{$tour_group_size->size}}" @click="set_group_size({{$tour_group_size->id}})"/>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tours-filter-inside__rowBottom">
                        <div class="tours-filter-inside__rowBottom__col1">
                            <h5 class="tours-filter__title">{{trans('site.hotel_category')}}</h5>
                            <div class="tours-filter-inside__formCategory">
                                @foreach($hotel_categories as $hotel_category)
                                    <div class="tours-filter-inside__formCategory__block">
                                        <input type="button" class="inner-child tours-filter-inside__formCategory__input" style="background-image: url({{asset('uploads/images/main/tour/tours-close.png')}});" value="{{$hotel_category->name}}" @click="set_hotel_category({{$hotel_category->id}})" />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tours-filter-inside__rowBottom__col2">
                            <h5 class="tours-filter__title">{{trans('site.guaranteed')}}</h5>
                            <div class="tours-filter-inside__formGuaranteed">
                                <div class="tours-filter-inside__formGuaranteed__block">
                                    <input type="radio" id="yes" class="tours-filter-inside__formGuaranteed__radio" name="radio-group" :checked="guaranteed == 1" @click="set_guaranteed(1)">
                                    <label for="yes" class="tours-filter-inside__formGuaranteed__radioLabel">{{trans('site.yes')}}</label>
                                </div>
                                <div class="tours-filter-inside__formGuaranteed__block">
                                    <input type="radio" id="no" class="tours-filter-inside__formGuaranteed__radio" name="radio-group" :checked="guaranteed == 2" @click="set_guaranteed(2)">
                                    <label for="no" class="tours-filter-inside__formGuaranteed__radioLabel">{{trans('site.no')}}</label>
                                </div>
                                <div class="tours-filter-inside__formGuaranteed__block">
                                    <input type="radio" id="both" class="tours-filter-inside__formGuaranteed__radio" name="radio-group" :checked="guaranteed == 0" @click="set_guaranteed(0)">
                                    <label for="both" class="tours-filter-inside__formGuaranteed__radioLabel">{{trans('site.both')}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="tours-filter-inside__rowBottom__col3">
                            <div class="tours-filter-inside__formButton">
                                <input type="submit" class="tours-filter-inside__formButton__button" @click="filterFunction()" value="{{trans('site.apply_filters')}}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- tour filter show and hide -->
            <div class="tours-filter--show">
                <p id="show_p" class="tours-filter--show__title">{{trans('site.show_all_filters')}}</p>
                <p id="close_p" style="display: none;" class="tours-filter--show__title">{{trans('site.close_filters')}}</p>
                <img src="{{asset('uploads/images/main/tour/tours-arrowDown.png')}}" id="arrow_down" alt="arrow">
                <img src="{{asset('uploads/images/main/tour/tours-arrowTop.png')}}" style="display: none;" id="arrow_top" alt="arrow">
            </div>
        </section>
        <!-- Tour gallery section -->
        <section class="tours-gallery">
            <div class="wrapper">
                <div class="tours-gallery__row">
                    <h3 class="tours-gallery__title">{{trans('site.all')}} {{trans('site.tours')}}</h3>
                    <a href="{{route('your_own_tour')}}" class="tours-gallery__button">{{trans('site.create_your_own_tour')}}</a>
                </div>
                <div class="tours-gallery--wrapper">
                    <a v-for="tour in items" v-bind:href="'tour/'+ tour.translations[1].slug">
                        <figure class="tours-gallery__figure">
                            <div class="tours-gallery__figure__imgBox" v-if="tour.tour_image" v-bind:style="{ 'background-image': 'url(../' + tour.tour_image + ')' }"></div>
                            <div class="tours-gallery__figure__imgBox" v-else v-bind:style="{ 'background-image': 'url(../uploads/sample_image.jpg)'}"></div>
                            <figcaption class="tours-gallery__figcaption">
                                <h5 v-for="translation in tour.translations" class="tours-gallery__figcaption__title" v-if="translation.locale=='{{App::getLocale()}}'">@{{translation.name}}</h5>
                                <p class="tours-gallery__figcaption__text">@{{tour.nights_count}} {{trans('site.nights')}}, @{{tour.days_count}} {{trans('site.days')}}</p>
                                <!-- <p class="tours-gallery__figcaption__money">{{trans('site.starts_from')}}
                                    <span class="tours-gallery__figcaption__money--span">@{{tour.currency.sign}} @{{tour.start_price}}</span>
                                </p> -->
                                <div class="tours-gallery__figcaption__arrow">
                                    <img src="{{asset('uploads/images/main/tour/tours-arrowRight.png')}}" alt="arrow"/>
                                </div>
                            </figcaption>
                        </figure>
                    </a>
                </div>
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
                                        <img src="{{asset($partner->partner_image)}}" alt="{{$partner->name}}"/>
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
@section('after_scripts')
    <script>
        var tour_api='<?=json_encode(route('tours.api'))?>';
        var tourtypes_api='<?=json_encode(route('tourtypes.api'))?>';
    </script>
    <script src="{{asset('js/tours.js')}}"></script>
@endsection