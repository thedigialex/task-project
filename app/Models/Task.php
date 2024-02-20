<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'priority',
        'completion_expected_date',
        'hours_required',
        'technological_level',
        'status',
        'flag',
        'image_path'
    ];

    public function phase()
    {
        return $this->belongsTo(Phase::class);
    }
}
