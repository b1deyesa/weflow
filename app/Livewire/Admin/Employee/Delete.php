<?php

namespace App\Livewire\Admin\Employee;

use App\Models\Employee;
use Livewire\Component;

class Delete extends Component
{
    public Employee $employee;
    
    public function close()
    {
        $this->dispatch('reload-page');
    }
    
    public function destroy()
    {
        $this->employee->delete();
        
        return redirect(route('admin.employee.index'))->with('success','Success delete employee');
    }
    
    public function render()
    {
        return view('livewire.admin.employee.delete');
    }
}
