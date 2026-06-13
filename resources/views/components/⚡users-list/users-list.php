<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Livewire\Attributes\On; 

new class extends Component
{
     use WithPagination;

     public $query='';

     #[On('user-created')]

     public function updatedQuery(){
         
         $this->resetPage();
     }
     public function search (){
        $this->resetPage();
     }
        
    public function placeholder(){
        return view('placeholder.skeleton');
    }

    public function render(){
        sleep(2);
        return view('⚡users-list.users-list',[
            'title' => 'User Page',
            'users' => User::latest('created_at')
            ->where('name', 'like', "%{$this->query}%")
            ->paginate(6)
        ]);
    }
};
