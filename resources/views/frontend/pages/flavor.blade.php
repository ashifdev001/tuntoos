@extends('frontend.layout')
@section('page_name')
    flavor
@endsection

@section('title')
    {{ env('APP_NAME') }}
@endsection
@section('content')
    <x-hero-section page="flavor" />
    <section class="news-section-three">
        <div class="auto-container">
            <div class="row clearfix">
                @forelse ($flavors as $flavor)
                    <div class="recipe-block-three col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="image">
                                <img src="{{ $flavor->image_url }}" alt="">
                                <div class="overlay-box">
                                    <div class="overlay-inner">
                                        <div class="content">
                                            <a href="{{ $flavor->image_url }}" data-fancybox="news-section" data-caption=""
                                                class="icon flaticon-gallery"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="lower-content">
                                <h6><a href="">{{ $flavor->title }}</a></h6>
                            </div>
                        </div>
                    </div>
                @empty

                @endforelse
            </div>
            @if ($flavors->hasPages())
                <div class="pagination-bx m-b30">
                    {{ $flavors->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </div>
    </section>
    <!-- End our Flavor Section -->
@endsection