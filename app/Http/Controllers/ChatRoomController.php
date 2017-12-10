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

    public function showdelete(Request $request)
    {
        $token = $this->getToken($request);
        $roomList = ChatworkApi::getRooms($token);

        return view('rooms_delete',[
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

        ChatworkApi::addMember($rooms, $token, $account_id, $role);

        return redirect()->route('chatroom.showadd');
    }

    public function delete(Request $request)
    {
        $token = $this->getToken($request);
        $rooms = $request->rooms;
        $account_id = $request->account_id;

        ChatworkApi::deleteMember($rooms, $token, $account_id);

        return redirect()->route('chatroom.showdelete');
    }
}
