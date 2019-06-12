@extends('layouts.site_inner', ['header_class' => ' header--white'])
@section('custom_meta')
    @foreach($custom_meta_tags as $custom_meta_tag)
        {!! MetaTag::tag($custom_meta_tag->name, $custom_meta_tag->description) !!}
    @endforeach
@endsection

@section('content')
    <main class="main">
        <div class="blog-inner-first-background" style="background-image: url({{asset($blog->image)}});"></div>
        <section class="newsInner">
            <div class="wrapper-min">
                <div class="news--wrapper">
                    <h2 class="newsInner__title">{{$blog->title}}</h2>
                    <p class="newsInner__day">
                        {{trans('site.month_'.date("n",strtotime($blog->created_at))).' '.
                          date("d",strtotime($blog->created_at)).', '.
                          date("Y",strtotime($blog->created_at))}}
                    </p>
                    <div class="newsInner__text">{!! $blog->text_content !!}</div>
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