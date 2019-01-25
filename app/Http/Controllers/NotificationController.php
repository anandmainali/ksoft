<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class NotificationController extends Controller
{
    public function __construct(){
        $this->middleware(['auth','isEmployee']);
    }
    
    public function markAsRead(){
        $user = User::find(Auth::user()->id);
        $user->notifications()->delete();
        return back();
    }
}
