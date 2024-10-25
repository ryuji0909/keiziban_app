<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="">
@vite(['resources/css/comment.css'])
<title>コメント一覧画面</title>
</head>
<body>
    <x-header-layout>
    <div class="wrapper">
        <form action="#" method="post">
            @csrf
            <section id="topicarea">
                <h2>トピック詳細</h2>
                <div class="topicarea">
                    <dl class="topic_area">
                        @if ($topic)
                        <span>
                            {{ $topic->user->username }}さん
                            投稿日付：{{ $topic->created_at->format('Y-m-d H:i:s') }}
                        </span>
                        <dd><label for="title">タイトル：</label></dd>
                        <p>{{ $topic->title }}</p>
                        <dd><label for="topic">トピック内容：</label></dd>
                        <p>{{ $topic->content }}</p>
                    </dl>
                    <div><a href="{{ route('user.commentcreate', ['id' => $topic->id])}}" class="replay">リプライ</a></div>
                    @endif
                </div>
            </section>
        </form>
        <section id="commentarea">
            <h2>コメント一覧</h2>
            <dd><label for="comment">コメント内容</label></dd>
                @if ($topic && $topic->comments)
                    @foreach($topic->comments as $comment)
                        <div class="commentlist">
                            <p class="commentusername">{{ $comment->user->username}}さんがコメントを作成</p>
                            <p class="comment">{{ $comment->content}}</p>
                        </div>
                        <div class="btn">
                            <ul>
                                <li><a href="{{ route('reports.create', ['id' => $comment->id]) }}">報告</a></li>
                                <li>
                                    <form id="delete-form" action="{{ route('comment.destroy', ['id' => $comment->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="delete-link" onclick="confirmDelete()">削除</button>
                                    </form>
                                </li>
                                <li><button class="vote-button up" data-comment-id="{{ $comment->id }}" data-vote="upvote">⤴︎</button></li>
                                <li><button class="vote-button down" data-comment-id="{{ $comment->id }}" data-vote="downvote">⤵︎</button></li>
                                @php
                                    $score = $comment->upvoteCount() - $comment->downvoteCount();
                                @endphp
                                    <li id="score-for-comment-{{ $comment->id }}">信頼度：{{ $score }}</li>
                            </ul>
                        </div>
                    @endforeach  
                @endif
        </section>
    </div>
    </x-header-layout>

    <script>
  document.addEventListener("DOMContentLoaded", function() {
    const voteButtons = document.querySelectorAll('.vote-button');

    voteButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const commentId = this.getAttribute('data-comment-id');
            const voteType = this.getAttribute('data-vote');

            fetch(`/comments/${commentId}/vote`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: `vote=${voteType}`
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.json();
            })
            .then(data => {
                document.querySelector(`#score-for-comment-${commentId}`).innerText = "信頼度：" + data.newScore;
            })
            .catch(error => {
                console.error("There was a problem with the fetch operation:", error.message);
            });
        });
    });
});

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