<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Notifications;
class NotificationController extends Controller
{
    public function get()
    {
        $notifications = Notifications::OrderBy('id','desc')->get();
        return response()->json(["success" => true,"data" => $notfications,"error_code" => 200]);

    }
}
