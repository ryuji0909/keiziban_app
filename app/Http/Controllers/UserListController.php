<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserListController extends Controller
{
    public function index()
    {
        $users = User::all(); //Userモデルを全件取得
        
        return view('userlist.index', compact('users'));
    }

    public function destroy($id)
    {
        
        $user = User::findOrFail($id);

        if ($user) {
            // コメントが存在する場合、レコードを削除
            $user->delete();
        }

        // リダイレクト先を設定
        return redirect('/userlist');
    }
}
