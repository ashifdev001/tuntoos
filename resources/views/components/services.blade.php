<div class="row service_item_inner">
    @forelse ($serviceslist as $service)
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="service_box_item">
                <a href="{{ route('service-detail', [$service['category_slug'],$service['slug']]) }}" class="service_image">
                    <img src="{{ $service['image_url'] }}" alt="">
                </a>
                <div class="service_text">
                    <a href="{{ route('service-detail', [$service['category_slug'],$service['slug']]) }}">
                        <h4>{{ $service['name'] }}</h4>
                    </a>
                    <p>{{ $service['description'] ?? '' }}</p>
                    <a href="{{ route('service-detail', [$service['category_slug'],$service['slug']]) }}" class="theme-btn btn-lg">Read More</a>
                </div>
            </div>
        </div>
    @empty

    @endforelse
</div>

@if ($serviceslist->hasPages())
    <div class="pagination-bx m-b30">
        {{ $serviceslist->links('pagination::bootstrap-4') }}
    </div>
@endif