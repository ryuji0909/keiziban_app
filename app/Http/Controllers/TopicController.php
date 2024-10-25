<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Topic;


class TopicController extends Controller
{
    /**
     * 管理者画面のトピック一覧画面
     */

     public function index()
    {
        $topics = Topic::all();
        return view('admin.topic.index', compact('topics'));
    }
  
    /**
     * トピック画面
     */
    public function create()
    {
        $topics = Topic::latest()->get(); 
        
        return view('user.topichome', compact('topics'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => ['required', 'string'],
            'content' => ['required', 'string'], 
        ],Topic::$messages, Topic::$validationAttributes);

        
        // ログインユーザーの情報を取得
        $user = Auth::user();
        // ユーザー名、日付、タイトル、トピック内容を保存
        $topic = new Topic();
        $topic->user_id = $user->id;
        $topic->title = $request->input('title');
        $topic->content = $request->input('content');
        $topic->save();

        // トピック一覧を再取得してビューに渡す
        $topics = Topic::latest()->get();
        
        return view('user.topichome', compact('topics'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id) //1件づつの詳細情報を表示させる、idを指定することにより何番目と指定できる
    {
        $topic = Topic::find($id); //1件だけ取得
        return view('user.comment', compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $topic = Topic::find($id); //Topicモデルから対象のid情報を取得
        return view('user.edit', compact('topic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $topic = Topic::findOrFail($id);
        $request->validate([
            'title' => ['required', 'string'],
            'content' => ['required', 'string'], 
        ],Topic::$messages, Topic::$validationAttributes);

        $topic->update($request->all()); //データベースへの更新

        return view('user.update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //topicsテーブルから制定のIDのレコード1件を取得
        $topic = Topic::find($id);
        // Topic::destroy($id);
        $topic->delete(); //レコードの削除
        return redirect('/topichome');
    }
}
