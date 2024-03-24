<?php

namespace App\Http\Livewire\Chat;

use App\Models\Message;
use App\Notifications\MessageSent;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatBox extends Component
{
    public $selectedConversation;
    public $body;
    public $loadedMessages;
    public $paginate_var = 10;

    protected $listeners = [
        'loadMoreMessages',
    ];

    public function getListeners()
    {
        $auth_id = auth()->user()->id;

        return [
            'loadMoreMessages',
            "echo-private:users.{$auth_id},.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated" => 'broadcastedNotification',
        ];
    }

    public function broadcastedNotification($event)
    {
        dd($event);
    }
    

    public function loadMoreMessages(): void
    {
        // problem with alpine js will check the scroll function later
        // dd('load More'); 
        $this->paginate_var += 10;
        $this->loadMessages(); 
        $this->dispatch('update-chat-height');
    }

    public function loadMessages()
    {
        #get count of messages
        $count = Message::where('conversation_id', $this->selectedConversation->id)->count();

        # Skip and take messages
        $this->loadedMessages = Message::where('conversation_id', $this->selectedConversation->id)
        ->skip($count - $this->paginate_var)
        ->take($this->paginate_var)
        ->get();
    }

    public function sendMessage()
    {
        $this->validate([
            'body' => 'required|string'
        ]);

        $createdMessage = Message::create([
            'conversation_id' => $this->selectedConversation->id,
            'sender_id' => auth()->id(),
            'receiver_id' => $this->selectedConversation->getReceiver()->id,  
            'body' => $this->body,      
        ]);

        $this->reset('body');

        $this->dispatch('scroll-bottom');

        $this->loadedMessages->push($createdMessage);

        # update last message in conversation
        $this->selectedConversation->updated_at = now();
        $this->selectedConversation->save();

        # refresh chat list
        $this->dispatch('refresh')->to('chat.chat-list');

        # broadcast message
        $this->selectedConversation->getReceiver()
            ->notify(new MessageSent(
                Auth()->user(),
                $createdMessage,
                $this->selectedConversation,
                $this->selectedConversation->getReceiver()->id
            ));

    }

    /* First func to call on load page */
    public function mount()
    {
        $this->loadMessages();
    }

    public function render()
    {
        return view('livewire.chat.chat-box');
    }
}
