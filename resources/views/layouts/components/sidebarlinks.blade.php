<a class="flex items-center gap-3 px-4 py-2 rounded-md text-lg font-medium hover:bg-white/5 transition duration-300 capitalize {{ Request::is($href) ? 'bg-white/5' : '' }}"
    href="/{{ $href }}">
    <ion-icon style="width: 20px;height: 20px;" name="{{ $icon_name }}"></ion-icon>
    {{ $name }}
</a>
