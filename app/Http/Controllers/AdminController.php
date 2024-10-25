<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\User;
use App\Models\Report;

class AdminController extends Controller
{

      /**
     * 管理者画面のトップページ
     */
    public function index()
    {
        $reports = Report::all();
        $users = User::all();
        $topics = Topic::all();
        return view('admin.top.index', compact('topics','users','reports'));
    }



    /**
     * 管理者画面のTopicを削除
     */
    public function destroy($id)
    {
        //topicsテーブルから制定のIDのレコード1件を取得
        $topic = Topic::find($id);
        $topic->delete(); //レコードの削除
        return redirect('/top');
    }


}
