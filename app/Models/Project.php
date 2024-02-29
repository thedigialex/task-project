<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'company_id',
        'name',
        'description',
        'completion_date',
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
}
