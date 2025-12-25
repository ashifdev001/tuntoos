@extends('frontend.layout')
@section('page_name')
    distributor
@endsection

@section('title')
    {{ env('APP_NAME') }}
@endsection
@section('content')
    <!-- Page Title -->
    <x-hero-section page="distributor" />
    <!-- End Page Title -->
    <!-- About Section -->
    <section class="juice-section">
        <div class="section-text">Fantoos</div>
        <div class="auto-container">
            <div class="row clearfix">

                <!-- Image Column -->
                <div class="image-column col-lg-7 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="image">
                            <img src="{{ $settings['distributor_image_url'] }}" alt="">
                        </div>
                    </div>
                </div>

                <!-- Content Column -->
                <div class="content-column col-lg-5 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <!-- Sec Title -->
                        <div class="sec-title">
                            {!! $settings['distributor_description'] !!}
                        </div>
                        <a href="javascript:void(0)" class="theme-btn btn-style-two clearfix open-popup" data-attr="distributor"><span class="icon"></span>Enquire
                            Now</a>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End About -->
    <!-- More content Section -->
    <section class="milkshake-section">
        <div class="auto-container">
            {!! $settings['distributor_more_content'] !!}
        </div>
    </section>
    <!-- End More content Section -->
    <!-- End History Section -->
    <!-- Testimonial Section -->
    <x-testimonial />
    <!-- End Testimonial Section -->
@endsection