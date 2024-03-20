<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;


class Users extends Component
{
    public $selectedUserId = null;

    public function setSelectedUserId($id)
    {
        dd($id);
        //  $this->selectedUserId = $id;
    }

    public function message($selectedUserId)
    {
        dd($selectedUserId);
    }


    public function render()
    {
        return view('livewire.users', [
            'users' => User::where('id', '!=', auth()->id())->get()
        ]);
    }
}