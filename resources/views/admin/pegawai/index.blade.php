@extends('admin.layouts.main')
@section('admin_content')
    <button id="tambah-pegawai"
        class="px-4 py-2 rounded-md text-white bg-green-400 hover:bg-green-500 active:bg-green-400 transition duration-300">Tambah
        Pegawai</button>
    <div class="rounded-md shadow-md bg-white">
        <div class="max-w-full mx-auto">
            <div class="flex flex-col">
                <div class="overflow-x-auto">
                    <div class="py-2 inline-block min-w-full">
                        <div class="overflow-hidden">
                            <table class="min-w-full">
                                <thead class="bg-white border-b">
                                    <tr>
                                        <th scope="col" class="text-sm font-medium text-gray-700 px-6 py-4 text-left">
                                            #
                                        </th>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-700 px-6 py-4 text-left capitalize">
                                            name
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
                                            salary
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($pegawai->count() < 1)
                                        <tr
                                            class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100 font-medium">
                                            <td colspan="8"
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-400 text-center">
                                                Tidak ada data di temukan
                                            </td>
                                        </tr>
                                    @endif
                                    @foreach ($pegawai as $item)
                                        <tr
                                            class="article-hover bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100 font-medium">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                {{ $loop->index + 1 }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                                                <a href="/admin/pegawai/{{ $item->id }}">
                                                    {{ $item->user->name }}</a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                                                {{ $item->jam_masuk }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize">
                                                {{ $item->jam_keluar }}
                                            </td>
                                            <td class="px-6 py-4 w-1/3 whitespace-nowrap text-sm text-gray-500">
                                                Rp. {{ number_format($item->gaji, 0, ',', '.') }}
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
    <div id="modal-tambah-pegawai" style="display: none">
        <div class="fixed inset-0 bg-black/40 z-[99]">
        </div>
        <div class="fixed inset-0 m-auto max-w-2xl h-fit z-[100]">
            <div class="px-4 py-4 rounded-md bg-white">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-slate-700">Tambah Pegawai</h3>
                    <button id="close-tambah-pegawai-modal">
                        <ion-icon style="width: 28px;height: 28px;" name="close-outline"></ion-icon>
                    </button>
                </div>
                <form class="mt-8" action="/{{ Request::path() }}" method="POST">
                    @csrf
                    <div class="flex flex-col space-y-4">
                        <div class="flex flex-col space-y-1">
                            <label class="font-medium capitalize text-slate-600" for="name">name</label>
                            <input class="px-4 py-2 rounded-md focus:outline-none border" type="text" name="name"
                                id="name">
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label class="font-medium capitalize text-slate-600" for="email">email</label>
                            <input class="px-4 py-2 rounded-md focus:outline-none border" type="email" name="email"
                                id="email">
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label class="font-medium capitalize text-slate-600" for="password">password</label>
                            <input class="px-4 py-2 rounded-md focus:outline-none border" type="password" name="password"
                                id="password">
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label class="font-medium capitalize text-slate-600" for="jam-masuk">jam masuk</label>
                            <input class="px-4 py-2 rounded-md focus:outline-none border" type="time" name="jam_masuk"
                                id="jam-masuk">
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label class="font-medium capitalize text-slate-600" for="jam-keluar">jam keluar</label>
                            <input class="px-4 py-2 rounded-md focus:outline-none border" type="time" name="jam_keluar"
                                id="jam-keluar">
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label class="font-medium capitalize text-slate-600" for="gaji">Gaji</label>
                            <input class="px-4 py-2 rounded-md focus:outline-none border" type="number" name="gaji"
                                id="gaji">
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label class="font-medium capitalize text-slate-600" for="denda">Denda Telat</label>
                            <input class="px-4 py-2 rounded-md focus:outline-none border" type="number" name="denda"
                                id="denda">
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
