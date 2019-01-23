<?php

namespace App\Http\Controllers;
use App\FoodItem;
use Illuminate\Http\Request;
use App\Date;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use Session;
use App\Cart;

class TodayMenuController extends Controller
{
    private $path = 'dashboard.pages.today_menu.';

    public function __construct(){
        $this->middleware('auth');
    }
    //Gets items to set for today menu
    public function getActiveItems(){
       $food_items = FoodItem::where('status',true)->get();
       return view($this->path.'setTodayMenu',compact('food_items'));
    }

    //Sets items for today menu
    public function setTodayMenu(Request $request)
    {
        $this->validate($request,[
            'food_items' => 'required',
            'date' => 'unique:dates'
        ]);
        $data['date'] = $request['date'];
        $date = Date::create($data);
        $food_items = $request->food_items;

        if (isset($food_items)) {
            foreach($food_items as $menu_item) { 
                $menu_item_r = FoodItem::where('id','=',$menu_item)->firstOrFail();
                $date->food_items()->attach($menu_item_r);
            }
        }
        Toastr::success('Today Menu is set succesfully.','Success');
        return redirect()->route('admin.foodItem.index'); 
    }

    public function viewTodayMenu()
    {
        $todayDate = Carbon::now()->toDateString();
         $date = Date::where('date','=',$todayDate)->firstOrFail();
         $food_items = $date->food_items;
        //  foreach($food_items as $item){
        //      dd($item->id);
        //  }
        return view($this->path.'todayMenu',compact('food_items'));
    }

    //Cart

    public function getAddToCart(Request $request, $id)
    {
        dd('hello');
        $item = FoodItem::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($item,$item->id);

        $request->session()->put('cart', $cart);
       // dd($request->session()->get('cart'));
        return back();
    }
}

