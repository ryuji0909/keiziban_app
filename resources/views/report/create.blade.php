<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="">
@vite(['resources/css/reportcreate.css'])
<title>報告フォーム画面</title>
</head>
<body>
    <x-header-layout>
        <section class="text-gray-600 body-font relative">
            <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-col text-center w-full mb-12">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">報告フォーム</h1>
                </div>
                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                    <form action="{{ route('report.store')}}" method="POST">
                    @csrf
                        <div class="flex flex-wrap -m-2">
                            <div class="p-2 w-full">
                                <div class="relative">
                                    <label for="name" class="leading-7 text-sm text-gray-600">コメント内容</label>
                                    <label>:{{ $comment->content }}</label>
                                </div>
                            </div>
                            <div class="p-2 w-full">
                                <div class="relative">
                                    <label for="name" class="leading-7 text-sm text-gray-600">コメント信頼度</label>
                                    <label>:
                                        @php
                                            $score = $comment->upvoteCount() - $comment->downvoteCount();
                                        @endphp
                                        {{ $score }}</dd>
                                        <input hidden name="comment_id" value="{{$comment->id}}">
                                    </label>
                                </div>
                            </div>
                            <div class="p-2 w-full">
                                <div class="relative">
                                <label for="message" class="leading-7 text-sm text-gray-600">報告理由</label>
                                    <textarea id="description" name="description" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                                </div>
                            </div>
                            <div class="p-2 w-full">
                                <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">送信</button>
                            </div>
                            </div>
                        </div>
                    <form>
                <div>
            </div>
        </section>
    </x-header-layout>
</body>
</html>