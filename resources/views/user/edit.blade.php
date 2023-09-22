<!-- 編集画面 -->

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="">
@vite(['resources/css/edit.css'])
<title>トピック編集画面</title>
</head>
<body>
    <header id="header">
        <div class="inner wrapper">
            <h2 class="text">掲示板</h2>
            <nav>
                <ul>
                    <li>{{ Auth::user()->username }}さん</li>
                    <li> <a href="{{ route('logout') }}" class="backbtn" onclick="event.preventDefault();document.getElementById('logout-form').submit();">ログアウト</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <li><a href="{{ route('user.topichome') }}">ユーザートップ画面</a></li>
                    <li><a href="{{ route('highlight.index')}}">ハイライト一覧</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section id="edittopic">
        <div class="wrapper">
            <h1>編集画面</h1>
            <form action="{{ route('topic.update', ['id' => $topic->id]) }}" method="POST">
                @method('PUT')
            @csrf
                <div class="editarea">
                    <div class="content">
                        <label for="title">投稿タイトル：</label>
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <p style="color:red">{{ $message }}</p>
                        </span>
                    @enderror
                    <input type="text" name="title" value="{{ $topic->title }}">
                    </div>
                    <div class="content">
                    <label for="content">投稿内容：</label>
                    @error('content')
                        <span class="invalid-feedback" role="alert">
                            <p style="color:red">{{ $message }}</p>
                        </span>
                    @enderror
                    <textarea id="content" name="content">{{ $topic->content }}</textarea>
                    </div>

                    <button type="submit" class="update">更新</button>
                    <button type="button" id="clearButton" class="back">キャンセル</button>
                </div>
            </form>
        </div>
    </section>


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