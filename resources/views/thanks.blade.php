<x-app-layout>
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('css/accordion.css') }}">
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ありがとう') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-screen-xl mx-auto sm:px-6 lg:px-8">
            <x-errors :errors="$errors" />
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-8 px-4">
                <p>いつもたくさんの人の質問に答えてくれてありがとう</p>
                <p>ギフトカードはお礼の証！</p>
                <p>お待ちかねの岐阜とカードだよ</p>

                <div class="h-80 flex items-center w-full">
                    <img src="https://gifu.visit-town.com/assets/img/top/map_off.jpg" alt="" class="h-full object-contain">
                    <p class="mx-4 block">&</p>
                    <img src="https://m.media-amazon.com/images/I/41x4nLWsoUL._AC_.jpg" alt="" class="h-full object-contain">
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
