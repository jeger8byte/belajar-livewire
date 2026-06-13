<?php

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


new class extends Component
{
       use WithFileUploads;

        public $name = '';
        public $email = '';
        public $password = '';
        public $avatar ;

     public function createUser (){
        $validated = $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:3',
            'avatar' => 'image|max:5120'
        ]);

        if($this->avatar){
            $validated['avatar'] = $this->avatar->store('avatars', 'public');
        }

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),  
            'avatar' => $validated['avatar']
        ]);

         $this->reset(); // reset input field after create user
         session()->flash('success', 'User created successfully.');
         $this->dispatch('user-created');
         
    }

       public function render(){
         return view('⚡user-register-form.user-register-form');
       }

};
