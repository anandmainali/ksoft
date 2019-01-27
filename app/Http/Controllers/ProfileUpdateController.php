<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Brian2694\Toastr\Facades\Toastr;

class ProfileUpdateController extends Controller
{
    private $imagePath = 'dashboard/images/UserImages';

    public function __construct() {
        $this->middleware('auth');
    }

    public function updateUser(Request $request,$id){
        $user = User::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|min:3|max:30',
            'email' => 'required|email|unique:users,email,'.$id,
            'image' => 'image|max:1000',
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,           
        ];

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

            $user->update($data);
            Toastr::success('User Successfully Updated :)','Success');  
            return back();
    }

    public function updatePassword(Request $request,$id){
         $user = User::findOrFail($id);         
        $this->validate($request, [ 
            'oldPassword' => 'required',           
            'password' => 'required|min:5|max:30|confirmed',
        ]);
        $data = [
            'password' => Hash::make($request['password'])
        ];

       if(Hash::check($request->oldPassword, $user->password)){        
           $user->update($data);
       Toastr::success('Password Successfully Updated :)','Success');  
       return back();
    }else{        
        Toastr::error('The specified password does not match the old password :)','Error');  
         return back();
    } 
    }
}
