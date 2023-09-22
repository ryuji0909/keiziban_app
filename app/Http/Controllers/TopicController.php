<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Topic;


class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $topics = Topic::latest()->get(); // 最新のトピックを取得
    //     return view('user.topichome', compact('topics')); // トピック一覧をビューに渡す
    // }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create() //最初に画面を表示させる
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
        // $topic->$user = $user->username; // ユーザー名を保存
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
    public function show(Request $request, $id)
    {
        $topic = Topic::find($id);
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
