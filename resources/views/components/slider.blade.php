<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<div class="slider_area mr_top">
  <div class="swiper mySwiper heroSlider">
    <div class="swiper-wrapper">
      @foreach ($sliderImages as $index => $slide)
        <div class="swiper-slide">
          <img src="{{ asset($slide->image_url) }}" alt="">
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
              <form method="post" action="#">
                <div class="form-group">
                  <input type="text" name="phone" value="" placeholder="Enter Your Mobile Number ..." required="">
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