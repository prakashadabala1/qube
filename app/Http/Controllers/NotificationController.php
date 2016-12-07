<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Notifications;
class NotificationController extends Controller
{
    public function get()
    {
        $notifications = Notifications::OrderBy('id','desc')->get();
        return response()->json([$notifications,200]);
    }
}
