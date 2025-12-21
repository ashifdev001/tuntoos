<ul class="mfp-gallery">
    @forelse ($small_galleries as $gallery)
         <li>
        <a class="img-overlay1 img-effect mfp-link" title="{{$gallery->title}}"
            href="{{ $gallery->image_url }}"><img
                src="{{ $gallery->image_url }}" alt="">
        </a>
    </li>
    @empty
    @endforelse
</ul>