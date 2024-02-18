<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'priority', 'completion_expected_date', 'hours_required', 'technological_level', 'status', 'project_id', 'flag', 'image_path'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
