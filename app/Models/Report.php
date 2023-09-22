<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_id',
        'reported_by',
        'reason_id',
    ];

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    

    // updated_at タイムスタンプを無効にする
    public function setUpdatedAt($value)
    {
        return $this;
    }

    public function setCreatedAt($value)
    {
        return $this;
    }

    public function reportedBy()
    {
        return $this->belongsTo(User::class, 'reported_by');
    }

    public function reason()
    {
        return $this->belongsTo(ReportReason::class, 'reason_id');
    }
}
