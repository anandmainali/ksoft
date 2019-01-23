<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Brian2694\Toastr\Facades\Toastr;

class CategoryController extends Controller
{
    private $path = 'dashboard.pages.categories.';

    public function __construct() {
        $this->middleware(['auth','isKitchenStaff']); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all(); 
        return view($this->path.'index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|string|min:3|max:30|unique:categories',
        ]);

        $category = new Category();
        $category->name = $request['name'];

        $category->save();
        Toastr::success('Category '. $category->name.' added!','Success');  

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $category = Category::findOrFail($id);

        return view($this->path.'index',compact('categories','category'));
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
        $category = Category::findOrFail($id);
        $this->validate($request, [
            'name'=>'required|string|min:3|max:30|unique:categories',
        ]);

        $category->name = $request['name'];

        $category->save();
        Toastr::success('Category '. $category->name.' updated!','Success');  

        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();
        Toastr::success('Category deleted!','Success');  

        return redirect()->route('admin.category.index');
    }
}
