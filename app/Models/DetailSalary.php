<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailSalary extends Model
{
    protected $guarded = ['id'];
    
    public function salary(): BelongsTo
    {
        return $this->belongsTo(Salary::class, 'salary_id');
    }
    
    public function payment_status()
    {
        return $this->payment_status == true ? '<span class="text-success">Payment</span>' : '<span class="text-danger">No Payment</span>'; 
    }
}
