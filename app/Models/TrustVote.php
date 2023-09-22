<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrustVote extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'comment_id',
        'voted_by',
        'vote',
    ];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
