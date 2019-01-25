<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\ItemOrder;
use App\User;
use App\Date;
use App\FoodItem;
use App\Category;
use Carbon\Carbon;
use App\CompanyPrivateEmail;

class HomeController extends Controller
{
    private $path = 'dashboard.pages.orders.';
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
        $users = User::all()->count();
        $emails = CompanyPrivateEmail::all()->count();
        $menu_history = Date::all()->count();
        $food_items = FoodItem::all()->count();
        $categories = Category::all()->count();
        $orders = Order::where('date','=',Carbon::now()->toDateString())->count();
        $order_history = Order::all()->count();
        return view('dashboard.pages.home',compact('users','emails','menu_history','food_items','categories','orders','order_history'));
    }

    public function ordersHistory(){
        $orders = Order::all();

        foreach($orders as $order){
        $users[] = User::where('id','=',$order->user_id)->get();
        
        }
        if(!empty($users)){
            $users = array_unique($users);
        }else{
            $users = [];
        }
                
        return view($this->path.'orderHistory',compact('users'));
    } 

    public function ordersHistoryItems($id){
        $orders = Order::where('user_id',$id)->get();
        
        foreach($orders as $order){        
           $orderedItems[] = ItemOrder::where('order_id',$order->id)->get();
        }
        if(!empty($orderedItems)){
       $orderedItems = array_collapse($orderedItems); 
        }else{
            $orderedItems = [];
        } 
        return view($this->path.'orderHistoryItems',compact('orderedItems'));
    }

    public function allOrders(){
        $orders = Order::where('user_id',auth()->user()->id)->get();

        foreach($orders as $order){        
            $orderedItems[] = ItemOrder::where('order_id',$order->id)->get();
         }
         if(!empty($orderedItems)){
         $orderedItems = array_collapse($orderedItems);
         }else{
            $orderedItems = [];
         } 
        return view($this->path.'allOrders',compact('orderedItems'));
    }
}
