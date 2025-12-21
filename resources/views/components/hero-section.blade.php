<section class="page-title"
    style="background-image: url('{{ $banner->image_url }}')">
    <div class="pattern-layer"
        style="background-image: url({{ asset('assets/frontend/images/background/pattern-7.png') }})"></div>
    <div class="auto-container">
        <h2>{{ $banner->title }}</h2>
        <ul class="page-breadcrumb">
            <li><a href="{{ url('/') }}">home</a></li>
            <li>{{ $banner->title }}</li>
        </ul>
    </div>
</section>