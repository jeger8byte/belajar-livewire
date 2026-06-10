<?php

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

new class extends Component
{
    public $name, $email, $password;
    
     public function createUser (){
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);
         $this->reset(); // reset input field after create user
    }

    public function render()
    {
        return view('livewire.⚡users.users',[
            'title' => 'User Page',
            'users' => User::all()
        ]);
    }

  
};
