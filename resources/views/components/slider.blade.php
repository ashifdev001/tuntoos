<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@section('styles')
    <style>
        /* Swiper slide */
        .swiper-slide {
            position: relative;
            width: 100%;
            height: 100%;
        }

        /* Slide image */
        .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* Overlay content */
        .hero-content {
            position: absolute;
            top: 50%;
            left: 60px;
            transform: translateY(-50%);
            color: #000;
            max-width: 600px;
            z-index: 5;
            padding: 50px 50px;
            border-radius: 4px;
            background-color: #ffffff;
        }

        /* Heading */
        .hero-heading {
            font-size: 30px;
            font-weight: 700;
            margin-bottom: 12px;
            line-height: 1.2;
        }

        /* Subheading */
        .hero-subheading {
            font-size: 18px;
            margin-bottom: 25px;
            opacity: 0.9;
        }

        /* CTA Button */
        .hero-enquiry-btn {
            display: inline-block;
            background-color: #ff6a00;
            color: #ffffff;
            padding: 14px 30px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 6px;
            text-decoration: none;
            box-shadow: 0 8px 25px rgba(255, 106, 0, 0.6);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        /* Hover effect */
        .hero-enquiry-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(255, 106, 0, 0.8);
        }

        /* Tablet */
        @media (max-width: 991px) {
            .hero-content {
                left: 30px;
                max-width: 500px;
            }

            .hero-heading {
                font-size: 36px;
            }

            .hero-subheading {
                font-size: 16px;
            }

            .hero-enquiry-btn {
                padding: 12px 26px;
                font-size: 15px;
            }
        }

        /* Mobile */
        @media (max-width: 575px) {
            .hero-content {
                left: 20px;
                right: 20px;
                max-width: 100%;
            }

            .hero-heading {
                font-size: 26px;
            }

            .hero-subheading {
                font-size: 14px;
            }

            .hero-enquiry-btn {
                padding: 12px 24px;
                font-size: 14px;
                border-radius: 50px;
            }
        }
    </style>
@endsection
<div class="slider_area mr_top">
    <div class="swiper mySwiper heroSlider">
        <div class="swiper-wrapper">

            @foreach ($sliderImages as $index => $slide)
                <div class="swiper-slide">

                    <!-- Background Image -->
                    <img src="{{ asset($slide->image_url) }}" alt="">

                    <!-- Overlay Content -->
                    @if (!empty($slide->title) || !empty($slide->subtitle) || !empty($slide->btn_txt))
                        <div class="hero-content content-box">
                            <h1 class="hero-heading">
                                {{ $slide->title }}
                            </h1>

                            <p class="hero-subheading">
                                {{ $slide->subtitle }}
                            </p>
                            @if (!empty($slide->btn_txt))
                                <a href="{{ empty($slide->link) ? '#' : $slide->link }}"
                                    class="hero-enquiry-btn {{ empty($slide->link) ? 'open-popup' : '' }}"
                                    data-attr="general-enq">
                                    {{ $slide->btn_txt }}
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach

        </div>
    </div>
</div>



<section class="newsletter-section">
    <div class="auto-container">
        <div class="inner-container">
            <div class="row clearfix">

                <!-- Title Column -->
                <div class="title-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="send-icon fa fa-send"></div>
                        <h4>{{ $newsLatter['heading'] }}</h4>
                        <div class="title">{{ $newsLatter['description'] }}</div>
                    </div>
                </div>

                <!-- Newsletter Column -->
                <div class="newsletter-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <!-- Newsletter Form Two -->
                        <div class="newsletter-form-two">
                            <form method="post" action="#" id="deal-news-latter">
                                <div class="form-group">
                                    <input type="text" name="phone" value=""
                                        placeholder="Enter Your Mobile Number ..." required="">
                                    <input type="hidden" name="enq_for" value="Franchise Model">
                                    <button type="submit" class="theme-btn btn-style-one clearfix"><span
                                            class="icon"></span>{{ $newsLatter['button_text'] }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<section class="juice-section">
    <div class="section-text">Fantoos</div>
    <div class="auto-container">
        <div class="row clearfix">

            <!-- Image Column -->
            <div class="image-column col-lg-7 col-md-12 col-sm-12">
                <div class="inner-column">
                    <div class="image">
                        <img src="{{ $newsLatter['about_image'] }}" alt="">
                    </div>
                </div>
            </div>

            <!-- Content Column -->
            <div class="content-column col-lg-5 col-md-12 col-sm-12">
                <div class="inner-column">
                    <!-- Sec Title -->
                    <div class="sec-title">
                        {!! $newsLatter['about_description'] !!}
                    </div>
                    <a href="{{ route('about') }}" class="theme-btn btn-style-two clearfix"><span
                            class="icon"></span>More
                        About</a>
                </div>
            </div>

        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    var swiper = new Swiper(".mySwiper", {
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
</script>
