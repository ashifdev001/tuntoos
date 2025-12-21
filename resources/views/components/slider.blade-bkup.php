<section class="slider_area mr_top">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="owl-carousel">
          @forelse ($sliderImages as $item)
            <div class="item">
              <div class="slide">
                <img src="{{ $item->image_url }}" alt="">
                <div class="slide-overlay"></div>
              </div>
              <div class="container">
                <div class="carousel-captions caption-align-center">
                  <div class="caption-align-center-wrap">
                    @if ($item->title)
                      <span class="small-heading">{{ $item->title }}</span>
                    @endif
                    <h2 class="heading color">{!! $item->subtitle !!}</h2>
                    @if ($item->btn_txt)
                      <a href="{{  $item->link ?? '#' }}" class="btn btn-outline  lighter"> {{ $item->btn_txt }}</a>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          @empty
            <p>No slider images available.</p>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</section>