<!-- Fluid Section Two -->
<section class="fluid-section-two">
    <div class="section-text">Fantoos</div>
    <div class="outer-container clearfix">

        <!-- Content Column -->
        <div class="content-column">
            <div class="inner-column">
                <!-- Title Box -->
                <div class="title-box">
                    <h2>{{ $homeSection['rf_heading'] }}</h2>
                    <div class="text">{{ $homeSection['rf_description'] }}</div>
                </div>
                <ul class="book-list">
                    <li><img src="{{ $homeSection['rf_image_1_url'] }}" alt=""></li>
                    <li><img src="{{ $homeSection['rf_image_2_url'] }}" alt=""></li>
                    <li><img src="{{ $homeSection['rf_image_3_url'] }}" alt=""></li>
                </ul>
                <!-- Button Box -->
                <div class="button-box">
                    <a href="javascript:void(0)" class="theme-btn btn-style-two clearfix open-popup" data-attr="general-enq"><span class="icon"></span>Get Connect</a>
                </div>
            </div>
        </div>

        <!-- Image Column -->
        <div class="image-column"
            style="background-image:url({{ $homeSection['rf_site_image_url'] }})">
            <figure class="image-box"><img src="{{ $homeSection['rf_site_image_url'] }}" alt="">
            </figure>
        </div>

    </div>
</section>
<!-- End Fluid Section Two -->
<!-- Deal Section -->
<section class="deal-section"
    style="background-image: url({{ $homeSection['dp_image_url'] }})">
    <div class="top-pattern-layer"
        style="background-image: url({{ asset('assets/frontend/images/background/pattern-1.png') }})"></div>
    <div class="bottom-pattern-layer"
        style="background-image: url({{ asset('assets/frontend/images/background/pattern-2.png') }})"></div>
    <div class="auto-container">
        <div class="content-box" style="background-image: url({{ asset('assets/frontend/images/resource/deal.png') }})">
            <div class="box-inner">
                <!-- Sec Title -->
                <div class="sec-title light centered">
                    <div class="title">{{ $homeSection['dp_offer'] }}</div>
                    <h2>{{ $homeSection['dp_title'] }}</h2>
                    <div class="text">{{ $homeSection['dp_description'] }}</div>
                </div>
                <!-- Email Form -->
                <div class="email-form">
                    <div class="email-title">{{ $homeSection['dp_get_in_text'] }}</div>
                    <form method="post" action="#" id="hero-news-latter">
                        <div class="form-group">
                            <input type="email" name="email" value="" placeholder="type your email" required="">
                            <input type="hidden" name="enq_for" value="Deal Section Demand Product">
                            <button type="submit" class="submit-btn"><span class="icon flaticon-send"></span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Deal Section -->
<!-- Video Section Two -->
<section class="video-section-two">
    <!-- Video Box -->
    <div class="video-box">
        <figure class="video-image">
            <img src="{{ $homeSection['vd_image_url'] }}" alt="">
        </figure>
        <a href="{{ $homeSection['vd_video_url'] }}" class="lightbox-image overlay-box"><span
                class="flaticon-play-arrow"><i class="ripple"></i></span></a>
    </div>
</section>