<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Cart;
use App\FoodItem;
use App\Date;
use Carbon\Carbon;

class CartController extends Controller
{
    private $path = 'dashboard.pages.today_menu.';

    public function __construct(){
        $this->middleware(['auth','isEmployee']);
    }

    public function getAddToCart(Request $request, $id)
    {
        $item = FoodItem::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($item,$item->id);

        $request->session()->put('cart', $cart);
        return back();
    }

    public function getCartItems()
    {
        if(!Session::has('cart')){
            return view($this->path.'cartItems');
        }
        
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        if(Carbon::now('GMT+5:45')->toTimeString() >= Carbon::createFromTime(13, 0)->toTimeString()){
            Session::forget('cart');
        }        
        return view($this->path.'cartItems',['items'=>$cart->items,'totalPrice'=> $cart->totalPrice]);
    }

    public function getReduceByOne($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return back();
    }
    public function getRemoveItem($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return back();
    }
}
