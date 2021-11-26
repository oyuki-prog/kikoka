<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('質問詳細') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-screen-xl mx-auto sm:px-6 lg:px-8">
            <x-errors :errors="$errors" />
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 sm:px-8">
                <p class="block text-sm font-bold my-2">{{ $question->title }}</p>
                <div class="flex items-center justify-between mb-4 flex-wrap">
                    <div class="flex items-center h-8 flex-1">
                        <img src="{{ $question->user->profile_photo_url }}" alt="" class="w-8 block rounded-full mr-2">
                        <div>
                            <p class="text-sm block w-full">{{ $question->user->name }}</p>
                            <p class="text-xs block w-full text-gray-500">{{ $question->elapsed }}</p>
                        </div>
                    </div>
                    <div class="h-4 flex items-center mb-2">
                        <img src="https://illust8.com/wp-content/uploads/2018/11/gold-coin_illust_2205.png" alt=""
                            class="h-full object-contain block mr-2">
                        <p class="text-xs">{{ $question->reward_coin }}</p>
                    </div>
                </div>
                <p class="text-xs leading-5 block mb-4">{!! nl2br(e($question->body)) !!}</p>

                @if ($question->answers->count() != 0)
                    <hr class="mt-4">
                    <div class="flex items-center justify-between">
                        <p class="my-4 block">質問への回答</p>
                        @can('update', $question)
                            <a href="{{ route('questions.divide', $question) }}"
                                class="block py-1 px-2 bg-green-400 rounded hover:bg-green-500">分配する</a>
                        @endcan
                    </div>
                    @foreach ($answers as $answer)
                        <div class="mb-8">
                            <div class="flex items-center mb-4 flex-wrap">
                                <a href="{{ route('user.show', $answer->user) }}"
                                    class="flex items-center h-8 flex-1">
                                    <img src="{{ $answer->user->profile_photo_url }}" alt=""
                                        class="w-8 block rounded-full mr-2">
                                    <div>
                                        <p class="text-sm block w-full">{{ $answer->user->name }}</p>
                                        <p class="text-xs block w-full text-gray-500">{{ $answer->elapsed }}</p>
                                    </div>
                                </a>
                            </div>
                            <p class="text-xs leading-5">{!! nl2br(e($answer->body)) !!}</p>
                        </div>
                    @endforeach
                @endif
                @if (Auth::check() && $question->user != Auth::user() && $question->open == true && $answers->where('question_id', $question->id)->where('user_id', Auth::id())->count() == 0)
                    <form action="{{ route('questions.answers.store', $question) }}" method="POST">
                        @csrf
                        <div class="flex items-center justify-between mb-2">
                            <label for="body text-sm">回答する</label>
                            <input type="submit" value="送信"
                                class="block bg-green-400 hover:bg-green-500 rounded py-1 px-2">
                        </div>
                        <textarea name="body" id="body" class="w-full rounded border-gray-500"
                            rows="15">{{ old('body') }}</textarea>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
