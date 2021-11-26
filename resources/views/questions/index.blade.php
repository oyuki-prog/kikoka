<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('質問一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-screen-xl mx-auto sm:px-6 lg:px-8">
            <x-flash :message="session('message')" />
            <x-errors :errors="$errors" />
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 pb-12">
                @foreach ($questions as $question)
                    <div class="mt-12">
                        <div class="h-8 flex items-center justify-between sm:justify-start mb-3">
                            <div class="flex items-center">
                                <img src="{{ $question->user->profile_photo_url }}" alt=""
                                    class="h-8 w-8 rounded-full block mr-2">
                                <div class="h-8">
                                    <p class="block text-sm">{{ $question->user->name }}<span
                                            class="text-xs text-gray-500 hidden">さんの質問</span></p>
                                    <p class="block text-xs text-gray-500">{{ $question->elapsed }}</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between h-8 sm:ml-4">
                                <div class="h-4 flex items-center">
                                    <img src="{{ Storage::url('/default_image/coin.png') }}" alt=""
                                        class="w-full h-full object-contain block mr-1">
                                    <p class="block text-sm">{{ $question->reward_coin }}</p>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('questions.show', $question) }}"
                            class="text-sm font-bold">{{ $question->title }}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <a href="{{ route('questions.create') }}"
        class="fixed bottom-8 right-8 bg-green-400 h-12 w-12 rounded-full text-white flex items-center justify-center opacity-80 sm:hidden">
        <p class="block font-extrabold ">？</p>
    </a>
</x-app-layout>
