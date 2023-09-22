<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrustVote;
use Illuminate\Support\Facades\Response;
use App\Models\Comment; // <-- 追加


class TrustVoteController extends Controller
{
    public function vote(Request $request, $comment_id) 
    {
        $voteType = $request->input('vote');  // 'upvote' または 'downvote'
        $currentUserId = auth()->id();

        // 既存の投票を探す
        $existingVote = TrustVote::where('comment_id', $comment_id)
            ->where('voted_by', $currentUserId)
            ->first();

            if ($existingVote) {
                // 既存の投票と新しい投票が同じ場合は、既存の投票を削除
                if (($voteType === 'upvote' && $existingVote->vote) || ($voteType === 'downvote' && !$existingVote->vote)) {
                    $existingVote->delete();
                } else {
                    // それ以外の場合は、投票を切り替える
                    $existingVote->vote = $voteType === 'upvote';
                    $existingVote->save();
                }
            } else {
                // 新しい投票を作成
                TrustVote::create([
                    'comment_id' => $comment_id,
                    'voted_by' => $currentUserId,
                    'vote' => $voteType === 'upvote',
                ]);
            }
             // 投票後、適切なリダイレクト先にユーザーをリダイレクト
             $comment = Comment::find($comment_id); // <-- 追加

             $upvotes = TrustVote::where('comment_id', $comment_id)->where('vote', true)->count();
             $downvotes = TrustVote::where('comment_id', $comment_id)->where('vote', false)->count();
     
             $score = $upvotes - $downvotes;
     
             return response()->json(['message' => 'Vote processed successfully.', 'newScore' => $score], 200);
         }// 一つ前のページにリダイレクト
    }

