@extends('layouts.main')
@section('content')
    {{-- sidebar --}}
    @component('layouts.components.sidebar', [
        'title' => 'Payroll <span class="font-normal text-slate-300">Dashboard</span>',
        'sidebar_url' => '/pegawai',
        'items' => [['type' => 'links', 'name' => 'dashboard', 'icon_name' => 'home', 'href' => 'pegawai']],
    ])
    @endcomponent
    <div class="ml-72">
        <div class="flex items-center justify-between px-4 py-4">
            <h3 class="text-2xl font-bold text-slate-800">{{ $title }}</h3>
            <div class="flex items-center gap-8">
                <button>
                    <ion-icon class="text-slate-600" style="width: 28px;height: 28px;" name="notifications-outline"></ion-icon>
                </button>
                <form method="POST" action="/auth/logout">
                    @csrf
                    <button type="submit">
                        <ion-icon class="text-slate-600" style="width: 28px;height: 28px;" name="log-out-outline">
                        </ion-icon>
                    </button>
                </form>
            </div>
        </div>
        <div class="px-4 py-4">
            @yield('pegawai_content')
        </div>
    </div>
@endsection
