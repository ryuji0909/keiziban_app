<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportReason extends Model
{
    use HasFactory;

    protected $fillable = [
        'description', 
    ];

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    // updated_at タイムスタンプを無効にする
    public function setUpdatedAt($value)
    {
        return $this;
    }


    // create_at タイムスタンプを無効にする
    public function setCreatedAt($value)
    {
        return $this;
    }
}
