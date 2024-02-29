<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bug extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 
        'description', 
        'status',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
