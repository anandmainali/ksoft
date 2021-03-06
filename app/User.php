<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Notifications\UserResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;

    protected $tables = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','image','status','role_id','company_private_email_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    

    //Set Image Path
    protected $location = '/dashboard/images/UserImages/';
    //Accessor
    public function getImageAttribute($image){
       return $this->location.$image;
    }    

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserResetPasswordNotification($token));
    }

    
    public function roles()
    {
        return $this->belongsTo('App\Role', 'role_id');
    }

}
