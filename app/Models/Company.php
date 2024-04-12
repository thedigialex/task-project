<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Company extends Model
{
    protected $fillable = [
        'name',
    ];

    use HasFactory;

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
    
    public function users()
    {
        return $this->hasMany(User::class);
    }
    
    public function truncatName($limit = 10)
    {
        return Str::of($this->name)->limit($limit);
    }
}
