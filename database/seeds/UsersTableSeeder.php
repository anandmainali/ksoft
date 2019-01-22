<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id' => 1,
                'name'  => 'Administrator',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'status' => 1,                
                'image' => 'default.png',
                'created_at' => Carbon::now()
            ]
            ];
        
        DB::table('users')->insert($users);
        $user = User::findOrFail(1);
        $user->roles()->attach(1);

    }
}
