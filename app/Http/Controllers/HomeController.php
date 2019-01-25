<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\ItemOrder;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('auth.login');
    }

    public function ordersHistory(){
        $orders = Order::all();

        foreach($orders as $order){
        $users[] = User::where('id','=',$order->user_id)->get();
        
        }
        $users = array_unique($users);        
        return view('dashboard.pages.orders.orderHistory',compact('users'));
    } 

    public function ordersHistoryItems($id){
        $orders = Order::where('user_id',$id)->get();
        
        foreach($orders as $order){        
           $orderedItems[] = ItemOrder::where('order_id',$order->id)->get();
        }
       $orderedItems = array_collapse($orderedItems); 
        return view('dashboard.pages.orders.orderHistoryItems',compact('orderedItems'));
    }
}
