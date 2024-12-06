<?php

namespace App\Livewire\Dashboard\Messages;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public function seen($id)
    {
        Message::where('chat_id', $id)->update(['seen' => 1]);
    }
    public function render()
    {
        $data = DB::table('chats')
            ->join('messages', 'chats.id', '=', 'messages.chat_id')
            ->join('users', 'chats.user_id', '=', 'users.id')
            ->where('users.role_id', 1) // فقط چت‌هایی که از سمت مشتری هستند
            ->where('messages.seen', 0) // پیام‌های دیده نشده
            ->where(function ($query) {
                $query->where('messages.sender_id', function ($subQuery) {
                    $subQuery->select('id')
                        ->from('users')
                        ->where('role_id', 1)
                        ->orderByDesc('messages.created_at')
                        ->limit(1);
                });
            })
            ->select('chats.*','users.name', 'messages.message','messages.created_at', 'messages.sender_id', 'messages.chat_id', 'messages.seen')
            ->orderByDesc('messages.created_at')
            ->get();
        return view('livewire.dashboard.messages.index',compact('data'));
    }
}
