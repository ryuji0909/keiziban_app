<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'content',
        'topic_id',
        'user_id',
    ];

    public static $validationAttributes = [
        'content' => 'コメント',
    ];

    public static $messages = [
        'content.required' => ':Attributeは必須です。',
    ];

    public function user()
    {
        //子(Commnents) -> 親(User)の関係
        return $this->belongsTo(User::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function user_id()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    protected static function boot()
    {
        parent::boot(); 

        
        static::deleting(function ($comment) { //削除ボタンが押されたら処理を実行
            // 関連するレポートを物理削除
            $comment->reports()->forceDelete(); //リーレーション先のものも削除する
        });
    }

    public function trustVotes()
    {
        return $this->hasMany(TrustVote::class);
    }
    

    public function upvoteCount()
   {
       return $this->trustVotes()->where('vote', true)->count();
   }

   public function downvoteCount()
   {
       return $this->trustVotes()->where('vote', false)->count();
   }
}
