<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Project extends Model
{
    protected $fillable = [
        'company_id',
        'name',
        'description',
        'target_date',
        'hours',
        'main_contact',
        'notes'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function phases()
    {
        return $this->hasMany(Phase::class);
    }
    
    public function bugs()
    {
        return $this->hasMany(Bug::class);
    }

    public function truncateName($limit = 20)
    {
        return Str::of($this->name)->limit($limit);
    }

    public function truncateDescription($limit = 100)
    {
        return Str::of($this->description)->limit($limit);
    }
}
