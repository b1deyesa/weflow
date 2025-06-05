<?php

namespace App\Livewire\Admin\Payment;

use App\Models\Customer;
use Livewire\Component;

class Status extends Component
{
    public Customer $customer;
    
    public function mount()
    {
        // 
    }
    
    public function close()
    {
        $this->dispatch('reload-page');
    }
    
    public function render()
    {
        return view('livewire.admin.payment.status', [
            'customer' => $this->customer
        ]);
    }
}
