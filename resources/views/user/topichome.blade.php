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
    <header id="header">
        <h2 class="text container">掲示板</h2>
        <nav class="container">
            <ul>
                <li>{{ Auth::user()->username }}さん</li>
                <li> <a href="{{ route('logout') }}" class="backbtn" onclick="event.preventDefault();document.getElementById('logout-form').submit();">ログアウト</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                <li><a href="{{ route('highlight.index')}}">ハイライト一覧</a></li>
            </ul>
        </nav>   
    </header>

<main>
        <form action="{{ route('topic.store') }}" method="post">
        @csrf
        <div class="container">
                <section id="newtopic" class="content">
                    <h2 class="newtopic_text">新規投稿</h2>
                    <div class="topicarea">
                        <dl class="topic_area">
                            <dd><label for="title">投稿タイトル：</label></dd>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <p style="color:red">{{ $message }}</p>
                                </span>
                            @enderror
                            <dt><input type="text" id="title" name ="title" value="{{ old('title') }}"></dl>
                            <dd><label for="content">投稿内容：</label></dd>
                            @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <p style="color:red">{{ $message }}</p>
                                </span>
                            @enderror
                            <dt><textarea id="content" name="content">{{ old('content') }}</textarea></dt>
                        </dl>
                    </div>
                    <button type="submit" class="btn">投稿</button>
                    <button type="button" id="clearButton" class="back">キャンセル</button>
            </section>
        </form>  
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
                                    <form id="delete-form" action="{{ route('user.destroy', ['id'=>$topic->id]) }}" method="POST">
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

    <footer>
        <nav>
            <ul>
                <li>会社情報</li>
                <li>プライバシーポリシー</li>
                <li>利用規約</li>
            </ul>
        </nav>
    </footer>

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