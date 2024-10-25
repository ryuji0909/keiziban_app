<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="">
<title>ユーザー一覧画面</title>
</head>
<body>
    <x-userlist-layout>
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-col text-center w-full mb-20">
                    <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">ユーザー一覧</h1>
                </div>
                <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                    <table class="table-auto w-full text-left whitespace-no-wrap">
                        <thead>
                            <tr>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">ユーザー名</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">メールアドレス</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">アカウント作成日</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">最終ログイン日</th>
                                <th class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                            </tr>
                        </thead>
                        @foreach($users as $user)
                        <tbody>
                            <tr>
                                <td class="px-4 py-3 border-t-2 border-gray-200">{{ $user->username}}</td>
                                <td class="px-4 py-3 border-t-2 border-gray-200">{{ $user->email}}</td>
                                <td class="px-4 py-3 border-t-2 border-gray-200">{{ $user->created_at}}</td>
                                <td class="px-4 py-3 text-lg text-gray-900 border-t-2 border-gray-200">{{ $user->last_login}}</td>
                                <td class="w-10 text-center border-t-2 border-gray-200">
                                    <form id="delete-form" action="{{ route('userlist.destroy', ['id' => $user->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn delete-link text-red-700" onclick="confirmDelete()">削除</button>
                                    </form>
                                </td>
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