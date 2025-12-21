<!-- blog grid -->
<div id="masonry" class="row blog-grid-2">
    @forelse ($cobweblist as $item)
        <div class="post card-container col-lg-4 col-md-6 col-sm-6">
            <div class="blog-post blog-grid date-style-2">
                <div class="post-media img-effect zoom-slow"> <a href="{{ route('service-detail', $item->slug) }}"><img
                            src="{{ $item->image_url}}" alt="{{ $item->name}}"></a> </div>
                <div class="post-info">
                    <div class="post-title ">
                        <h3 class="post-title"><a href="{{ route('service-detail', $item->slug) }}">{{ $item->name}}</a>
                        </h3>
                    </div>
                    <div class="post-text">
                        <p>{{ $item->description}}</p>
                    </div>
                    <div class="post-readmore"> <a href="{{ route('service-detail', $item->slug) }}" title="READ MORE" rel="bookmark" class="site-button-link">READ
                            MORE<i class="fa fa-angle-double-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p class="text-center">No services available.</p>
    @endforelse

</div>
<!-- blog grid END -->
@if ($cobweblist->hasPages())
    <div class="pagination-bx m-b30">
        {{ $cobweblist->links('pagination::bootstrap-4') }}
    </div>
@endif