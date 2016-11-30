<?php
namespace App\Http\Controllers;

use Request;
use LRedis;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SocketController extends Controller {

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('socket');
    }

    public function writemessage()
    {
        return view('writemessage');
    }

    public function sendMessage(){
        $redis = LRedis::connection();
        $redis->publish('message', json_encode(['message' => Request::input('message')]));

        return redirect('writemessage');
    }
}
