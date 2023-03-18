<div class="fixed inset-y-0 w-72 bg-slate-800">
    <div class="flex flex-col">
        <div class="border-b border-slate-600">
            <a class="block px-4 py-4" href="{{ $sidebar_url }}">
                <h2 class="text-2xl font-bold text-white">{!! $title !!}
                </h2>
            </a>
        </div>
        <ul class="my-4 text-slate-200">
            @foreach ($items as $item)
                @if ($item['type'] == 'links')
                    <li>
                        @component('layouts.components.sidebarlinks', [
                            'name' => $item['name'],
                            'href' => $item['href'],
                            'icon_name' => $item['icon_name'],
                        ])
                        @endcomponent
                    </li>
                @endif
                @if ($item['type'] == 'dropdown')
                    <li>
                        @component('layouts.components.sidebardropdown', [
                            'name' => $item['name'],
                            'icon_name' => $item['icon_name'],
                            'items' => $item['items'],
                        ])
                        @endcomponent
                    </li>
                @endif
            @endforeach
            <li>

            </li>
        </ul>
    </div>
</div>
