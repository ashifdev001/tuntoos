@forelse ($blogs as $blog)
    <div class="widget-post clearfix">
        <div class="post-media"> <img src="{{ $blog->cover_image_url }}" width="200" height="143" alt=""> </div>
        <div class="post-info">
            <div class="post-header">
                <h6 class="post-title"><a href="{{ route('blog-detail', ['slug' => $blog->slug]) }}">{{ Str::limit($blog->title, 50) }}</a></h6>
            </div>
        </div>
    </div>
@empty

@endforelse