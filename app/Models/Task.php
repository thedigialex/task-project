<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'priority',
        'target_date',
        'hours_required',
        'technological_level',
        'status',
        'image_path',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function phase()
    {
        return $this->belongsTo(Phase::class);
    }

    public function subTasks()
    {
        return $this->hasMany(SubTask::class);
    }

    public function truncateString($string, $limit = 20)
    {
        return Str::of($string)->limit($limit);
    }
}
