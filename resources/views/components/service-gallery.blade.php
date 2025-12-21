@if (!empty($services->toArray()))
    <div class="section-full rec-blog bg-white content-inner">
        <div class="container">
            <div class="section-head text-center ">
                <h2 class="text-uppercase font-30">Our Services</h2>
                <div class="separator bg-primary"></div>
                <p>Our {{ $category?->title }} Solutions Cover</p>
            </div>
            <div class="section-content ">
                <div class="blog-carousel owl-carousel owl-btn-center-lr">
                    @forelse ($services as $service)
                        <div class="item">
                            <div class="box">
                                <div class="media">
                                    <a href="{{ route('service-detail', $service->slug) }}"><img src="{{ $service->image_url }}"
                                            alt="{{ $service->name }}" /></a>
                                </div>
                                <div class="info p-tb20">
                                    <h4 class="title m-t0"><a target="_blank"
                                            href="{{ route('service-detail', $service->slug) }}">{{ $service->name }}</a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endif