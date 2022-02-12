<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

 
class NotificationController extends Controller
{
    public function getNotifications($receiverId){
        $notifications = Notification::where('receiverId',$receiverId)
            ->where('isDeleted',0)->with('channel')->get();
        return response()->json([
            'data' => $notifications
        ],200);
    } 

    public function deleteNotification($notificationId){
        $notification = Notification::find($notificationId);
        $notification->isDeleted = 1;
        $notification->save();
        return response()->json([
            'message' => 'notification deleted'
        ],200);
    }

    public function getCount($receiverId){
        $notifications = Notification::where('receiverId',$receiverId)
            ->where('isDeleted',0)->with('channel')->count();
        return response()->json([
            'data' => $notifications
        ],200);
    }
}
