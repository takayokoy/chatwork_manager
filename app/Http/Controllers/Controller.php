<?php

namespace App\Http\Controllers;

use App\ChatworkApiInfo;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getToken(Request $request)
    {
        $token = $request->session()->get('api_token');

        if (empty($token)) {
            $model = ChatworkApiInfo::getChatworkApiInfoByUserId($request->user()->id);
            if (empty($model)) {
                ChatworkApiInfo::create([
                    'user_id' => $request->user()->id,
                    'token' => null,
                ]);
                return null;
            } else {
                $this->setToken($model->token);
                return $model->token;
            }
        } else {
            return $token;
        }
    }

    protected function setToken($token)
    {
        session(['api_token' => $token]);
    }
}
