<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoomsUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'chat_id',
        'user_email',
        'created_at',
        'updated_at'
    ];

    public function chats(){
        return $this->belongsTo(ChatRoom::class, 'chat_id');
    }
}
