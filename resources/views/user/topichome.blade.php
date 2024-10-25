<!--般ユーザートップ画面-->

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="">
@vite(['resources/css/topichome.css'])
<title>一般ユーザトップ画面</title>
</head>
    <body>
        <header class="text-gray-600 body-font bg-indigo-500">
            <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
                <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
                    <span class="ml-3 text-xl">掲示板</span>
                </a>
                <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center text-white">
                    <a class="mr-5">{{ Auth::user()->username }}さん</a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="mr-5">ログアウト</a>
                    <a href="{{ route('highlight.index')}}" class="mr-5">ハイライト一覧</a>
                </nav>
            </div>
        </header>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        <section class="text-gray-600 body-font relative">
            <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-col text-center w-full mb-12">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">新規投稿</h1>
                </div>
                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                    <form action="{{ route('topic.store') }}" method="post">
                    @csrf
                    <div class="flex flex-wrap -m-2">
                        <div class="p-2 w-full">
                            <div class="relative">
                                <label for="name" class="leading-7 text-sm text-gray-600">投稿タイトル</label>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <p style="color:red">{{ $message }}</p>
                                        </span>
                                    @enderror
                                <input type="text" id="title" name="title" value="{{ old('title') }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                        <div class="p-2 w-1/2">
                    </div>
                    <div class="p-2 w-full">
                        <div class="relative">
                            <label for="message" class="leading-7 text-sm text-gray-600">投稿内容</label>
                            @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <p style="color:red">{{ $message }}</p>
                                </span>
                            @enderror
                            <textarea id="content" name="content" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ old('content') }}</textarea>
                        </div>
                    </div>
                    <div class="p-2 w-full">
                        <button class="flex mx-auto text-white bg-indigo-400 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">投稿</button>
                    </div>
                </div>
                </form>
            </div>
        </section>




        <section id="topic" class="content">
            <h1 class="topic_text">Topic</h1>
                @foreach ($topics as $topic) 
                    <div class="topiccontent">
                    <p> 
                    @if ($topic->user)
                    <span>
                        {{ $topic->user->username }}さんが作成しました。
                    @else
                    ユーザーがいません
                    @endif
                        投稿日付：{{ $topic->created_at->format('Y-m-d H:i:s') }}
                    </span>
                    </p>
                        <p>投稿タイトル：{{ $topic->title }}</p>
                        <p>投稿内容：{{ $topic->content }}</p>
                        <div class="btn">
                            <ul>
                                <li><a href="{{ route('user.commentcreate', ['id' => $topic->id])}}" class="replay">リプライ</a></li>
                                <li><a href="{{ route('topic.show', ['id' => $topic->id])}}" class="comment">コメント一覧</a></li>
                                <li>
                                    <form  action="{{ route('highlight.store', ['id' => $topic->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="hilight">ハイライト</button>
                                    </form>
                                </li>
                                <li><a href="{{ route('topic.edit', ['id' => $topic->id])}}" class="update">編集</a></li>
                                <li>
                                    <form id="delete-form" action="{{ route('user.destroy', ['id'=>$topic->id]) }}" method="POST"> <!-- 1件のデータを削除 -->
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn delete-link">削除</button>
                                    </form>
                                </li>
                                @if($topic->highlights->count() > 0)
                                <!-- 1件以上存在する場合の処理 -->
                                <li>☆</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                @endforeach
            </section>
    </div>
</main>


    <script>
        // 削除ボタンがクリックされたときの処理
        document.querySelector('.delete-link').addEventListener('click', function(event) {
            event.preventDefault(); // フォームのデフォルトの送信をキャンセル
            
            // ユーザーに確認メッセージを表示
            if (confirm('本当に削除してもよろしいですか？')) {
                // OKをクリックした場合、フォームを送信
                document.getElementById('delete-form').submit();
            }
        });

        document.addEventListener("DOMContentLoaded", function () {
            var clearButton = document.getElementById("clearButton");
            var inputText = document.getElementById("title");
            var textareaText = document.getElementById("content");
    
            clearButton.addEventListener("click", function () {
                inputText.value = ""; // inputエリアの内容をクリア
                textareaText.value = ""; // テキストエリアの内容をクリア
            });
        });
    </script>
    
    </body>
</html>