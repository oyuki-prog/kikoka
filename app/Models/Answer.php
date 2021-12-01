<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Answer extends Model
{
    use HasFactory;

    protected $appends = [
        'elapsed'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function question() {
        return $this->belongsTo(Question::class);
    }

    public function getTimeAttribute() {
        return date('Y/m/d/ H:i', strtotime($this->created_at));
    }

    public function getElapsedAttribute() {
        return Carbon::parse($this->created_at)->diffForHumans();
    }
}
