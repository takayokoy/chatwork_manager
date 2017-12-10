<?php

namespace App\Http\Controllers;

use App\ChatworkApiInfo;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function post(Request $request)
    {
        $token = $request->token;

        $model = ChatworkApiInfo::getChatworkApiInfoByUserId($request->user()->id);
        $model->token = $token;
        $model->save();

        $this->setToken($token);

        return view('home',[
            'token' => $token,
            'message' => 'トークンを設定しました!',
        ]);
    }
}
