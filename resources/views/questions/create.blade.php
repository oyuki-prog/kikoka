<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('質問する') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-screen-xl mx-auto sm:px-6 lg:px-8">
            <x-errors :errors="$errors" />
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-4 py-12">
                    <form action="{{ route('questions.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="title">質問タイトル</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                class="w-full rounded border-gray-400">
                        </div>
                        <div class="mb-4">
                            <label for="body">質問内容</label>
                            <textarea name="body" id="body" cols="30" rows="10" required
                                class="w-full rounded border-gray-400">{{ old('body') }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="due_date">回答締め切り</label>
                            <div class="flex items-center justify-between">
                                <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}"
                                    required class="rounded border-gray-400 block w-2/5">
                                <input type="time" name="due_time" value="{{ old('due_time') }}" required
                                    class="rounded border-gray-400 block w-1/5">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="reward_coin">報酬コイン</label>
                            <input type="number" name="reward_coin" id="reward_coin" value="{{ old('reward_coin') }}"
                                required class="w-full rounded border-gray-400">
                        </div>
                        <div class="mb-4 flex items-center">
                            <label for="urgent" class="block mr-2">急募欄に掲載する</label>
                            <input type="hidden" name="urgent" value="0">
                            <input type="checkbox" name="urgent" id="urgent" value="1">
                        </div>
                        <div class="text-red-500 flex items-center mb-4">
                            <p class="block mr-4 font-extrabold">消費コイン</p>
                            <img src="https://illust8.com/wp-content/uploads/2018/11/gold-coin_illust_2205.png" alt=""
                                class="h-4 object-contain block mr-2">
                            <p id="Total" class="block font-extrabold">0</p>
                        </div>
                        <input type="submit" value="投稿" class="block bg-green-400 hover:bg-green-500 px-2 py-1 rounded">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="js">
        <script src="{{ mix('js/total.js') }}"></script>
    </x-slot>
</x-app-layout>
