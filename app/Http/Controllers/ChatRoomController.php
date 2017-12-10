<?php

namespace App\Http\Controllers;

use App\ChatworkApi;
use Illuminate\Http\Request;

class ChatRoomController extends Controller
{
    public function showadd(Request $request)
    {
        $token = $this->getToken($request);
        $roomList = ChatworkApi::getRooms($token);

        return view('rooms',[
            'token' => $token,
            'roomList' => $roomList,
        ]);
    }

    public function add(Request $request)
    {
        $token = $this->getToken($request);
        $rooms = $request->rooms;
        $account_id = $request->account_id;
        $role = $request->role;

        ChatworkApi::addMenber($rooms, $token, $account_id, $role);

        return redirect()->route('chatroom.showadd');
    }
}
