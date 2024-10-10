<?php

namespace App\Livewire\Home\Profile;

use App\Models\Message;
use Livewire\Component;

class Chat extends Component
{
    public $form_chat=1,$chat_message,$chat,$message;
    public function new_chat()
    {
        $this->form_chat=1;
        $this->chat=null;
    }

    public function save_chat()
    {
        $this->validate([
            'chat_message' => ['required'],
        ], [
            'chat_message.required' => 'این فیلد الزامی می باشد',
        ]);
        $chatId=\App\Models\Chat::create([
           'title'=>$this->chat_message,
           'user_id'=>auth()->id(),
        ]);
        $this->chat_message="";
        $this->form_chat=0;
        $this->chat=\App\Models\Chat::with('messages')->find($chatId->id);
        return $this->dispatch('alert',icon:'success',message:'پیام با موفقیت ساخته شد');
    }

    public function set_chat($id)
    {
        $this->form_chat=0;

        $this->chat=\App\Models\Chat::with('messages')->find($id);
        Message::where('chat_id',$id)->whereNot('sender_id',auth()->user()->id)->update(['seen'=>1]);
    }

    public function save_message()
    {
        $this->validate([
            'message' => ['required'],
        ], [
            'message.required' => 'این فیلد الزامی می باشد',
        ]);
        \App\Models\Message::create([
            'message'=>$this->message,
            'sender_id'=>auth()->id(),
            'chat_id'=>$this->chat->id,
        ]);
        \App\Models\Chat::find($this->chat->id)->update(['updated_at'=>now()]);
        $this->message="";
        $this->chat=\App\Models\Chat::with('messages')->find($this->chat->id);

    }
    public function render()
    {
        $chats=\App\Models\Chat::withCount('messages_seen')->where('user_id',auth()->id())->orderBy('updated_at','desc')->get();
        return view('livewire.home.profile.chat',compact('chats'));
    }
}
