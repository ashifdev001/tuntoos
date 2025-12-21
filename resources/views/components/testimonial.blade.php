<section class="testimonial-section">
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title centered">
            <h2>What Clent Say</h2>
            <div class="separate"></div>
        </div>
        <div class="inner-container">
            <div class="single-item-carousel owl-carousel owl-theme">

                <!-- Testimonial Block -->
                @forelse ($testimonials as $item)
                    <div class="testimonial-block">
                        <div class="inner-box">
                            <div class="author-image">
                                <img src="{{ $item->image_url }}" alt="">
                            </div>
                            <div class="text">{{ $item->message }}</div>
                            <div class="designation">{{ $item->name }}<span>- {{ $item->location }}</span></div>
                        </div>
                    </div>
                @empty
                    <p>No testimonials available.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>