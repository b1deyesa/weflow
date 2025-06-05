<?php

namespace App\Livewire\Admin\Salary;

use App\Models\Salary;
use Livewire\Component;

class Delete extends Component
{
    public Salary $salary;
    
    public function close()
    {
        $this->dispatch('reload-page');
    }
    
    public function destroy()
    {
        $this->salary->delete();
        
        return redirect(route('admin.salary.index'))->with('success','Success delete employee');
    }
    
    public function render()
    {
        return view('livewire.admin.salary.delete');
    }
}
