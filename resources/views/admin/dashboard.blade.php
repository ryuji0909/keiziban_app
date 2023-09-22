<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="">
@vite(['resources/css/dashboard.css'])
<title>管理者トップ画面</title>
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
    <div class="container">
       <article>
            <div class="side">
                <ul>
                    <li><a href="#">トピック管理</a></li>
                    <li><a href="{{ route('reports.index') }}">不適切コメント管理一覧</a></li>
                    <li><a href="{{ route('userlist.index')}}">ユーザー管理</a></li>
                </ul>
            </div>
       </article>
       <div class="content">
            <dl>
                <dd>トータルユーザー数</dd>
                <dt>{{ $users->count()}}</dt>
                <dd>報告されたコメント数</dd>
                <dt>{{ $reports->count()}}</dt>
                <dd>作成されたトピック数</dd>
                <dt>{{ $topics->count()}}</dt>
            </dl>

            <h1>トピック一覧</h1>
            <table>
            <tr>
                <th>投稿タイトル</th>
                <th>作成者</th>
                <th>作成日</th>
                <th></th>
            </tr>

            @foreach ($topics as $topic) 
                <tr>
                    <td>{{ ($topic->title)}}</td>
                    @if( $topic->user )
                    <td>{{ ($topic->user->username )}}</td>
                    @else
                    <td>ユーザーがいません</td>
                    @endif
                    <td>{{ $topic->created_at->format('Y-m-d H:i:s')}}</td>
                    <td>
                        <form id="delete-form" action="{{ route('admin.destroy', ['id'=>$topic->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn delete-link">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </table>
       </div>
    </div>
</div>


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