@extends('layouts.site_inner', ['header_class' => ' header--white'])
@section('custom_meta')
    @foreach($custom_meta_tags as $custom_meta_tag)
        {!! MetaTag::tag($custom_meta_tag->name, $custom_meta_tag->description) !!}
    @endforeach
@endsection

@section('content')
    <main class="main">
        <!-- map section -->
        <section class="contact-map">
            <div id="map"></div>
        </section>
        <!-- contact info section -->
        <section class="contact-info">
            <div class="wrapper-min">
                <div class="contact-info--wrapper">
                    <div class="contact-info__col">
                        <p class="contact-info__text">
                            <span class="contact-info__span">{{trans('site.address')}}: </span>
                            {{trans('site.company_address')}}
                        </p>
                    </div>
                    <div class="contact-info__col">
                        <p class="contact-info__text">
                            <span class="contact-info__span">{{trans('site.phone_number')}}: </span>
                            +37410 56 36 67
                        </p>
                    </div>
                    <div class="contact-info__col">
                        <p class="contact-info__text">
                            <span class="contact-info__span">{{trans('site.email')}}: </span>
                            <a class="link-unstyled" href="mailto:incoming@armeniatravel.am" target="_top">incoming@armeniatravel.am</a>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact form section -->
        <section class="contact-form">
            <div class="wrapper-min">
                <div class="contact-form--wrapper">
                    <!-- contact title -->
                    <div class="contact-form__blockCol">
                        <h5 class="contact-form__title">{{trans('site.get_in_touch_part_1')}}
                            <span class="contact-form__span">{{trans('site.get_in_touch_part_2')}}</span>
                        </h5>
                        <p class="contact-form__text">{{trans('site.contact_us_text')}}</p>
                    </div>
                    <!-- contact form -->
                    <div class="contact-form__blockCol">
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
                        <form action="{{route('contact.mail')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="contact-form__row">
                                <div class="contact-form__inputBlock">
                                    <label for="name" class="contact-form__label">{{trans('site.name')}}
                                        <span class="contact-form__star">*</span>
                                    </label>
                                    <input type="text" id="name" name="name" required value="{{old('name') }}" class="contact-form__input"/>
                                </div>
                                <div class="contact-form__inputBlock">
                                    <label for="email" class="contact-form__label">{{trans('site.email')}}
                                        <span class="contact-form__star">*</span>
                                    </label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" required class="contact-form__input"/>
                                </div>
                                <div class="contact-form__inputBlock">
                                    <label for="subject" class="contact-form__label">{{trans('site.subject')}}
                                        <span class="contact-form__star">*</span>
                                    </label>
                                    <input type="text" id="subject" name="subject" required class="contact-form__input"
                                    @if(isset($subject))
                                        value="{{$subject}}"
                                    @else
                                        value="{{ old('subject') }}"
                                    @endif
                                    />
                                </div>
                            </div>
                            <div class="contact-form__rowTextarea">
                                <label for="message" class="contact-form__label">{{trans('site.message')}}
                                    <span class="contact-form__star">*</span>
                                </label>
                                <textarea name="message" id="message" rows="4" required class="contact-form__input">{{old('message')?old('message'):''}}</textarea>
                            </div>
                            <div class="contact-form__rowButton">
                                <input type="submit" name="submited" value="send" class="contact-form__button">
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
@endsection
@section('after_scripts')
    <script>
        function initMap() {
            // Map options
            var options ={
                zoom: 17,
                center: {lat:40.1787284,lng:44.5174512},
                styles: [
                    {
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#f5f5f5"
                            }
                        ]
                    },
                    {
                        "elementType": "labels.icon",
                        "stylers": [
                            {
                                "lightness": 100
                            },
                            {
                                "visibility": "on"
                            }
                        ]
                    },
                    {
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#616161"
                            }
                        ]
                    },
                    {
                        "elementType": "labels.text.stroke",
                        "stylers": [
                            {
                                "color": "#f5f5f5"
                            }
                        ]
                    },
                    {
                        "featureType": "administrative.land_parcel",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#bdbdbd"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#eeeeee"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#757575"
                            }
                        ]
                    },
                    {
                        "featureType": "poi.park",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#e5e5e5"
                            }
                        ]
                    },
                    {
                        "featureType": "poi.park",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#9e9e9e"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#ffffff"
                            }
                        ]
                    },
                    {
                        "featureType": "road.arterial",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#757575"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#dadada"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#616161"
                            }
                        ]
                    },
                    {
                        "featureType": "road.local",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#9e9e9e"
                            }
                        ]
                    },
                    {
                        "featureType": "transit.line",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#e5e5e5"
                            }
                        ]
                    },
                    {
                        "featureType": "transit.station",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#eeeeee"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "geometry",
                        "stylers": [
                            {
                                "color": "#c9c9c9"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#9e9e9e"
                            }
                        ]
                    }
                ]
            };

            // New map
            var map = new google.maps.Map(document.getElementById('map'), options);

            // Add marker
            var marker = new google.maps.Marker({
                position: {lat:40.1787284,lng:44.5174512},
                map: map,
                icon: '{{asset("uploads/images/main/map-marker.png")}}'
            });

            // Info window
            var infoWindow = new google.maps.InfoWindow({
                content: '<h6>4 Vardanants Street, Yerevan</h6>'
            });

            marker.addListener('click', function(){
                infoWindow.open(map, marker);
            });
        }
    </script>
    <script async="" defer="" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBbKqoBQ7Vx-1GSCPOae9mOWU-0vCaOoqs&amp;callback=initMap" type="text/javascript"></script>
@endsection