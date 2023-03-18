@extends('pegawai.layouts.main')
@section('pegawai_content')
    <div>
        <button id="absensi-button"
            class="px-4 py-2 rounded-md bg-green-400 hover:bg-green-500 active:bg-green-400 text-white transition duration-300">Absen</button>
    </div>
    <div id="modal-absensi" style="display: none">
        <div class="fixed inset-0 bg-black/40 z-[99]">
        </div>
        <div class="fixed inset-0 m-auto max-w-2xl h-fit z-[100]">
            <div class="px-4 py-4 rounded-md bg-white">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-slate-700">Absensi</h3>
                    <button id="close-absensi-modal">
                        <ion-icon style="width: 28px;height: 28px;" name="close-outline"></ion-icon>
                    </button>
                </div>
                <form class="mt-8" action="/{{ Request::path() }}" method="POST">
                    @csrf
                    <div class="flex flex-col space-y-4">
                        <div class="flex flex-col space-y-1">
                            <label class="font-medium capitalize text-slate-600" for="tanggal">tanggal</label>
                            <input class="px-4 py-2 rounded-md focus:outline-none border" type="date" name="tanggal"
                                id="tanggal">
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
