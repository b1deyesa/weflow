<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;

class Delete extends Component
{
    public User $user;
    
    public function close()
    {
        $this->dispatch('reload-page');
    }
    
    public function destroy()
    {
        $this->user->delete();
        
        return redirect(route('admin.setting.user.index'))->with('success','Success delete user');
    }
    
    public function render()
    {
        return view('livewire.admin.user.delete', [
            'user' => $this->user
        ]);
    }
}
