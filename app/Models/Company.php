<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
    public function mainContact()
    {
        return $this->belongsTo(User::class, 'main_contact_id');
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
