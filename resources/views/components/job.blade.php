<section class="main_blog_area">
    <div class="container">
        <div class="row main_blog_inner">
            <div class="col-md-12">
                <div class="main_blog_items">
                    <div class="main_blogpost_item">
                        @forelse ($jobs as $item)
                        <div class="main_blogpost_item">
                            <div class="main_blog_text">
                                <a href="#">
                                    <h2>{{ $item->title }}</h2>
                                </a>
                                <div class="blog_author_area">
                                    <a href="#"><i class="fa fa-calendar"></i><span> {{ date('d F Y',strtotime($item->created_at)) }}</span></a>
                                </div>
                                <p>{{ $item->description }}. </p>
                                <a href="{{ route('job-application',$item->slug) }}" class="theme-btn btn-lg">Apply Now</a>
                            </div>
                            </div>
                        @empty

                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>