<?php

namespace App\Livewire\Admin\Team;

use App\Models\Team;
use Livewire\Component;

class Delete extends Component
{
    public Team $team;
    
    public function close()
    {
        $this->dispatch('reload-page');
    }
    
    public function destroy()
    {
        $this->team->delete();
        
        return redirect(route('admin.team.index'))->with('success','Success delete team');
    }
    
    public function render()
    {
        return view('livewire.admin.team.delete');
    }
}
