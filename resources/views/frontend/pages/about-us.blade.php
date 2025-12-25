@extends('frontend.layout')
@section('page_name')
    about
@endsection
@section('title')
    {{ env('APP_NAME') }} - About
@endsection
@section('content')
    <!-- Page Title -->
    <x-hero-section page="about"/>
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
                            <img src="{{ $settings['about_image_url'] }}" alt="">
                        </div>
                    </div>
                </div>

                <!-- Content Column -->
                <div class="content-column col-lg-5 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <!-- Sec Title -->
                        <div class="sec-title">
                            {!! $settings['about_description'] !!}
                        </div>
                        <a href="" class="theme-btn btn-style-two clearfix open-popup" data-attr="general-enq"><span class="icon"></span>Enquire Now</a>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End About -->
    <!-- End History Section -->
    <!-- Testimonial Section -->
    <x-testimonial/>
    <!-- End Testimonial Section -->

    <!-- Staff Section -->
    <section class="staff-section" id="team">
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title centered">
                <h2>Our Team</h2>
            </div>
            <div class="row clearfix">
                @forelse ($teams as $team)
                    <div class="staff-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="image">
                            <a href="#"><img src="{{ $team->image_url }}" alt=""></a>
                            <div class="overlay-box">
                                <div class="content">
                                    <h6><a href="#">{{ $team->name }}</a></h6>
                                    <div class="designation">{{ $team->position }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @empty
                    
                @endforelse
               
            </div>
        </div>
    </section>
    <!-- End Staff Section -->
@endsection