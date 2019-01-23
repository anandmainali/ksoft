<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\User;
use Auth;
use File;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Role;

class UserController extends Controller
{
    private $imagePath = 'dashboard/images/UserImages';
    private $path = 'dashboard.pages.users.';

    public function __construct(){
        $this->middleware(['auth','isAdmin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $users = User::where('id','<>',auth()->id())->get();        
        return view($this->path.'index',compact('users'));
    }

    /**
     * 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('id','<>','2')->get();
        return view($this->path.'addEdit',compact('roles'));
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
            'name' => 'required|min:3|max:30',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:30|confirmed',
            'image' => 'image|max:1000',
            'status' => '',
            'roles' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),            
        ];

        //Inserting user image
        if(!empty($file = $request->file('image'))){
            $name = time() . $file->getClientOriginalName();
            $file->move($this->imagePath,$name);
            $data['image'] = $name;
        }else{
            $data['image'] = 'default.png';
        }
        
        //Setting User status as per checkbox
        if($request['status'] == 'on'){
            $data['status'] = 1;
        }else{            
        $data['status'] = 0;
        }

        $user = User::create($data);

        $roles = $request['roles']; //Retrieving the roles field
    //Checking if a role was selected
        if (isset($roles)) {
            foreach ($roles as $role) {
            $role_r = Role::where('id', '=', $role)->firstOrFail();            
            $user->roles()->attach($role_r); //Assigning role to user
            }
        } 

        //Redirect to the users.index view and display message
        Toastr::success('User successfully added.','Success');
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        if($user->status){
            $user->status = 0;
        }else{
            $user->status = 1;
        }
        
        $user->update();
        Toastr::success('User status updated.','Success');
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
        $roles = Role::where('id','<>','2')->get();
        $user = User::findOrFail($id);  

        return view($this->path.'addEdit',compact('user','roles'));
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
        $user = User::findOrFail($id);
        
        $this->validate($request,[
            'name' => 'required|min:3|max:30',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => $request->password != null ? 'sometimes|required|min:5|max:30|confirmed' : '',
            'image' => 'image|max:1000',
            'status' => '',
            'roles' => 'required'
        ]);        
            
        $data = [
            'name' => $request->name,
            'email' => $request->email,            
        ];

        //Setting User status as per checkbox
        if($request['status'] == 'on'){
            $data['status'] = 1;
        }else{            
            $data['status'] = 0;
        }

        //Check password and update
        if($request['password'] !== null){
            $data['password'] = Hash::make($request['password']);
        }

        //Updating user image
        if(!empty($file = $request->file('image'))){
            $name = time() . $file->getClientOriginalName();
            $file->move($this->imagePath,$name);
            //Delete Image 
            if($user->image !== '/dashboard/images/UserImages/default.png' && file_exists(public_path().$user->image)){
                File::delete(public_path().$user->image);         
            }
            $data['image'] = $name;
        }      
        
        $roles = $request['roles']; //Retreive all roles

        $user->update($data);

        if (isset($roles)) {        
            $user->roles()->sync($roles);  //If one or more role is selected associate user to roles          
        }        
        else {
            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }


        Toastr::success('User Successfully Updated :)','Success');  
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        //Find a user with a given id and delete
        $user = User::findOrFail($id);

        if($user->id === 1){
            Toastr::warning('Cannot delete this user! ','Warning');  
            return back();
        }

        if($user->image !== '/dashboard/images/UserImages/default.png' && file_exists(public_path().$user->image)){
            File::delete(public_path().$user->image);         
        }
        $user->delete();

        Toastr::success('User Successfully Deleted :)','Success');  
        return back();
    }
    }
