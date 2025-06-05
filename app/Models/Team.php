<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Team extends Model
{
    protected $guarded = ['id'];
    
    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(Customer::class);
    }
    
    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class);
    }
}
