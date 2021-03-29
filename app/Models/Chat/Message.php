<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'user_name',
        'user_email',
        'message_text',
        'message_time',
        'created_at',
        'updated_at'
    ];
}
