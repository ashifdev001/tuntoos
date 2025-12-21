@extends('frontend.layout')

@section('page_name')
    videos
@endsection

@section('title')
    {{ env('APP_NAME') }} - Videos
@endsection

@section('content')
    <!-- Page Banner Start -->
    <x-hero-section page="video" />
    <!-- Page Banner End -->

    <!-- Videos Section Start -->
    <div class="videos-section ptb-100">
        <div class="container my-5">
            <div class="row">

                @forelse ($videos as $video)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="video-box">

                            {{-- Thumbnail --}}
                            <figure class="video-image">
                                <img src="{{ $video->thumbnail_full_url }}" alt="{{ $video->title }}">
                            </figure>

                            {{-- YOUTUBE / EXTERNAL VIDEO --}}
                            @if($video->video_type === 'url')
                                <a href="{{ $video->video_full_url }}" class="lightbox-image overlay-box" data-fancybox="videos">
                                    <span class="flaticon-play-arrow">
                                        <i class="ripple"></i>
                                    </span>
                                </a>

                                {{-- LOCAL UPLOADED VIDEO --}}
                            @else
                                <a href="#video-{{ $video->id }}" class="overlay-box" data-fancybox>
                                    <span class="flaticon-play-arrow">
                                        <i class="ripple"></i>
                                    </span>
                                </a>

                                {{-- Hidden video popup --}}
                                <div style="display:none;" id="video-{{ $video->id }}">
                                    <video controls playsinline preload="metadata" style="width:100%;">
                                        <source src="{{ $video->video_full_url }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            @endif

                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>No videos available</p>
                    </div>
                @endforelse

            </div>
            @if ($videos->hasPages())
                <div class="pagination-bx m-b30">
                    {{ $videos->links('pagination::bootstrap-4') }}
                </div>
            @endif

        </div>
    </div>

    <!-- Videos Section End -->
@endsection