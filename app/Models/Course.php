<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    protected $guarded = ['id'];
    
    public function payment(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class);
    }
    
    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(Customer::class);
    }
}
