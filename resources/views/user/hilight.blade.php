<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="">
<title>ハイライト一覧</title>
</head>
<body>
    <x-header-layout>
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-col text-center w-full mb-20">
                    <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">ハイライト一覧</h1>
                </div>
                <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                    <table class="table-auto w-full text-left whitespace-no-wrap">
                        <thead>
                            <tr>
                                <th class="px-4 py-3  title-font tracking-wider font-bold text-gray-900 text-lg bg-gray-100 rounded-tl rounded-bl">タイトル</th>
                                <th class="px-4 py-3  title-font tracking-wider font-bold text-gray-900 text-lg bg-gray-100">投稿内容</th>
                                <th class="px-4 py-3  title-font tracking-wider font-bold text-gray-900 text-lg bg-gray-100">投稿者</th>
                                <th class="px-4 py-3  title-font tracking-wider font-bold text-gray-900 text-lg bg-gray-100">投稿日</th>
                            </tr>
                        </thead>
                        @foreach ($highlights as $highlight)
                        @if ($highlight->topic)
                            <tbody>
                                <tr>
                                    <td class="px-4 py-3 border-t-2 border-gray-200">{{ $highlight->topic->title }}</td>
                                    <td class="px-4 py-3 border-t-2 border-gray-200">{{ $highlight->topic->content }}</td>
                                    <td class="px-4 py-3 border-t-2 border-gray-200">{{ $highlight->topic->user->username }}</td>
                                    <td class="px-4 py-3 border-t-2 border-gray-200">{{ $highlight->topic->created_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                            </tbody>
                        @endif
                        @endforeach
                    </table>
                </div>
            </div>
        </section>
    </x-header-layout>
</body>
</html>