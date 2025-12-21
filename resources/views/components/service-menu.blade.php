<ul class="sub-menu">
    @forelse ($menuItems as $item)
        <li><a href="{{ route('service.list', ['slug' => $item->slug]) }}">{{ $item->title }}</a></li>
    @empty
    @endforelse
</ul>