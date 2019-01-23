<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\FoodItem;
use App\Category;

class FoodItemController extends Controller
{
    private $path = 'dashboard.pages.food_items.';

    public function __construct(){
        $this->middleware(['auth','isKitchenStaff']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $food_items = FoodItem::all();
        return view($this->path.'index',compact('food_items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all(); 
        return view($this->path.'addEdit',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|min:3|max:50|unique:food_items',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'categories' => 'required'
        ]);
        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description
        ];
        $food_item = FoodItem::create($data);

        $categories = $request['categories']; //Retrieving the categories field
    //Checking if a category was selected
        if (isset($categories)) {
            foreach ($categories as $category) {
            $category_r = Category::where('id', '=', $category)->firstOrFail();            
            $food_item->categories()->attach($category_r); //Assigning category to item
            }
        } 

        Toastr::success('Food Item created successfully.','success');
        return redirect()->route('admin.foodItem.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = FoodItem::findOrFail($id);
        if($item->status){
            $item->status = 0;
        }else{
            $item->status = 1;
        }
        
        $item->update();
        Toastr::success('Food Item status updated.','Success');
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
        $categories = Category::all(); 
        $food_item = FoodItem::findOrFail($id);
        return view($this->path.'addEdit',compact('categories','food_item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = FoodItem::findOrFail($id);
        $this->validate($request,[
            'name' => 'required|string|min:3|max:50|unique:food_items',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'categories' => 'required'
        ]);
        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description
        ];
        $item->update($data);

        $categories = $request['categories']; //Retrieving the categories field
    //Checking if a category was selected
        if (isset($categories)) {            
            $item->categories()->sync($categories); //Assigning category to item         
        }else{
            $item->categories()->detach();
        }

        Toastr::success('Food Item updated successfully.','success');
        return redirect()->route('admin.foodItem.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = FoodItem::findOrFail($id);
        $item->delete();
        Toastr::success('Food Item deleted successfully.','success');
        return back();

    }
}
