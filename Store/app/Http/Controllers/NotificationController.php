<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function fetchNotifications(Request $request)
    {
        // Retrieve unread notifications for the authenticated user
        $notifications = Auth::user()->unreadNotifications;

        // Mark notifications as read
        Auth::user()->unreadNotifications->markAsRead();

        // Return notifications as JSON
        return response()->json($notifications);
    }
}
