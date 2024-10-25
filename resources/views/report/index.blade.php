<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="">
<title>コメント一覧画面</title>
</head>
<body>
<x-userlist-layout>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-20">
                <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">不適切コメント一覧</h1>
            </div>
            <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                <table class="table-auto w-full text-left whitespace-no-wrap">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">コメント内容</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">報告された理由</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">報告者</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">信頼度</th>
                            <th class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                        </tr>
                    </thead>
                    @foreach($comments as $comment)
                        <tbody>
                            <tr>
                                @foreach ($comment->reports as $report)
                                    @if($report->reason->description)
                                        <td class="px-4 py-3 border-t-2 border-gray-200">{{ $comment->content }}</td>
                                    @endif
                                    <td class="px-4 py-3 border-t-2 border-gray-200">{{ $report->reason->description }}</td>
                                    <td class="px-4 py-3 border-t-2 border-gray-200">{{ $report->reportedBy->username }}</td>
                                    @php
                                        $score = $report->comment->upvoteCount() - $report->comment->downvoteCount();
                                    @endphp
                                    <td class="px-4 py-3 text-lg text-gray-900 border-t-2 border-gray-200">{{ $score }}</td>
                                    <td class="text-center border-t-2 border-gray-200">
                                        <form id="delete-form" action="{{ route('report.destroy', ['id' => $report->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn delete-link text-red-700" onclick="confirmDelete()">削除</button>
                                        </form>
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </section>
</x-userlist-layout>

    <script>
        function confirmDelete() {
            if (confirm("本当に削除しますか？")) {
                // ユーザーが「はい」を選択した場合
                // フォームを送信
                document.getElementById("delete-form").submit();
            }
        }
    </script>
</body>
</html>