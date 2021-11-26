<x-app-layout>
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('css/accordion.css') }}">
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('分配する') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-screen-xl mx-auto sm:px-6 lg:px-8">
            <x-errors :errors="$errors" />
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h1>解答者一覧</h1>
                        <div class="h-4 flex items-center">
                            <img src="{{ Storage::url('/default_image/coin.png') }}" alt=""
                                class="h-full object-contain block mr-2">
                            <p class="text-sm">{{ $question->reward_coin }}</p>
                        </div>
                    </div>

                    <form action="{{ route('questions.divide', $question) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        @foreach ($answers as $answer)
                            <div class="mb-8">
                                <div class="flex items-center justify-between mb-1 flex-wrap">
                                    <div class="flex items-center h-8 flex-1">
                                        <img src="{{ $answer->user->profile_photo_url }}" alt=""
                                            class="w-8 block rounded-full mr-2">
                                        <div>
                                            <p class="text-sm block w-full">{{ $answer->user->name }}</p>
                                            <p class="text-xs block w-full text-gray-500">{{ $answer->elapsed }}</p>
                                        </div>
                                    </div>
                                    <input type="number" name="user[{{ $answer->user->id }}]"
                                        class="block w-20 border-gray-400 rounded text-right" data-group="Total">
                                </div>
                                <div>
                                    <input type="checkbox" id="acd-check{{ $answer->user->id }}"
                                        class="acd-check">
                                    <label
                                        class="acd-label bg-green-400 rounded hover:bg-green-500 text-sm inline-block w-auto mb-3 py-1 px-2"
                                        for="acd-check{{ $answer->user->id }}">回答を見る</label>
                                    <div class="acd-content w-full">
                                        <p class="text-xs">{{ $answer->body }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @can('update', $question)
                            <input type="submit" value="分配する">
                        @endcan
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
