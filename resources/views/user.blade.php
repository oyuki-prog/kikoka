<x-app-layout>
    <div class="py-12">
        <div class="max-w-screen-xl mx-auto sm:px-6 lg:px-8">
            <x-errors :errors="$errors" />
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-8 px-4 sm:px-8">
                <div class="sm:flex">
                    <div>
                        <div class="h-20 w-20 mx-auto mb-4">
                            <img src="{{ $user->profile_photo_url }}" alt="" class="block h-full w-full rounded-full">
                        </div>
                        <p class="block text-center mb-4 text-xl font-extrabold">{{ $user->name }}</p>
                    </div>
                    <div class="sm:flex-1 sm:ml-8">
                        <p class="text-base block mb-2 sm:hidden">自己紹介</p>
                        <p class="block text-sm">{!! nl2br(e($user->introduce)) !!}</p>
                    </div>
                </div>
                @if ($questions->count() != 0)
                    <hr class="mt-8">
                    <p class="block my-8">{{ $user->name }}さんの質問</p>
                    @foreach ($questions as $question)
                        <div class="relative">
                            <a href="{{ route('questions.show', $question) }}"
                                class="block mb-8 border-4 border-gray-400 rounded px-4 pt-10 pb-4">{{ $question->title }}</a>
                            <div class="absolute top-0 left-0 w-20 h-8 border-4 border-gray-400 rounded @if ($question->open == true) bg-green-300 @else bg-gray-300 @endif text-center align-middle">
                                @if ($question->open == true)
                                <p>募集中</p>
                                @else
                                <p>募集終了</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
</x-app-layout>
