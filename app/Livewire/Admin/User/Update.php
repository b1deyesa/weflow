<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Update extends Component
{
    public User $user;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    
    public function mount()
    {
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }
    
    public function close()
    {
        $this->dispatch('reload-page');
    }
    
    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'. $this->user->id
        ]);
        
        if (!is_null($this->password)) {
            $this->validate(['password' => 'confirmed']);
            $this->user->update(['password' => Hash::make($this->password)]);
        }
        
        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);
        
        return redirect(route('admin.setting.user.index'))->with('success','Success update user data');
        
    }
    
    public function render()
    {
        return view('livewire.admin.user.update', [
            'user' => $this->user
        ]);
    }
}
