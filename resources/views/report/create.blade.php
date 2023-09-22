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
                </ul>
            </nav>
        </div>
    </header>

    <section id="report">
        <div class="wrapper">
            <h1>報告フォーム</h1>
            <form action="{{ route('report.store')}}" method="POST">
                @csrf
                <div class="content">
                    <dl>
                        <div>
                            <dd>コメント内容：{{ $comment->content }}</dd>
                        </div>
                        <div>
                            <dd>報告理由：<textarea id="reportreason" name="description"></textarea></dd>
                        </div>
                        <div>
                            <dd>コメント信頼度:  
                            @php
                                $score = $comment->upvoteCount() - $comment->downvoteCount();
                            @endphp
                            {{ $score }}</dd>
                        </div>
                        <div>
                            <input hidden name="comment_id" value="{{$comment->id}}">
                        </div>
                    </dl>
                    <div class="btn">
                        <button type="submit" class="button">送信</button>
                        <button type="button" id="clearButton" class="back">キャンセル</button>
                    </div>
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
            var inputText = document.getElementById("reportreason");
            var textareaText = document.getElementById("name");
    
            clearButton.addEventListener("click", function () {
                inputText.value = ""; // inputエリアの内容をクリア
                textareaText.value = ""; // テキストエリアの内容をクリア
            });
        });
    </script>
</body>
</html>