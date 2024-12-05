<?php

namespace App\Livewire\Dashboard\Messages;

use App\Models\Chat;
use App\Models\Message;
use Livewire\Component;

class User extends Component
{
    public $user,$chat,$message;

    public function set_chat($id)
    {
        $this->chat=Chat::with('messages.sender')->find($id);
    }
    protected $rules = [
        'message' => 'required',
    ];
    public function save()
    {
        $this->validate();
        Message::create([
            'message' => $this->message,
            'sender_id' => auth()->user()->id,
            'chat_id' => $this->chat->id,
        ]);
        Message::where('chat_id', $this->chat->id)->update(['seen' => 1]);
        $this->reset('message');
    }
    public function mount($user)
    {
        $this->user = \App\Models\User::with('chats')->find($user);
        if (request()->has('chat_id')) {
            $this->chat=Chat::with('messages.sender')->find(request()->get('chat_id'));

        }
    }
    public function render()
    {
        return view('livewire.dashboard.messages.user');
    }
}
