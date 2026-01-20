<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@section('styles')
  <style>
    /* Hero container */
    .hero-banner {
      position: relative;
    }

    /* Enquiry Button - perfectly centered */
    .hero-enquiry-btn {
      position: absolute;
      left: 20px;
      /* distance from left side */
      top: 50%;
      transform: translateY(-50%);
      background-color: #ff6a00;
      color: #ffffff;
      padding: 14px 30px;
      font-size: 16px;
      font-weight: 600;
      text-decoration: none;
      border-radius: 6px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
      transition: all 0.3s ease;
      z-index: 10;
    }


    /* Hover Effect */
    .hero-enquiry-btn:hover {
      background-color: #e85d00;
      transform: translate(-50%, -50%) scale(1.05);
    }

    /* Tablet */
    @media (max-width: 991px) {
      .hero-enquiry-btn {
        padding: 12px 26px;
        font-size: 15px;
      }
    }

    /* Mobile */
    @media (max-width: 575px) {
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
          <img src="{{ asset($slide->image_url) }}" alt="">
          <a href="#enquiry" class="hero-enquiry-btn open-popup" data-attr="general-enq">
            Enquiry
          </a>
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
                  <input type="text" name="phone" value="" placeholder="Enter Your Mobile Number ..." required="">
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
          <a href="{{ route('about') }}" class="theme-btn btn-style-two clearfix"><span class="icon"></span>More
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