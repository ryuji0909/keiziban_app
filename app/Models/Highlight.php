<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Highlight extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic_id',
        'highlighted_by',
    ];

     // updated_at タイムスタンプを無効にする
     public function setUpdatedAt($value)
     {
         return $this;
     }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }


    public function highlightedBy()
    {
        return $this->belongsTo(User::class, 'highlighted_by');
    }

}
