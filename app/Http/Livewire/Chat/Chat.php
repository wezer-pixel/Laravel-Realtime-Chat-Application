<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Message;
use Livewire\Component;

class Chat extends Component
{
    public function render()
    {
        return view('livewire.chat.chat');
    }
}
