<?php

namespace App\Http\Controllers;
use App\Models\Highlight;
use Illuminate\Support\Facades\Auth;



class HighlightController extends Controller
{
    public function index()
    {
       //$highlights = HighLight::where('highlighted_By', $user->id)->get();
       $highlights = HighLight::all();
       return view('user.hilight', compact('highlights'));
    }
   
    public function store($id) 
    {
        $userId = Auth::user()->id;
        $highlight = Highlight::where('topic_id', $id)->where('highlighted_by', $userId)->first();
        if (!$highlight) {
            // Highlightが存在しない場合は新しいレコードを作成
            Highlight::create([
                'topic_id' => $id,
                'highlighted_by' => $userId,
            ]);
        } else {
            // 既にHighlightが存在する場合はそのレコードを削除
            $highlight->delete();
        }
        
    
        // 必要に応じてレスポンスを返す
        return back();  // 例えば、前のページにリダイレクト
    
    }
}
