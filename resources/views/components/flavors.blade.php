<section class="gallery-section">
    <div class="outer-container">
        <div class="sec-title centered">
            <h2>Our Flavors</h2>
            <div class="separate"></div>
            <div class="text"></div>
        </div>
        <div class="gallery-carousel owl-carousel owl-theme">
            @forelse ($flavors as $flavor)
                <div class="gallery-block">
                    <div class="inner-box">
                        <figure class="image-box">
                            <img src="{{  $flavor->image_url }}" alt="">
                            <!-- Overlay Box -->
                            <div class="overlay-box">
                                <div class="overlay-inner">
                                    <div class="content">
                                        <a href="{{  $flavor->image_url }}" data-fancybox="gallery" data-caption=""
                                            class="icon flaticon-plus flavor_link"></a>
                                        <div class="lower-content flavor-title">
                                            <h3 class="flavor-title">{{ $flavor->title }}</h3>
                                            <div class="products">
                                                {{ \Illuminate\Support\Str::limit($flavor->description, 60) }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </figure>
                        <!--<h3 class="flavor-title">Green Apple</h3>-->
                    </div>
                </div>
            @empty
                <div class="alert alert-info">No Image Available</div>
            @endforelse
        </div>
    </div>
</section>