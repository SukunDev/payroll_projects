@extends('layouts.main')
@section('content')
    <div class="fixed inset-0 m-auto max-w-xl h-fit z-10">
        <div class="px-4 py-4 rounded-md bg-white">
            <form method="POST" action="/{{ Request::path() }}">
                @csrf
                <div class="flex flex-col space-y-4">
                    <div>
                        <p class="text-xl font-medium text-gray-600">{{ $title }}</p>
                        <p class="text-gray-500">Access the dashboard using your username and password.</p>
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label class="capitalize font-bold text-slate-700" for="email">email</label>
                        <input class="px-4 py-2 rounded-md border border-gray-300 focus:outline-none" type="email"
                            name="email" id="email">
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label class="capitalize font-bold text-slate-700" for="password">password</label>
                        <input class="px-4 py-2 rounded-md border border-gray-300 focus:outline-none" type="password"
                            name="password" id="password">
                    </div>
                    <div class="flex justify-center">
                        <button
                            class="px-16 py-2 rounded-md text-white bg-yellow-500 hover:bg-yellow-400 active:bg-yellow-500 transition duration-300 uppercase font-bold"
                            type="submit">Sign
                            In</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="fixed inset-0 bg-gray-900 z-0">
    </div>
@endsection
