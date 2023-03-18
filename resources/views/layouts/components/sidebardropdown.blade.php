<button
    class="dropdown-button flex w-full items-center justify-between gap-3 px-4 py-2 rounded-md text-lg font-medium hover:bg-white/5 transition duration-300 capitalize">
    <span class="flex items-center gap-3">
        <ion-icon style="width: 20px;height: 20px;" name="{{ $icon_name }}"></ion-icon>
        {{ $name }}
    </span>
    <ion-icon class="arrow rotate-180 transition duration-300" style="width: 20px;height: 20px;" name="chevron-up">
    </ion-icon>
</button>
<ul class="dropdown-content" style="display: none">
    @foreach ($items as $item)
        <li>
            <a class="flex items-center gap-3 px-12 py-2 rounded-md font-medium hover:bg-white/5 transition duration-300 capitalize {{ Request::is($item['href']) ? 'bg-white/5' : '' }}"
                href="/{{ $item['href'] }}">
                {{ $item['name'] }}
            </a>
        </li>
    @endforeach
</ul>
