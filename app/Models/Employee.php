<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    protected $guarded = ['id'];
    
    public function salaries(): HasMany
    {
        return $this->hasMany(Salary::class);
    }
    
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class);
    }
    
    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }
}
