<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="">
@vite(['resources/css/commentcreate.css'])
<title>コメント作成画面</title>
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

    <section>
        <form action="{{ route('comment.store') }}" method="POST">
            @csrf
            <div class="commentarea wrapper">
                <h1>コメント作成</h1>
                <dl>
                    <dd><label for="content">コメント：</label></dd>
                @error('content')
                    <span class="invalid-feedback" role="alert">
                        <p style="color:red">{{ $message }}</p>
                    </span>
                @enderror
                    <dt><textarea id="content" name="content"></textarea></dt>
                </dl>
                <div class="btn">
                    <button type="submit" class="submit">送信</button>
                    <button type="button" id="clearButton" class="back">キャンセル</button>
                </div>
                <input type="hidden" name="user_id" value="{{ auth()->user()->id}}">
                <input type="hidden" name="topic_id" value="{{ $topic->id}}">
            </div>
        </form>    
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
            var textArea = document.getElementById("content");
    
            clearButton.addEventListener("click", function () {
                textArea.value = ""; // テキストエリアの内容をクリア
            });
        });
    </script>
    
</body>
</html>