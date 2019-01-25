<?php

namespace App\Http\Controllers;
use App\FoodItem;
use Illuminate\Http\Request;
use App\Date;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;

class TodayMenuController extends Controller
{
    private $path = 'dashboard.pages.today_menu.';

    public function __construct(){
        $this->middleware('auth');        
    }
    //Gets items to set for today menu
    public function getActiveItems(){
       $food_items = FoodItem::where('status',true)->get();
       $todayDate = Carbon::now()->toDateString();
       $date = Date::where('date','=',$todayDate)->first();
       return view($this->path.'setTodayMenu',compact('food_items','date'));
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
         $date = Date::where('date','=',$todayDate)->first();
         if($date){
            $food_items = $date->food_items;            
         }else{
            $food_items = [];
         }         
         
        return view($this->path.'todayMenu',compact('food_items'));
    }

    public function menusHistory(){
        $dates = Date::orderBy('id','DESC')->get(); 
             
        return view('dashboard.pages.history.menuHistory',compact('dates'));
    }

}

