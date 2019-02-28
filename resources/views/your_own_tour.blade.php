@extends('layouts.site_inner', ['header_class' => ''])
@section('before_styles')
    <link rel='stylesheet' href='{{asset("css/v-calendar.min.css")}}'>
@endsection
@section('before_scripts')
    <script src='{{asset('js/v-calendar.min.js')}}'></script>
@endsection
@section('custom_meta')
    @foreach($custom_meta_tags as $custom_meta_tag)
        {!! MetaTag::tag($custom_meta_tag->name, $custom_meta_tag->description) !!}
    @endforeach
@endsection
@section('content')
    <main class="main">
        <!-- Tour banner section -->
        <section class="tours-banner" style="background-image: url({{asset('uploads/images/main/tour/tours-banner.png')}})"></section>
        <!-- Tour custom inside section -->
        <section class="tours-custom-form">
            <div class="wrapper-min">
                <div class="tours-custom-form--wrapper">
                    <!-- tours-custom title -->
                    <div class="tours-custom-form__blockCol">
                        <h5 class="tours-custom-form__title">{{trans('site.create_your_own_tour_part_one')}}
                            <span class="tours-custom-form__span">{{trans('site.create_your_own_tour_part_two')}}</span>
                        </h5>
                        <p class="tours-custom-form__text">{{trans('site.your_own_tour_text')}}</p>
                    </div>
                    <!-- tours-custom form -->
                    <div class="tours-custom-form__blockCol">
                        @if(count($errors)>0)
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{$error}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                        @if(Session::has('success_message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ Session::get('success_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <form action="{{route('your_own_tour.mail')}}" method="POST">
                            {{csrf_field()}}
                            <div class="tours-custom-form__row">
                                <div class="tours-custom-form__inputBlock">
                                    <label for="name" class="tours-custom-form__label">{{trans('site.name')}}
                                        <span class="tours-custom-form__star">*</span>
                                    </label>
                                    <input type="text" id="name" name="name" required class="tours-custom-form__input"/>
                                </div>
                                <div class="tours-custom-form__inputBlock">
                                    <label for="email" class="tours-custom-form__label">{{trans('site.email')}}
                                        <span class="tours-custom-form__star">*</span>
                                    </label>
                                    <input type="email" id="email" name="email" required class="tours-custom-form__input"/>
                                </div>
                                <div class="tours-custom-form__inputBlock">
                                    <label for="numberPeople" class="tours-custom-form__label">{{trans('site.number_of_people')}}
                                        <span class="tours-custom-form__star">*</span>
                                    </label>
                                    <input type="text" id="numberPeople" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="number_of_people" autocomplete="off" required class="tours-custom-form__input"/>
                                </div>
                            </div>
                            <div class="tours-custom-form__row">
                                <div class="tours-custom-form__inputBlock">
                                    <div class="tours-custom-form__labelBlock">
                                        <label for="type" class="tours-custom-form__label">{{trans('site.type')}}
                                            <span class="tours-custom-form__star">*</span>
                                        </label>
                                    </div>
                                    <select name="type" id="type" class="tours-custom-form__select">
                                        <option value=""></option>
                                        @foreach($tour_types as $type)
                                            <option value="{{$type->name}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="tours-custom-form__inputBlock">
                                    <div id='calendar'>
                                        <div class="tours-custom-form__labelBlock">
                                            <label for="dates" class="tours-custom-form__label">{{trans('site.dates')}}
                                                <span class="tours-custom-form__star">*</span>
                                            </label>
                                            <img src="{{asset('uploads/images/main/tour/calendar-icon.png')}}" alt="calendar"/>
                                        </div>
                                        <v-date-picker is-double-paned :mode='mode' v-model='selectedDate'
                                                       :min-date='new Date()'
                                                       :input-props='{ class: "tours-custom-form__input", placeholder: "Choose the dates", readonly: true, name: "dates", id: "dates", required: "required"}'>
                                        </v-date-picker>
                                    </div>
                                </div>
                            </div>


                            <div class="tours-custom-form__rowTextarea">
                                <label for="message" class="tours-custom-form__label">{{trans('site.other_features')}}
                                    <span class="tours-custom-form__star">*</span>
                                </label>
                                <textarea name="message" id="message" rows="4" required class="tours-custom-form__input"></textarea>
                            </div>
                            <div class="tours-custom-form__rowButton">
                                <input type="submit" value="{{trans('site.send')}}" class="tours-custom-form__button">
                            </div>
                        </form>
                    </div>
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
    <script>
        new Vue({
            el: '#calendar',
            data: {
                // Data used by the date picker
                mode: 'range',
                selectedDate: null,
                placeholder: null
            }
        })
    </script>
@endsection