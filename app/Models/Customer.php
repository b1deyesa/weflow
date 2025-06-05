<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $guarded = ['id'];
    
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
    
    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }
    
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class);
    }
    
    public function totalPayment()
    {
        $total = $this->payments->sum(function ($payment) {
            return optional($payment->course)->price;
        });
        
        return $total;
    }
}
