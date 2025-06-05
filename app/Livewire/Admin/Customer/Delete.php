<?php

namespace App\Livewire\Admin\Customer;

use App\Models\Customer;
use Livewire\Component;

class Delete extends Component
{
    public Customer $customer;
    
    public function close()
    {
        $this->dispatch('reload-page');
    }
    
    public function destroy()
    {
        $this->customer->delete();
        
        return redirect(route('admin.customer.index'))->with('success','Success delete customer');
    }
    
    public function render()
    {
        return view('livewire.admin.customer.delete');
    }
}
