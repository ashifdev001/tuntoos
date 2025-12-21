<section class="blog" class="pt pt-sm-80">
    <div class="container">
        <div class="sec_middle_title">
            <h1> Latest <span>Blog</span></h1>
        </div>
        <div class="row">
            @forelse ($blogs as $blog)
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="blog-main-holder">
                        <div class="single-blog-post">
                            <div class="img-holder">
                                <img src="{{$blog->cover_image_url}}" alt="img">
                            </div>
                            <div class="blog-content">
                                <a href="{{ route('blog-detail', $blog->slug) }}">
                                    <h3>{{ $blog->title }}</h3>
                                </a>

                                <p>
                                    {!! $blog->short_desc !!}
                                </p>
                                <a href="{{ route('blog-detail', $blog->slug) }}" class="theme-btn btn-lg">read more</a>
                            </div>
                        </div><!-- single blog post -->
                    </div><!-- blog-main-holder -->
                </div>
            @empty

            @endforelse
            <!-- col -->

            {{-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="blog-main-holder">
                    <div class="single-blog-post">
                        <div class="img-holder">
                            <img src="{{asset('/assets/frontend')}}/img/blog/2.jpg" alt="img">
                        </div>
                        <div class="blog-content">
                            <a href="{{ route('blog-detail', 'blog-det') }}">
                                <h3>heading of blog</h3>
                            </a>

                            <p>
                                Lorem ipsum dolor sit amet, consectetur qui officia deserunt mollit anim id est laborum.
                            </p>
                            <a href="{{ route('blog-detail', 'blog-det') }}" class="theme-btn btn-lg">read more</a>
                        </div>
                    </div><!-- single blog post -->
                </div><!-- blog-main-holder -->
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="blog-main-holder">
                    <div class="single-blog-post">
                        <div class="img-holder">
                            <img src="{{asset('/assets/frontend')}}/img/blog/3.jpg" alt="img">
                        </div>
                        <div class="blog-content">
                            <a href="{{ route('blog-detail', 'blog-det') }}">
                                <h3>heading of blog</h3>
                            </a>

                            <p>
                                Lorem ipsum dolor sit amet, consectetur qui officia deserunt mollit anim id est laborum.
                            </p>
                            <a href="{{ route('blog-detail', 'blog-det') }}" class="theme-btn btn-lg">read more</a>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</section>