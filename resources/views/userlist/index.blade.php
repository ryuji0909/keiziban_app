<!-- ユーザー一覧画面 -->

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="">
@vite(['resources/css/index.css'])
<title>ユーザー一覧画面</title>
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

    <section id="userlist">
        <h1>ユーザー一覧</h1>
        <table>
            <tr>
                <th>ユーザー名</th>
                <th>メールアドレス</th>
                <th>アカウント作成日</th>
                <th>最終ログイン日</th>
                <th></th>
            </tr>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->username}}</td>
                <td>{{ $user->email}}</td>
                <td>{{ $user->created_at}}</td>
                <td> {{ $user->last_login}}</td>
                <td> <form id="delete-form" action="{{ route('userlist.destroy', ['id' => $user->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-link">削除</button>
                </form></td>
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