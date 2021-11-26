<x-app-layout>
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('css/accordion.css') }}">
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ギフトカードと交換') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-screen-xl mx-auto sm:px-6 lg:px-8">
            <x-errors :errors="$errors" />
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-8">
                <div class="mx-auto max-w-md flex items-center justify-between mb-8">
                    <div class="flex items-center">
                        <div class="w-4 h-4">
                            <img src="{{ Storage::url('/default_image/coin.png') }}" alt=""
                                class="w-full h-full object-contain block mr-2">
                        </div>
                        <p class="block">1000</p>
                        <p class="block ml-4">￥1000円分のギフトカード</p>
                    </div>
                    <form action="{{ route('exchange') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="coin" value="1000">
                        <input type="submit" value="交換" class="bg-blue-400 py-1 px-2 rounded">
                    </form>
                </div>
                <div class="mx-auto max-w-md flex items-center justify-between mb-8">
                    <div class="flex items-center">
                        <div class="w-4 h-4">
                            <img src="{{ Storage::url('/default_image/coin.png') }}" alt=""
                                class="w-full h-full object-contain block mr-2">
                        </div>
                        <p class="block">2000</p>
                        <p class="block ml-4">￥2000円分のギフトカード</p>
                    </div>
                    <form action="{{ route('exchange') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="coin" value="2000">
                        <input type="submit" value="交換" class="bg-blue-400 py-1 px-2 rounded">
                    </form>
                </div>
                <div class="mx-auto max-w-md flex items-center justify-between mb-8">
                    <div class="flex items-center">
                        <div class="w-4 h-4">
                            <img src="{{ Storage::url('/default_image/coin.png') }}" alt=""
                                class="w-full h-full object-contain block mr-2">
                        </div>
                        <p class="block">5000</p>
                        <p class="block ml-4">￥5000塩分のギフトカード</p>
                    </div>
                    <form action="{{ route('exchange') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="coin" value="5000">
                        <input type="submit" value="交換" class="bg-blue-400 py-1 px-2 rounded">
                    </form>
                </div>
                <div class="mx-auto max-w-md flex items-center justify-between mb-8">
                    <div class="flex items-center">
                        <div class="w-4 h-4">
                            <img src="{{ Storage::url('/default_image/coin.png') }}" alt=""
                                class="w-full h-full object-contain block mr-2">
                        </div>
                        <p class="block">10000</p>
                        <p class="block ml-4">￥10000円分のギフトカード</p>
                    </div>
                    <form action="{{ route('exchange') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="coin" value="10000">
                        <input type="submit" value="交換" class="bg-blue-400 py-1 px-2 rounded">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
