<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
