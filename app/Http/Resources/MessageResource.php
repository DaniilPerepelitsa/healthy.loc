<?php

namespace App\Http\Resources;

use App\Models\Chat\RoomMessage;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class MessageResource
 * @package App\Http\Resources
 *
 * @mixin RoomMessage
 */
class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'message_text' => $this->message_text,
            'message_time' => $this->message_time,
            'user_email' => $this->user_email
        ];
    }
}
