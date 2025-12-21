<div class="row clearfix">
    @foreach($flavors as $flavor)
        <div class="beverage-block col-xl-3 col-lg-4 col-md-6 col-sm-12">
            <div class="inner-box">
                <div class="image">
                    <a href="javascript:void(0)">
                        <img src="{{ $flavor->image_url ?? asset('assets/frontend/images/flavor/f1.jpg') }}"
                            alt="{{ $flavor->title }}">
                    </a>
                </div>
                <div class="lower-content">
                    <h6><a href="javascript:void(0)">{{ $flavor->title }}</a></h6>
                    <div class="products">{{ \Illuminate\Support\Str::limit($flavor->description, 60) }}</div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@if ($showPagination == true && $flavors->hasPages())
    <div class="pagination-bx m-b30">
        {{ $flavors->links('pagination::bootstrap-4') }}
    </div>
@endif