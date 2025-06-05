<?php

namespace App\Livewire\Admin\Employee;

use App\Models\Employee;
use Livewire\Component;

class Status extends Component
{
    public Employee $employee;
    public $status;
    public $toggle;
    
    public function mount()
    {
        $this->status = (bool)$this->employee->status;
    }
    
    public function updatedStatus($value)
    {
        $this->employee->update([
            'status' => $value
        ]);
        
        $this->status = (bool)$this->employee->status;
    }
    
    public function render()
    {
        return view('livewire.admin.employee.status', [
            'employee' => $this->employee
        ]);
    }
}
