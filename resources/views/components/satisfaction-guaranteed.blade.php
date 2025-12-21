@if (!empty($satisfactionGuaranteed))
    <div class="col-md-4 col-sm-12 col-xs-12">
        @foreach ($satisfactionGuaranteed as $item)
            <div class="fea-col">
                <div class="fea-col-img">
                    <img src="{{$item->icon_url}}" alt="" class="hidden-xs">
                    <img src="{{$item->icon_url}}" alt="" class="hidden-xl hidden-lg hidden-md">
                </div>
                <div class="fea-col-cnt">
                    <h4>{{$item->title}}</h4>
                    <p>
                        {{$item->description}}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
@endif