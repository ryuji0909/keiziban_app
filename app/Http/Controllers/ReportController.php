<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\ReportReason;
use App\Models\Report;

class ReportController extends Controller
{

    public function index()
    {
        $comments = Comment::with(['reports.reason'])->get();
        return view('report.index', compact('comments'));
    }
    public function create($id)
    {
        $comment = Comment::find($id);
        return view('report.create', compact('comment'));
    }

    public function store(Request $request)
    {
        // ReportReasonの保存
        $report_reason = ReportReason::create([
            'description' => $request->input('description'),
        ]);
        // Reportの保存
        Report::create([
            'reported_by' => auth()->id(),
            'reason_id' => $report_reason->id,
            'comment_id' => $request->comment_id,
        ]);
        // 保存が完了した後のリダイレクトや、適切なレスポンスを返す
        return redirect('/topichome');
    }

    public function destroy($id)
    {
        
        $report = Report::findOrFail($id);

        if ($report) {
            // コメントが存在する場合、レコードを削除
            $report->delete();
        }

        // リダイレクト先を設定
        return redirect('/report');
    }


}
