@extends('layouts.site_inner', ['header_class' => ' header--white'])
@section('custom_meta')
    @foreach($custom_meta_tags as $custom_meta_tag)
        {!! MetaTag::tag($custom_meta_tag->name, $custom_meta_tag->description) !!}
    @endforeach
@endsection

@section('content')
    <main class="main">
        <!-- news content section -->
        <section class="armenia-banner" style="background-image: url({{asset('uploads/images/main/PR.jpg')}})">
            <div class="wrapper"></div>
        </section>
        <div class='armenia-tabs'>
            <div class="armenia-tabs__menu " id="armenia-menuScroll">
                <div class="about-menu__mobile">
                    <div class="about-menu__mobile__link">{{trans('site.show_sections')}}
                        <img src="{{asset('uploads/images/main/about/about-arrowDown.png')}}" class="about-menu__mobile__icon" alt="arrow">
                    </div>
                </div>
                <ul class="armenia-tabs__list wrapper ">
                    <li class="armenia-tabs__link current" data-tab="tab-1">{{trans('site.news')}}</li>
                    <li class="armenia-tabs__link" data-tab="tab-3">{{trans('site.blog')}}</li>
                    <li class="armenia-tabs__link" data-tab="tab-2">{{trans('site.gallery')}}</li>
                    <li class="armenia-tabs__link" data-tab="tab-4">{{trans('site.reviews')}}</li>
                    <li class="armenia-tabs__link" data-tab="tab-5">{{trans('site.certificates')}}</li>
                    <li class="armenia-tabs__link" data-tab="tab-6">{{trans('site.trustees')}}</li>
                </ul>
            </div>
            <div class="armenia-tabs__container PRContainer">
                <section  id='tab-1' class="news armenia-tabs__content tabSections  current">
                    <div class="wrapper-min">
                        <div class="armenia-food">
                            @foreach($news as $single_news)
                                <figure class="armenia-food__figure cardEfect" onclick="modalOpen('{{$single_news->id}}','news','{{asset($single_news->image)}}','{{App::getLocale()}}')">
                                    <div class="armenia-food__imgBox cardEfectImage" style="background-image: url({{asset($single_news->image)}});"></div>
                                    <div class="cardEfectBackground">
                                        {!! $single_news->text_content !!}
                                    </div>
                                    <figcaption class="armenia-food__figcaption">{{$single_news->title}}</figcaption>
                                </figure>
                            @endforeach
                        </div>
                    </div>
                </section>
                <section id='tab-2' class="news armenia-tabs__content tabSections">
                    <div class="snitcher">
                        <span class='activeButton'>{{trans('site.photos')}}</span>
                        <span>{{trans('site.videos')}}</span>
                    </div>
                    <div class="photos">
                        <div class="wrapper-min">
                            <div class="armenia-food">
                                @foreach($photos as $photo)
                                    <figure class="armenia-food__figure cardEfect" onclick="modalOpen('{{$photo->id}}','photo','{{asset($photo->image)}}','{{App::getLocale()}}')">
                                        <div class="armenia-food__imgBox cardEfectImage" style="background-image: url('{{asset($photo->image)}}');"></div>
                                        <div class="cardEfectBackground"></div>
                                        <figcaption class="armenia-food__figcaption">{{ $photo->title }}</figcaption>
                                    </figure>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="videos passive">
                        @foreach($videos as $video)
                            <div class="video-container">
                                <div class="video-container__content" onclick="modalOpen('{{$video->id}}','video','','{{App::getLocale()}}')">
                                    <img src="{{asset($video->image)}}" alt="">
                                    <h4>{{$video->title}}</h4>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
                <section id='tab-3' class="news armenia-tabs__content tabSections"  >
                    <div class="wrapper-min">
                        <div class="news--wrapper">
                            <div class="news-gallery">
                                @foreach($blogs as $blog)
                                    <figure class="news-gallery__figure">
                                        <a href="{{route('blog.show',['slug'=>$blog->getTranslation(app()->getLocale())->slug])}}">
                                            <div class="news-gallery__figure__imgBox" style="background-image: url({{asset($blog->image)}})"></div>
                                        </a>
                                        <figcaption class="news-gallery__figcaption">
                                            <a href="{{route('blog.show',['slug'=>$blog->getTranslation(app()->getLocale())->slug])}}">
                                                <h5 class="news-gallery__figcaption__title">{{$blog->title}}</h5>
                                            </a>
                                            <p class="news-gallery__figcaption__day">
                                                {{trans('site.month_'.date("n",strtotime($blog->created_at))).' '.
                                                date("d",strtotime($blog->created_at)).', '.
                                                date("Y",strtotime($blog->created_at))}}
                                            </p>
                                            <div class="news-gallery__figcaption__text">
                                                {!! $blog->text_content !!}
                                            </div>
                                            <a href="{{route('blog.show',['slug'=>$blog->getTranslation(app()->getLocale())->slug])}}" class="news-gallery__figcaption__link">{{trans('site.read_more')}}
                                                <img src="{{asset('uploads/images/main/news-arrow-right.png')}}" alt="arrow">
                                            </a>
                                        </figcaption>
                                    </figure>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
                <section id='tab-4' class="news armenia-tabs__content tabSections"  >
                    <div class="reviews__container">
                        @foreach($testimonials as $testimonial)
                            <div class="item">
                                <div class="welcome__carousel">
                                    <div class="welcome__carousel__block">
                                        <div class="welcome__carousel__imgBlock">
                                            @if($testimonial->author_image)
                                                <img src="{{asset($testimonial->author_image)}}" class="welcome__carousel__imgBlock--img" alt="{{$testimonial->author}}"/>
                                            @elseif($testimonial->gender==1)
                                                <img src="{{asset('uploads/images/main/woman.svg')}}" class="welcome__carousel__imgBlock--img" alt="{{$testimonial->author}}"/>
                                            @else
                                                <img src="{{asset('uploads/images/main/man.svg')}}" class="welcome__carousel__imgBlock--img" alt="{{$testimonial->author}}"/>
                                            @endif
                                        </div>
                                    </div>
                                    <article class="welcome__carousel__article">
                                        <div class="welcome__carousel__opinion">{!! $testimonial->text_content !!}</div>
                                        <h5 class="welcome__carousel__userName">{{$testimonial->author}}</h5>
                                    </article>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
                <section id='tab-5' class="news armenia-tabs__content tabSections"  >
                    <div class="wrapper-min">
                        <div class="armenia-food">
                            @foreach($certificates as $certificate)
                                <figure class="armenia-food__figure cardEfect" onclick="modalOpen('{{$certificate->id}}','certificate','{{asset($certificate->image?$certificate->image:'uploads/sample_image.jpg')}}','{{App::getLocale()}}')">
                                    @if($certificate->image)
                                        <div class="armenia-food__imgBox cardEfectImage" style="background-image: url('{{asset($certificate->image)}}')"></div>
                                    @else
                                        <div class="armenia-food__imgBox cardEfectImage" style="background-image: url({{asset('uploads/sample_image.jpg')}})"></div>
                                    @endif
                                    <div class="cardEfectBackground">
                                        {!! $certificate->text_content !!}
                                    </div>
                                    <figcaption class="armenia-food__figcaption">{{$certificate->title}}</figcaption>
                                </figure>
                            @endforeach
                        </div>
                    </div>
                </section>
                <section id='tab-6' class="news armenia-tabs__content tabSections"  >
                    <div class="wrapper-min">
                        <ul id="armenia-sightseeing__inner">
                            @foreach($trustees as $trustee)
                                <li class="armenia-sightseeing__row">
                                    <aside class="armenia-sightseeing__aside">
                                        @if($trustee->image)
                                            <div class="armenia-sightseeing__aside__imgBox" style="background-image: url('{{asset($trustee->image)}}')"></div>
                                        @else
                                            <div class="armenia-sightseeing__aside__imgBox" style="background-image: url({{asset('uploads/sample_image.jpg')}})"></div>
                                        @endif
                                    </aside>
                                    <article class="armenia-sightseeing__article" data-id="{{$trustee->id}}">
                                        <h4 class="armenia-sightseeing__article__title">{{$trustee->title}}</h4>
                                        <div class="armenia-sightseeing__article__text">
                                            {!! $trustee->text_content !!}
                                        </div>
                                    </article>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <div class="modal fade armenia-modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <img src="{{asset('uploads/images/main/armenia/modal-close.png')}}" alt="close">
                                </button>
                                <img class="modal-image" src='{{asset('uploads/sample_image.jpg')}}' alt="image">
                            </div>
                            <div class="armenia-modal__body">
                                <h6 class="armenia-modal__title"></h6>
                                <div class="armenia-modal__text"></div>
                            </div>
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
        $(document).ready(function () {
            for(let i=0; i<$('.news-gallery__figcaption__text').length; ++i){
                let innerText=$('.news-gallery__figcaption__text').eq(i).text().split("");
                let shortText="";
                for(j=0;j<256;++j){
                    shortText+=innerText[j];
                }
                shortText+="...";
                $('.news-gallery__figcaption__text').eq(i).html(shortText);
            }
        });
    </script>
@endsection