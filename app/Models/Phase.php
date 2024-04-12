<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Phase extends Model
{
    protected $fillable = [
        'name',
        'target_date',
        'goal',
    ];
    public function getCompletionPercentage()
    {
        $totalTasks = $this->tasks->count();
        if ($totalTasks > 0) {
            $completedTasks = $this->tasks->where('status', 'complete')->count();
            return round(($completedTasks / $totalTasks) * 100);
        }

        return 0;
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function truncatName($limit = 10)
    {
        return Str::of($this->name)->limit($limit);
    }
}
