<?php

//コメント一覧画面に遷移
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index() 
    {
        return view('user.comment');
    }

    public function create() 
    {
       
    }

    public function store(Request $request) //コメントを作成し、コメント一覧を表示
    {
        $request->validate([
            'content' => ['required', 'string'], 
        ],Topic::$messages, Topic::$validationAttributes);
        
        Comment::create($request->all());
        return redirect()->route('topic.show', ['id' => $request->topic_id]);
    }

    public function commentcreate($id) //コメント作成画面を表示
    {
        $topic = Topic::find($id);
        return view('user.commentcreate', compact('topic'));
    }

    public function destroy($id)
    {
       
        
        $comment = Comment::findOrFail($id);;

        if ($comment) {
            // コメントが存在する場合、レコードを削除
            $comment->delete();
        }

        // リダイレクト先を設定
        return redirect('/topichome');
    }
}
