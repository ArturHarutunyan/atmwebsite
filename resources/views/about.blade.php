@extends('layouts.site_inner', ['header_class' => ''])
@section('custom_meta')
    @foreach($custom_meta_tags as $custom_meta_tag)
        {!! MetaTag::tag($custom_meta_tag->name, $custom_meta_tag->description) !!}
    @endforeach
@endsection
@section('content')
<main class="main">
    <!-- about banner section -->
    <section class="about-banner" style="background-image: url({{asset('uploads/images/main/about/about-banner.png')}});">
        <div class="wrapper"></div>
    </section>
    <!-- about menu section -->
    <section class="about-menu" id="about-menuScroll">
        <div class="wrapper-min">
            <div class="about-menu__mobile">
                <div class="about-menu__mobile__link">{{trans('site.show_sections')}}
                    <img src="{{asset('uploads/images/main/about/about-arrowDown.png')}}" class="about-menu__mobile__icon" alt="arrow"/>
                </div>
            </div>
            <ul class="about-menu__list">
                <li class="about-menu__item">
                    <a href="#about-company" class="about-menu__link about-menu__active">{{trans('site.company')}}</a>
                </li>
                <li class="about-menu__item">
                    <a href="#about-team" class="about-menu__link">{{trans('site.team')}}</a>
                </li>
                <li class="about-menu__item">
                    <a href="#about-project" class="about-menu__link">{{trans('site.our')}} {{trans('site.projects')}}</a>
                </li>
                <li class="about-menu__item">
                    <a href="#about-dmc" class="about-menu__link">{{trans('site.dmc_text')}}</a>
                </li>
                <li class="about-menu__item">
                    <a href="#about-partner" class="about-menu__link">{{trans('site.for_partners')}}</a>
                </li>
                <li class="about-menu__item">
                    <a href="#about-whyMe" class="about-menu__link">{{trans('site.why_we')}}</a>
                </li>
            </ul>
        </div>
    </section>
    <!-- about company section -->
    <section class="about-company scroll-count" id="about-company">
        <div class="wrapper-min about-company--wrapper">
            <aside class="about-col">
                <h3 class="about-title">{{trans('site.company')}}</h3>
                <article>
                   <div class="about-text">
                        {!! $about_content[0]->company_content !!}
                    </div>
                </article>
            </aside>
            <aside class="about-col">
                <div class="about-company-rightSide">
                    <div class="about-company-rightSide__row">
                        <div class="about-company-rightSide__block">
                            <div class="about-company-rightSide__number"><span class="count">20</span>+</div>
                            <p class="about-company-rightSide__text">{{trans('site.years')}}</p>
                        </div>
                        <div class="about-company-rightSide__block">
                            <div class="about-company-rightSide__number"><span class="count">100</span>K+</div>
                            <p class="about-company-rightSide__text">{{trans('site.tourist')}}</p>
                        </div>
                    </div>
                    <div class="about-company-rightSide__row2">
                        <div class="about-company-rightSide__block">
                            <div class="about-company-rightSide__number"><span class="count">4700</span>+</div>
                            <p class="about-company-rightSide__text">{{trans('site.groups')}}</p>
                        </div>
                        <div class="about-company-rightSide__block">
                            <div class="about-company-rightSide__number"><span class="count">180</span>+</div>
                            <p class="about-company-rightSide__text">{{trans('site.events')}}</p>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </section>
    <!-- about team section -->
    <section class="about-team" data-anchor="about-team" id="about-team">
        <div class="wrapper-min">
            <h3 class="about-title">{{trans('site.our_team')}}</h3>
            <div class="about-team__col">
                @foreach($staff_members as $k=>$staff_member)
                <div class="about-team__block{{$k>5?' about-team__toggleable about-team__hidden':''}}">
                    <div class="about-team__imgBox">
                        <img src="{{$staff_member->image?asset($staff_member->image):asset('uploads/sample_image.jpg')}}" alt="{{$staff_member->name}} {{$staff_member->surname}}">
                        <div class="about-team__textBox">
                            <a href="{{$staff_member->facebook}}" target="_blank" class="about-team__social">
                                <img src="{{asset('uploads/images/main/about/about-fb.png')}}" alt="facebook"/>
                            </a>
                            <a href="{{$staff_member->linkedin}}" target="_blank" class="about-team__social">
                                <img src="{{asset('uploads/images/main/about/about-in.png')}}" alt="linkedin"/>
                            </a>
                        </div>
                    </div>
                    <h5 class="about-team__title">{{$staff_member->name}} {{$staff_member->surname}}</h5>
                    <p class="about-team__text">{{$staff_member->position}}</p>
                </div>
                @endforeach
            </div>
            <div class="about-team__buttonRow">
                <button type="button" class="about-team__button about-team__toggleable" onclick="toggleStaffMembers()">{{trans('site.view_all_employees')}}</button>
                <button type="button" class="about-team__button about-team__toggleable about-team__hidden" onclick="toggleStaffMembers()">{{trans('site.view_less')}}</button>
            </div>
        </div>
    </section>
    <!-- about project section -->
    <section class="about-project" data-anchor="about-project" id="about-project">
        <div class="wrapper-min about-project--wrapper">
            <aside class="about-col">
                <h3 class="about-title">{{trans('site.our')}}<span class="about-spanBlock">{{trans('site.projects')}}</span></h3>
                <article class="about-text">
                   {!! $about_content[0]->our_projects_content !!}
                </article>
            </aside>
            <aside class="about-col">
                <div class="about-project__col">
                    <a target="_blank" href="https://epicstudy.org/" class="about-project__block">
                        <div class="about-project__imgBox" style="background-image: url({{asset('uploads/images/main/about/about-img3.png')}})"></div>
                        <div class="about-project__textBox">
                            <p class="about-project__textBox__text">EPIC Intrnational summer school Armenia 2019</p>
                            <img src="{{asset('uploads/images/main/about/about-rightArrow.png')}}" alt="arrow"/>
                        </div>
                    </a>
                    <a target="_blank" href="https://epiceyefestival.com/" class="about-project__block">
                        <div class="about-project__imgBox" style="background-image: url({{asset('uploads/images/main/about/about-img4.png')}}"></div>
                        <div class="about-project__textBox">
                            <p class="about-project__textBox__text">EPIC Eye Festival</p>
                            <img src="{{asset('uploads/images/main/about/about-rightArrow.png')}}" alt="arrow"/>
                        </div>
                    </a>
                </div>
                <div>
                    <ul class="about-project__list">
                        @foreach($projects_5 as $project)
                            <li class="about-project__item">{{$project->name}}</li>
                        @endforeach
                    </ul>
                    <button class="about-project__button" data-toggle="modal" data-target="#projectsModal">{{trans('site.view_all')}}</button>
                </div>
            </aside>
        </div>
    </section>
    <!-- about dmc section -->
    <section class="about-dmc" data-anchor="about-dmc" id="about-dmc">
        <div class="wrapper-min about-dmc--wrapper">
            <aside class="about-col">
                <h3 class="about-title">{{trans('site.dmc_text_part_one')}} <span class="about-spanBlock">{{trans('site.dmc_text_part_two')}}</span></h3>
                <article>
                   <div class="about-text">
                        {!! $about_content[0]->dmc_content !!}
                    </div>
                </article>
            </aside>
            <aside class="about-col">
                <div class="about-dmc__row">
                    <p class="about-dmc__number">01</p>
                    <h5 class="about-dmc__title">{{trans('site.excursion_programmes')}}</h5>
                    <div class="about-dmc__text">
                        {!! $about_content[0]->excursion_content !!}
                    </div>
                </div>
                <div class="about-dmc__row">
                    <p class="about-dmc__number">02</p>
                    <h5 class="about-dmc__title">{{trans('site.logistics_text')}}</h5>
                    <div class="about-dmc__text">
                        {!! $about_content[0]->logistics_content !!}
                    </div>
                </div>
                <div class="about-dmc__row">
                    <p class="about-dmc__number">03</p>
                    <h5 class="about-dmc__title">{{trans('site.special_events_text')}}</h5>
                    <div class="about-dmc__text">
                        {!! $about_content[0]->special_events_content !!}
                    </div>
                </div>
            </aside>
        </div>
    </section>
    <!-- about partners section -->
    <section class="about-partner" data-anchor="about-partner" id="about-partner">
        <div class="wrapper-min about-partner--wrapper">
            <aside class="about-col">
                <h3 class="about-title">{{trans('site.for')}} <span class="about-spanBlock">{{trans('site.partner_ov')}}</span></h3>
                <article>
                    <div class="about-text">
                        {!! $about_content[0]->for_partners_content !!}
                    </div>
                </article>
            </aside>
            <aside class="about-col">
                <h3 class="about-partner__header">{{trans('site.how_it_works')}}</h3>
                <div class="about-partner__rightSide">
                    <ol>
                        <li>
                            <span class="about-partner__title">{{trans('site.get_login_text')}}</span>
                            <div class="about-partner__text">
                                {!! $about_content[0]->login_password_content !!}
                            </div>
                        </li>
                        <li>
                            <span class="about-partner__title">{{trans('site.your_account_text')}}</span>
                            <div class="about-partner__text">
                                {!! $about_content[0]->your_account_content !!}
                            </div>
                        </li>
                        <li>
                            <span class="about-partner__title">{{trans('site.view_special_content')}}</span>
                            <div class="about-partner__text">
                                {!! $about_content[0]->special_content !!}
                            </div>
                        </li>
                    </ol>
                </div>
            </aside>
        </div>
    </section>
    <!-- about whyMe section -->
    <section class="about-whyMe" data-anchor="about-whyMe" id="about-whyMe">
        <div class="wrapper-min">
            <h3 class="about-title">{{trans('site.why_me')}}</h3>
            <div class="about-whyMe__row">
                <div class="about-whyMe__col">
                    {!! $about_content[0]->why_me_first_image !!}
                    <h6 class="about-whyMe__title">
                        {{$about_content[0]->why_me_first_title}}
                    </h6>
                    <div class="about-whyMe__text">
                        {!!$about_content[0]->why_me_first_content!!}
                    </div>
                </div>
                <div class="about-whyMe__col">
                    {!! $about_content[0]->why_me_second_image !!}
                    <h6 class="about-whyMe__title">
                        {{$about_content[0]->why_me_second_title}}
                    </h6>
                    <div class="about-whyMe__text">
                        {!!$about_content[0]->why_me_second_content!!}
                    </div>
                </div>
                <div class="about-whyMe__col">
                    {!! $about_content[0]->why_me_third_image !!}
                    <h6 class="about-whyMe__title">
                        {{$about_content[0]->why_me_third_title}}
                    </h6>
                    <div class="about-whyMe__text">
                        {!!$about_content[0]->why_me_third_content!!}
                    </div>
                </div>
                <div class="about-whyMe__col">
                    {!! $about_content[0]->why_me_fourth_image !!}
                    <h6 class="about-whyMe__title">
                        {{$about_content[0]->why_me_fourth_title}}
                    </h6>
                    <div class="about-whyMe__text">
                        {!!$about_content[0]->why_me_fourth_content!!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade armenia-modal" id="projectsModal" tabindex="-1" role="dialog" aria-labelledby="projectsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{asset('uploads/images/main/armenia/modal-close.png')}}" alt="close">
                    </button>
                    <img class="modal-image" src="http://10.10.10.254/uploads/about_armenia_contents/1540393149img_1.png" alt="image"/>
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
<script src="{{asset('js/jquery.hash-magic.min.js')}}"></script>
<script src="{{asset('js/jquery.scrollTo.min.js')}}"></script>


@endsection