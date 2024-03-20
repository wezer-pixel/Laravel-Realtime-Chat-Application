<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Message;
use Livewire\Component;

class Chat extends Component
{
    public $query;
    public $selectedConversation;

    public function mount($query)
    {
        $this->selectedConversation = Conversation::findOrFail($this->query);
        
        


    }

    public function render()
    {
        return view('livewire.chat.chat');
    }
}
