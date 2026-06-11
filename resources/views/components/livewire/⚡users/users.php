<?php

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

new class extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
        
     public function createUser (){
        $validated = $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:3'
        ]);
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);
         $this->reset(); // reset input field after create user
         session()->flash('success', 'User created successfully.');
         
    }

    public function render()
    {
        return view('livewire.⚡users.users',[
            'title' => 'User Page',
            'users' => User::all()
        ]);
    }

  
};
