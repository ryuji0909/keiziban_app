<!-- 不適切コメント一覧 -->
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="">
@vite(['resources/css/report.css'])
<title>コメント一覧画面</title>
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
                    <li><a href="{{ route('admin.dashboard')}}">管理者トップ画面</a></li>
                </ul>
            </nav>
        </div>
    </header>


    <section id="report">
        <h1>不適切コメント一覧</h1>
        <table border="1">
            <tr>
                <th>コメント内容</th>
                <th>報告された理由</th>
                <th>報告者</th>
                <th>コメント信頼度スコア</th>
                <th></th>
            </tr>

            @foreach($reports as $report)
            <tr>
                <td>{{ $report->comment->content}}</td>
                <td>{{ $report->reason->description}}</td>
                <td>{{ $report->reportedBy->username}}</td>
                @php
                    $score = $report->comment->upvoteCount() - $report->comment->downvoteCount();
                @endphp
                <td>{{ $score }}</td>
                <td><button type="submit" class="deletebtn">削除</button></td>
            </tr>
            @endforeach
        </table>
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
</body>
</html>