<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    
    public function close()
    {
        $this->dispatch('reload-page');
    }
    
    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);
        
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);
        
        return redirect(route('admin.setting.user.index'))->with('success','Success add user');
    }
    
    public function render()
    {
        return view('livewire.admin.user.create');
    }
}
