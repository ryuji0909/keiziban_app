<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];

    public static $validationAttributes = [
        'title' => 'タイトル',
        'content' => '投稿',
    ];

    public static $messages = [
        'title.required' => ':Attributeは必須です。',
        'content.required' => ':Attributeは必須です。',
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }
    public function user()
{
    //子(Topic) -> 親(User)の関係
    return $this->belongsTo(User::class); 
}


    public function comments()
    {
        //親(Topic) -> 子(Comments)の関係
        return $this->hasMany(Comment::class);
    }

    protected static function boot()
    {
        parent::boot();

        // トピックが削除される前に、関連するハイライトを削除
        static::deleting(function ($topic) {
            $topic->highlights()->delete();
        });
    }

    public function highlights()
    {
        //親(Topic) -> 子(highlights)の関係
        return $this->hasMany(Highlight::class);
    }
    
}
