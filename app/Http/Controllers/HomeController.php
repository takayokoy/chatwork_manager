<?php

namespace App\Http\Controllers;

use App\ChatworkApi;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

   public function index(Request $request)
   {
       $token = $this->getToken($request);
       $myInfoList = ChatworkApi::getMyInfo($token);

       return view('home',[
           'token' => $token,
           'myInfoList' => $myInfoList,
           ]);
   }
}
