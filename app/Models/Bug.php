<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
    
    public function truncatString($string, $limit = 10)
    {
        return Str::of($string)->limit($limit);
    }
}
