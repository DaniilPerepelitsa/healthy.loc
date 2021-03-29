<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Models\Chat\ChatRoom;
use App\Models\Chat\ChatRoomsUser;
use App\Models\Chat\Message;
use App\Models\Chat\RoomMessage;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $users = User::all();

        return response()->json($users);
    }

    public function showChat(){
        return view('chat/users_list', ['auth_user' => Auth::user()]);
    }


    //--------GENERAL CHAT--------//
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function sendMessage(Request $request)
    {
        $data = $request->data;

        $message = new Message([
            'user_id' => $data['user_id'],
            'user_email' => $data['user_email'],
            'user_name' => $data['user_name'],
            'message_text' => $data['message_text'],
            'message_time' => $data['message_time'],
        ]);
        $message->save();

        return response()->json($data);
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function getMessages(Request $request){

        $datetime = date('Y:m:d H:i:s');

        if($request->last == 0){
            $messages = Message::all();
        }
        else{
            $messages = Message::where('created_at', '>=', $request->last)->get();
        }

        return MessageResource::collection($messages)
            ->additional([
                'timestamp' => $datetime,
            ]);
    }



    //--------CHAT ROOMS--------//

    /**
     * @param Request $request
     */
    public function createRoom(Request $request){
        $chatRoom = new ChatRoom(['chat_name' => $request->chatName]);
        $chatRoom->save();

        for ($i=0; $i<count($request->checkedUsers); $i++){
            $chatRoomUser = new ChatRoomsUser();
            $chatRoomUser->chat_id = $chatRoom->id;
            $chatRoomUser->user_email = $request->checkedUsers[$i];
            $chatRoomUser->save();
        }
    }


    /**
     * @return JsonResponse
     */
    public function getChatRooms(){
        $chatRooms = ChatRoomsUser::where('user_email', Auth::user()->email)->with('chats')->get();
        $chatNames = [];
        for ($i=0; $i<count($chatRooms); $i++){
            $chatNames[$i] = [
                'chat_id' => $chatRooms[$i]->chats['id'],
                'chat_name' => $chatRooms[$i]->chats['chat_name']
            ];
        }

        return response()->json($chatNames);
    }


    /**
     * @param $id
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function getRoomMessages($id, Request $request){

        $datetime = date('Y:m:d H:i:s');

        if($request->last == 0){
            $messages = RoomMessage::where('chat_id', $id)->get();
        }
        else{
            $messages = RoomMessage::where('created_at', '>=', $request->last)->where('chat_id', $id)->get();
        }

        return MessageResource::collection($messages)
            ->additional([
                'timestamp' => $datetime,
            ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function sendRoomMessage(Request $request){
        $data = $request->data;

        $message = new RoomMessage([
            'chat_id' => $data['chat_id'],
            'user_id' => $data['user_id'],
            'user_email' => $data['user_email'],
            'user_name' => $data['user_name'],
            'message_text' => $data['message_text'],
            'message_time' => $data['message_time'],
        ]);
        $message->save();

        return response()->json($data);
    }
}
