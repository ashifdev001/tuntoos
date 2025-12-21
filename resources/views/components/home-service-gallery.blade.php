<section class="gallery-section">
    <div class="outer-container">
        <div class="gallery-carousel owl-carousel owl-theme">
            @forelse ($galleries as $gallery)
                <div class="gallery-block">
                    <div class="inner-box">
                        <figure class="image-box">
                            <img src="{{ $gallery->image_url }}" alt="">
                            <!-- Overlay Box -->
                            <div class="overlay-box">
                                <div class="overlay-inner">
                                    <div class="content">
                                        <a href="{{ $gallery->image_url }}"
                                            data-fancybox="gallery" data-caption="" class="icon flaticon-plus"></a>
                                    </div>
                                </div>
                            </div>
                        </figure>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
</section>