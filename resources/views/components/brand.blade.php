<section class="clients-section">
    <div class="auto-container">
        <div class="sec-title centered">
            <!-- <div class="title">Best for You</div> -->
            <h2>Our Clients</h2>
            <div class="separate"></div>
        </div>
        <div class="inner-container">
            <div class="sponsors-outer">

                <ul class="sponsors-carousel owl-carousel owl-theme">
                    @forelse ($brands as $brand)
                        <li class="slide-item">
                            <figure class="image-box"><a href="#"><img
                                        src="{{ $brand->image_url }}" alt="{{ $brand->name }}"></a>
                            </figure>
                        </li>
                    @empty
                        <p>No client available.</p>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</section>