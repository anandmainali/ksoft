<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use Auth;
use App\ItemOrder;
use Brian2694\Toastr\Facades\Toastr;
use App\Cart;
use Carbon\Carbon;
use App\Notifications\OrderReady;

class OrderController extends Controller
{
    private $path = 'dashboard.pages.orders.';

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('date','=',Carbon::now()->toDateString())->get();
        
        return view($this->path.'todayOrders',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Session::has('cart')){
            return view($this->path.'cartItems');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        $data = [
            'user_id' => Auth::user()->id,
            'totalPrice' => $cart->totalPrice,
            'date' => Carbon::now()->toDateString()
        ];
        $order = Order::create($data);

        foreach($cart->items as $item){
            
            $orders = [
                'order_id' => $order->id,
                'food_item_id' => $item['item']['id'],
                'quantity' => $item['qty']
            ];
           ItemOrder::create($orders);
        }
        Session::forget('cart');
        
        Toastr::success('Order successfully made.','Success');
        return redirect()->route('admin');
    }

    /**
     * Updates the status of order //Order made or not. 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);

        if($order->status){
            $order->status = 0;
        }else{
            $order->status = 1;
            $user = User::find($order->user_id);
            $user->notify(new OrderReady());
        }
        
        $order->update();
        Toastr::success('Order status updated.','Success');
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    
}
