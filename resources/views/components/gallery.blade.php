{{-- <div class="container">
    <div class="sec_middle_title">
        <h1>Our Work Gallery</h1>
    </div>
    <ul class="post-filter list-inline">
        <li class="active" data-filter=".filter-item">
            <span>All</span>
        </li>
        @forelse ($categories as $category)
        <li data-filter=".{{ $category->slug }}">
            <span>{{ $category->title }} </span>
        </li>
        @empty
        @endforelse
    </ul>

    <div class="row masonary-layout filter-layout">
        @forelse ($galleries as $gallery)
        <div class="col-md-4 col-sm-4 col-xs-12 filter-item {{  $gallery?->category?->slug }}">
            <div class="single-item">
                <div class="img-box">
                    <img src="{{  $gallery->image_url }}" alt="Awesome Image" />
                    <div class="overlay">
                        <div class="inner">
                            <div class="social">
                                <a href="{{  $gallery->image_url }}" data-fancybox-group="example-gallery"
                                    class="view lightbox-image"><i class="flaticon-add"></i></a>
                                <h4>{{ $gallery->title }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="alert alert-info">No Image Available</div>
        @endforelse
    </div>
</div>

@if ($isGallery == true && $galleries->hasPages())
<div class="pagination-bx m-b30">
    {{ $galleries->links('pagination::bootstrap-4') }}
</div>
@endif --}}
<section class="gallery-page-section">
    <div class="outer-container">
        <div class="masonry-items-container row clearfix">

            <!-- Gallery Block Two -->
            @forelse ($galleries as $gallery)
                <div class="gallery-block-two masonry-item col-lg-3 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="image-box">
                            <img src="{{  $gallery->image_url }}" alt="">
                            <div class="overlay-box">
                                <h6><a href="#">{{ $gallery->title }}</a></h6>
                                <div class="title">{{ $gallery->description }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info">No Image Available</div>
            @endforelse
        </div>
        <div class="text-center">
            <div class="pagination-bx m-b30">
            {{ $galleries->links('pagination::bootstrap-4') }}
        </div>
        </div>
        
    </div>
</section>