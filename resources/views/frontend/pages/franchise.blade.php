@extends('frontend.layout')
@section('page_name')
    franchise
@endsection

@section('title')
    {{ env('APP_NAME') }}
@endsection
@section('content')
    <x-hero-section page="franchise" />
    <section class="fluid-section-one">
        <div class="outer-container clearfix">
            <div class="content-column">
                <div class="inner-column">
                    <div class="sec-title">
                        {!! $settings['franchise_model'] !!}
                    </div>
                    <div class="button-box">
                        <a href="javascript:void(0)" class="theme-btn btn-style-two clearfix open-popup" data-attr="franchise"><span class="icon"></span>Enquire
                            Now</a>
                    </div>
                </div>
            </div>
            <div class="image-column" style="background-image:url({{ asset('assets/frontend/images/about/invest.jpg') }})">
                <figure class="image-box"><img src="{{  $settings['franchise_image_url'] }}" alt=""></figure>
            </div>
        </div>
    </section>
    <section class="juice-section">
        <div class="section-text">Fantoos</div>
        <div class="auto-container">
            <div class="row clearfix">
                <div class="image-column col-lg-7 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="image">
                            <img src="{{  $settings['funtoos_image_url'] }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="content-column col-lg-5 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="sec-title">
                            {!! $settings['funtoos_description'] !!}
                        </div>
                        <a href="javascript:void(0)" class="theme-btn btn-style-two clearfix open-popup" data-attr="franchise"><span class="icon"></span>Enquire
                            Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-testimonial />
    <section class="news-section-two">
        <div class="auto-container">
            <div class="row clearfix">

                <!-- Left Column -->
                <div class="left-column col-lg-3 col-md-6 col-sm-12">
                    <div class="inner-column">

                        <!-- Recipe Block Three / Style Two -->
                        <div class="recipe-block-three style-two">
                            <div class="inner-box">
                                <div class="image">
                                    <img src="{{ $settings['funtoos_image_1_url'] }}" alt="">
                                    <!-- Overlay Box -->
                                    <div class="overlay-box">
                                        <div class="overlay-inner">
                                            <div class="content">
                                                <a href="{{ $settings['funtoos_image_1_url'] }}" data-fancybox="news-images"
                                                    data-caption="" class="icon flaticon-gallery"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="lower-content">
                                    <div class="category"> {!! $settings['funtoos_promise_btn_text_1'] !!}</div>
                                    <h6><a href="">{!! $settings['funtoos_promise_btn_bellow_text_1'] !!}</a></h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Middle Column -->
                <div class="middle-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <!-- Recipe Block Three -->
                        <div class="recipe-block-three">
                            <div class="inner-box">
                                <div class="lower-content">
                                    {!! $settings['funtoos_promise'] !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="right-column col-lg-3 col-md-6 col-sm-12">
                    <div class="inner-column">

                        <!-- Recipe Block Three / Style Two -->
                        <div class="recipe-block-three style-two">
                            <div class="inner-box">
                                <div class="image">
                                    <img src="{{ $settings['funtoos_image_2_url'] }}" alt="">
                                    <!-- Overlay Box -->
                                    <div class="overlay-box">
                                        <div class="overlay-inner">
                                            <div class="content">
                                                <a href="{{ $settings['funtoos_image_2_url'] }}" data-fancybox="news-images"
                                                    data-caption="" class="icon flaticon-gallery"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="lower-content">
                                    <div class="category"> {!! $settings['funtoos_promise_btn_text_2'] !!}</div>
                                    <h6><a href="">{!! $settings['funtoos_promise_btn_bellow_text_2'] !!}</a></h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection