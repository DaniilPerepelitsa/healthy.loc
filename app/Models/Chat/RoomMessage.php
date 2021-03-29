<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RoomMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'chat_id',
        'user_id',
        'user_email',
        'user_name',
        'message_text',
        'message_time',
        'is_read',
        'created_at',
        'updated_at'
    ];
}
