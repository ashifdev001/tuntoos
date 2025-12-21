<section class="why-choose-us bg-gray-light">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="sm-heading">
                        <h4>Our Features </h4>
                    </div>
                    <h1>{{ $whyChooseUs['whychooseus_heading'] }}</h1>
                </div>
                <div class="col-md-8 col-sm-8 col-xs-12 padd-left-30">
                    <p>
                        {{ $whyChooseUs['whychooseus_description'] }}
                    </p>
                </div>
            </div>
            <div class="featured-area">
                <x-satisfaction-guaranteed />
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="video-bx">
                        <div class="video-image-box">
                            <figure class="image"><img src="{{asset('/assets/frontend')}}/img/video-business.jpg" alt=""><a
                                    href="{{ $whyChooseUs['testimonials_video_link'] }}"
                                    class="video-fancybox overlay-link lightbox-image">
                                    <div class="icon-border">
                                        <span class=" fa fa-play"></span>
                                    </div>
                                </a>
                            </figure>
                        </div>
                    </div><!-- /video -->

                    <div class="offer">
                        <h1> {{ $whyChooseUs['testimonials_heading'] }}</h1>
                        <p>
                            {{ $whyChooseUs['testimonials_description'] }}
                        </p>
                        <a href="#" class="theme-btn btn-lg openPopup">Connect With Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>