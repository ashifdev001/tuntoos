<section class="service_area">
    <div class="container">
        <div class="sec_middle_title">
            <h1>Our <span>Service</span></h1>
        </div>
        <div class="row">
            @forelse ($categories as $category)
                 <div class="col-md-3 col-sm-6">
                <!-- Service Block -->
                <div class="service-block">
                    <div class="inner-box">
                        <div class="icon-box">
                            <img src="{{ $category->image_url }}" alt="">
                        </div>
                        <h5><a href="{{ route('service.list',$category->slug) }}">{{ $category->title }}</a></h5>

                        <div class="link-box"><a href="{{ route('service.list',$category->slug) }}">know more</a></div>
                    </div>
                </div>

                <!-- Service Block -->
            </div>
            @empty
                
            @endforelse
           
        </div><!-- /row -->
    </div>
</section>