<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\User;
use App\Models\Report;

class AdminController extends Controller
{
    public function index() 
    {
        $reports = Report::all();
        $users = User::all();
        $topics = Topic::all();
        return view('admin.dashboard', compact('topics','users','reports'));
    }

    public function destroy($id)
    {
        //topicsテーブルから制定のIDのレコード1件を取得
        $topic = Topic::find($id);
        // Topic::destroy($id);
        $topic->delete(); //レコードの削除
        return redirect('/dashboard');
    }
}
