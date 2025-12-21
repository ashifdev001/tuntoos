<section class="achivement">
    <div class="container">
        <div class="row">
            @forelse ($achuevements as $k=>$item)
                <div class="col-md-4 col-sm-4">
                    <div class="block">
                        <div class="icon">
                            <img src="{{asset('/assets/frontend')}}/img/resource/achiv{{ $k+1 }}.png" alt="">
                        </div>
                        <div class="cnt-bx">
                            <h1>{{ $item->countTxt }}</h1>
                            <p>{{ $item->title }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p>No achievements available.</p>
            @endforelse
        </div>
    </div>
</section>