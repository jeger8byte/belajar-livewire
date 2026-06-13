<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Livewire\Attributes\On; 
use Livewire\Attributes\Computed; 

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

    #[Computed()]
    public function users(){
        return User::latest('created_at')
            ->where('name', 'like', "%{$this->query}%")
            ->paginate(6);
    }

   
};
