<x-app-layout>
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('css/accordion.css') }}">
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('コインを購入') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-screen-xl mx-auto sm:px-6 lg:px-8">
            <x-errors :errors="$errors" />
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex items-center">
                    <div class="w-4 h-4">
                        <img src="{{ Storage::url('/default_image/coin.png') }}" alt=""
                            class="w-full h-full object-contain block mr-2">
                    </div>
                    <p>100</p>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
