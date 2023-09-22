<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="">
@vite(['resources/css/hilight.css'])
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
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section id="hilight" class="wrapper">
            <h2>ハイライト一覧</h2>
            <table border = "1">
                <tr>
                    <th>タイトル</th>
                    <th>投稿内容</th>
                    <th>投稿者</th>
                    <th>投稿日</th>
                </tr>
                
                @foreach ($highlights as $highlight)
                @if ($highlight->topic)
                <tr>
                    <td>{{ $highlight->topic->title }}</td>
                    <td>{{ $highlight->topic->content }}</td>
                    <td>{{ $highlight->topic->user->username }}</td>
                    <td>{{ $highlight->topic->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
                @endif
                @endforeach
            </table>
        </section>
    </main>
</body>
</html>