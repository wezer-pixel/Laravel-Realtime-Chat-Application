<?php

namespace App\Http\Livewire;

use App\Models\Conversation;
use App\Models\User;
use Livewire\Component;


class Users extends Component
{
    public function message($UserId)
    {
        $authenticatedUserId = auth()->id();

        # Check if the authenticated user has already a conversation with the selected user
        $existingConversation = Conversation::where(function ($query) use($authenticatedUserId, $UserId) {
            $query->where('sender_id', $authenticatedUserId)
                ->where('receiver_id', $UserId);
        })->orWhere(function ($query) use($authenticatedUserId, $UserId) {
            $query->where('sender_id', $UserId)
                ->where('receiver_id', $authenticatedUserId);
        })->first();

        if ($existingConversation) {
            return redirect()->route('chat', ['query' => $existingConversation->id]);
        }

        # Create a new conversation
        $createdConversation = Conversation::create([
            'sender_id' => $authenticatedUserId,
            'receiver_id' => $UserId
        ]);
        return redirect()->route('chat', ['query' => $createdConversation->id]);
    }


    public function render()
    {
        return view('livewire.users', [
            'users' => User::where('id', '!=', auth()->id())->get()
        ]);
    }
}