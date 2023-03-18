@extends('admin.layouts.main')
@section('admin_content')
    <div class="flex justify-end">
        <div class="flex items-center gap-4">
            <button id="edit-pegawai" class="px-2 py-1 rounded-md capitalize bg-blue-500 text-white text-sm">edit</button>
            <a href="/{{ Request::path() }}/delete"
                class="px-2 py-1 rounded-md capitalize bg-red-500 text-white text-sm">hapus</a>
        </div>
    </div>
    <div class="border shadow-md px-4 py-4 mt-8">
        @component('layouts.components.detailcard', [
            'items' => [
                ['key' => 'nama', 'value' => ': ' . $pegawai->user->name],
                ['key' => 'Jam Masuk', 'value' => ': ' . $pegawai->jam_masuk . ' WIB'],
                ['key' => 'Jam Keluar', 'value' => ': ' . $pegawai->jam_keluar . ' WIB'],
                ['key' => 'gaji', 'value' => ': Rp.  ' . number_format($pegawai->gaji, 0, ',', '.')],
                ['key' => 'denda telat', 'value' => ': Rp.  ' . number_format($pegawai->denda, 0, ',', '.')],
            ],
        ])
        @endcomponent
    </div>
    <div class="grid grid-cols-4 gap-4 mt-8">
        <div class="px-4 py-4 rounded-md bg-green-500 border text-white">
            <p>Total Hadir : {{ $laporan['total_hadir'] }}</p>
        </div>
        <div class="px-4 py-4 rounded-md bg-yellow-500 border text-white">
            <p>Total Telat : {{ $laporan['total_telat'] }}</p>
        </div>
        <div class="px-4 py-4 rounded-md bg-blue-500 border text-white">
            <p>Total Gaji : Rp. {{ number_format($laporan['total_hadir'] * ($pegawai->gaji / date('t')), 0, ',', '.') }}</p>
        </div>
        <div class="px-4 py-4 rounded-md bg-red-500 border text-white">
            <p>Total Denda : Rp. {{ number_format($laporan['total_telat'] * $pegawai->denda, 0, ',', '.') }}</p>
        </div>
    </div>
    <div class="space-y-4 mt-8">
        <p class="text-xl font-bold text-slate-700">Laporan Absensi</p>
        <div class="rounded-md shadow-md bg-white">
            <div class="max-w-full mx-auto">
                <div class="flex flex-col">
                    <div class="overflow-x-auto">
                        <div class="py-2 inline-block min-w-full">
                            <div class="overflow-hidden">
                                <table class="min-w-full">
                                    <thead class="bg-white border-b">
                                        <tr>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-700 px-6 py-4 text-left">
                                                #
                                            </th>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-700 px-6 py-4 text-left capitalize">
                                                tanggal
                                            </th>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-700 px-6 py-4 text-left capitalize">
                                                jam masuk
                                            </th>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-700 px-6 py-4 text-left capitalize">
                                                jam keluar
                                            </th>
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-700 px-6 py-4 text-left capitalize">
                                                status
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($laporan['laporan'] as $item)
                                            <tr
                                                class="article-hover bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100 font-medium">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                    {{ $loop->index + 1 }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                                                    {{ $item['date'] }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                                                    {{ $item['jam_masuk'] }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                                                    {{ $item['jam_keluar'] }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    @switch($item["status"])
                                                        @case('telat')
                                                            <span
                                                                class="px-4 py-1 rounded-md bg-yellow-500 text-white text-xs capitalize">{{ $item['status'] }}</span>
                                                        @break

                                                        @case('hadir')
                                                            <span
                                                                class="px-4 py-1 rounded-md bg-green-500 text-white text-xs capitalize">{{ $item['status'] }}</span>
                                                        @break

                                                        @case('tidak hadir')
                                                            <span
                                                                class="px-4 py-1 rounded-md bg-red-500 text-white text-xs capitalize">{{ $item['status'] }}</span>
                                                        @break

                                                        @default
                                                            <span>-</span>
                                                    @endswitch
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-edit-pegawai" style="display: none">
        <div class="fixed inset-0 bg-black/40 z-[99]">
        </div>
        <div class="fixed inset-0 m-auto max-w-2xl h-fit z-[100]">
            <div class="px-4 py-4 rounded-md bg-white">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-slate-700">Edit Pegawai</h3>
                    <button id="close-edit-pegawai-modal">
                        <ion-icon style="width: 28px;height: 28px;" name="close-outline"></ion-icon>
                    </button>
                </div>
                <form class="mt-8" action="/{{ Request::path() }}/edit" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $pegawai->id }}">
                    <div class="flex flex-col space-y-4">
                        <div class="flex flex-col space-y-1">
                            <label class="font-medium capitalize text-slate-600" for="name">name</label>
                            <input class="px-4 py-2 rounded-md focus:outline-none border" type="text" name="name"
                                value="{{ $pegawai->user->name }}" id="name">
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label class="font-medium capitalize text-slate-600" for="email">email</label>
                            <input class="px-4 py-2 rounded-md focus:outline-none border" type="email" name="email"
                                value="{{ $pegawai->user->email }}" id="email" disabled>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label class="font-medium capitalize text-slate-600" for="jam-masuk">jam masuk</label>
                            <input class="px-4 py-2 rounded-md focus:outline-none border" type="time" name="jam_masuk"
                                value="{{ $pegawai->jam_masuk }}" id="jam-masuk" disabled>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label class="font-medium capitalize text-slate-600" for="jam-keluar">jam keluar</label>
                            <input class="px-4 py-2 rounded-md focus:outline-none border" type="time" name="jam_keluar"
                                value="{{ $pegawai->jam_keluar }}" id="jam-keluar" disabled>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label class="font-medium capitalize text-slate-600" for="gaji">Gaji</label>
                            <input class="px-4 py-2 rounded-md focus:outline-none border" type="number" name="gaji"
                                value="{{ $pegawai->gaji }}" id="gaji">
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label class="font-medium capitalize text-slate-600" for="denda">Denda Telat</label>
                            <input class="px-4 py-2 rounded-md focus:outline-none border" type="number" name="denda"
                                value="{{ $pegawai->denda }}" id="denda">
                        </div>
                        <div class="flex justify-end">
                            <button
                                class="px-16 py-2 rounded-md bg-green-400 hover:bg-green-500 active:bg-green-400 transition duration-300 text-white"
                                type="submit">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
