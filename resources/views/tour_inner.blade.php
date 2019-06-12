@extends('layouts.site_inner', ['header_class' => ' header--white'])
@section('custom_meta')
    @foreach($custom_meta_tags as $custom_meta_tag)
        {!! MetaTag::tag($custom_meta_tag->name, $custom_meta_tag->description) !!}
    @endforeach
@endsection
@section('content')
    <main class="main">
        <!-- TourInner banner section -->
        @if($tour->tour_image)
            <section class="tourInner-banner" style="background: url({{asset($tour->tour_image)}}); background-repeat: no-repeat;
                    background-position: center center;
                    -webkit-background-size: cover;
                    background-size: cover;
                    min-height: 650px;"></section>
        @else
            <section class="tourInner-banner" style="background: url({{asset('uploads/sample_image.jpg')}}); background-repeat: no-repeat;
                    background-position: center center;
                    -webkit-background-size: cover;
                    background-size: cover;
                    min-height: 650px;"></section>
        @endif

        <!-- TourInner info section -->
        <section class="tourInner-info">
            <div class="wrapper">
                <div class="tourInner-info--wrapper">
                    <div class="tourInner-info__col">
                        <p class="tourInner-info__text">
                            <span class="tourInner-info__title">{{trans('site.types')}}:</span>
                            @foreach($tour->tour_types as $type)
                                {{$type->name}}
                            @endforeach
                        </p>
                    </div>
                    <div class="tourInner-info__col">
                        <p class="tourInner-info__text">
                            <span class="tourInner-info__title">{{trans('site.period')}}:</span>
                            {{$tour->period->name}}
                        </p>
                    </div>
                    <div class="tourInner-info__col">
                        <p class="tourInner-info__text">
                            <span class="tourInner-info__title">{{trans('site.hotel')}}: </span>
                            {{$tour->hotel->name}}
                        </p>
                    </div>
                    <div class="tourInner-info__col">
                        <p class="tourInner-info__text">
                            <span class="tourInner-info__title">{{trans('site.guaranteed')}}:</span>
                            @if($tour->guaranteed==1)
                                {{trans('site.yes')}}
                            @elseif($tour->guaranteed==2)
                                {{trans('site.no')}}
                            @endif
                        </p>
                    </div>
                   <!--  <div class="tourInner-info__col">
                        <p class="tourInner-info__text">
                            <span class="tourInner-info__title">{{trans('site.price')}}:</span>
                            {{$tour->start_price}} {{$tour->currency->sign}}
                        </p>
                    </div>
                </div> -->
            </div>
        </section>
        <!-- TourInner content section -->
        <section class="tourInner-content">
            <div class="tourInner-content__location">
                <img class="not-intersection" src="{{asset('uploads/images/main/tour-inner/tourInner-location.png')}}" alt="location"/>
            </div>
            <div class="wrapper tourInner-content--wrapper">
            <!-- style="background: url({{asset('uploads/images/main/tour-inner/tourInner-division.png')}}) repeat-y center center;" -->
                <aside class="tourInner-content__aside" 
               
                >
                    <?php
                        $c=0;
                        $zIndex = 70;
                        $first = 0
                    ?>
                    @foreach($tour->days as $day)
                        <?php ++$c;
                            --$zIndex;
                            ++$first;
                        ?>
                        <div class="turs_items_container" >
                                    @if($c%2)
                                        <!-- <div class="col-md-6"></div>
                                        <div class="tourInner-content__asideRight">
                                            <h3 class="tourInner-content__title">{{trans('site.day')}} {{$day->day_number}}</h3>
                                            <div class="tourInner-content__text">{!! $day->text_content!!}</div>
                                        </div> -->

                                        <!-- svg Line  1-->

                                        <svg class="tursSVGLine {{$first==1? 'firstPathTur':null}}" style="z-index:{{$zIndex}} ;" xmlns:xlink="http://www.w3.org/1999/xlink"  style="overflow:visible" fill="none" preserveAspectRatio="none">
                                            

                                       
                                            <path d="M -33 -86 Q 50.5 -22.5 -48 54" date_line="1" date_open='0' ></path>
                                            <!-- <path d="M-49,-75 Q84.5,48.5,91,75" date_line="1" date_open='0' ></path> -->
                                                

                                            <defs>
                                             <pattern id="secendBreackpointImage1" height="100%" width="100%" patternContentUnits="objectBoundingBox">
                                                 <image xlink:href="{{asset('uploads/images/main/secondBreackpoint.png')}}" preserveAspectRatio="none"   width="1.01" height="1.01" >

                                                 </image>
                                             </pattern>
                                             </defs>
                                                 <circle cx="0" cy="0" class="breackpointCircle shadow" r="15" fill="#004270" >
                                             </circle>
                                        </svg>

                                        <div class="tours_slider_container">
                                            


                                            <div class="slider">

                                                <div class="slider-holder">

                                                    <div class="owl-carousel">

                                                        <div class="mySlides">
                                                            <img data-src="{{asset('uploads/tours/1533214003DSC01220.1.jpg')}}" style="width:100%">
                                                        </div>
                                                        <div class="mySlides">
                                                            <img data-src="{{asset('uploads/tours/1533214003DSC01220.1.jpg')}}" style="width:100%">
                                                        </div>
                                                        <div class="mySlides">
                                                            <img data-src="{{asset('uploads/tours/1533214003DSC01220.1.jpg')}}" style="width:100%">
                                                        </div>
                                                      
                                                    </div>

                                                    <div class="controls slide_change_container">
                                                    <span>
                                                        <div class="arrowleft">←</div>
                                                        
                                                    </span>
                                                    <span>
                                                     <div class="arrowright">→</div>
                                                   
                                                    </span>
                                                         </div>

                                                </div>
                                            </div>

                                            
                                        </div>
                                        <div >
                                            <h3 class="tourInner-content__title">
                                               
                                                <p class='h3Text'>{{trans('site.day')}} {{$day->day_number}}</p>

                                                <span>+</span>
                                            </h3>
                                            <div class="tourInner-content__text">{!! $day->text_content!!}</div>
                                        </div>
                                    @else
                                    
                                    <!-- svg Line  2-->
                                    <svg class="tursSVGLine" style="z-index:{{$zIndex}}" xmlns:xlink="http://www.w3.org/1999/xlink"  style="overflow:visible" fill="none" preserveAspectRatio="none">
	
                                        <path d="M -43 -80 Q -131.5 -22.5 -35 48"  date_line="2" date_open='0'   ></path>
                                        <!-- <path d="M94, -50Q -70.5,55.5,-44,53" date_line="2" date_open='0'   ></path> -->
                                        <!-- path("M -53 -76 Q -221.5 -31.5 91 78") -->

                                        <defs>
                                        <pattern id="secendBreackpointImage2" height="100%" width="100%" patternContentUnits="objectBoundingBox">
                                            <image xlink:href="{{asset('uploads/images/main/secondBreackpoint.png')}}" preserveAspectRatio="none"   width="1.01" height="1.01" >

                                            </image>
                                        </pattern>
                                         </defs>
                                             <circle cx="0" cy="0" class="breackpointCircle shadow" r="15" fill="#004270" >
                                         </circle>

                                    </svg>
                                    <!-- <div class="col-md-6 tourInner-content__asideLeft">
                                        <h3 class="tourInner-content__title">{{trans('site.day')}} {{$day->day_number}}</h3>
                                        <div class="tourInner-content__text">{!! $day->text_content!!}</div>
                                    </div>  
                                    <div class="col-md-6"></div>  -->
                                         <div >   
                                             <h3 class="tourInner-content__title">
                                             <p class='h3Text'>{{trans('site.day')}} {{$day->day_number}}</p>

                                                <span>+</span>
                                             </h3>
                                             <div class="tourInner-content__text">{!! $day->text_content!!}</div>
                                        </div>
                                         
                                             
                                             <div class="tours_slider_container">
                                        



                                             <div class="slider">

                                                    <div class="slider-holder">

                                                        <div class="owl-carousel">

                                                            <div class="mySlides">
                                                                <img data-src="{{asset('uploads/tours/1533214003DSC01220.1.jpg')}}" style="width:100%">
                                                            </div>
                                                            <div class="mySlides">
                                                                <img data-src="{{asset('uploads/tours/1533214003DSC01220.1.jpg')}}" style="width:100%">
                                                            </div>
                                                            <div class="mySlides">
                                                                <img data-src="{{asset('uploads/tours/1533214003DSC01220.1.jpg')}}" style="width:100%">
                                                            </div>
                                                        
                                                        </div>

                                                        <div class="controls slide_change_container">
                                                        <span>
                                                            <div class="arrowleft">←</div>
                                                            
                                                        </span>
                                                        <span>
                                                        <div class="arrowright">→</div>
                                                    
                                                        </span>
                                                            </div>

                                                    </div>
                                                    </div>
                                            
                                        </div>
                                    @endif
                         </div>
                    @endforeach
                </aside>
                
            </div>
            <div class="tourInner-content__wrapper__buttons">
                <!-- color #004270  -->
                <a href="{{URL::previous()}}" class='linkButton'>{{trans('site.back')}}</a>
                <form hidden action="{{route('contact')}}" method="post" id="book_now_form">
                    {{csrf_field()}}
                    <input type="hidden" name="subject" value="Tour: {{$tour->name}}">
                </form>
                <a href="#" class='linkButton' onclick="event.preventDefault(); $('#book_now_form').submit();">{{trans('site.book_now')}}</a>
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