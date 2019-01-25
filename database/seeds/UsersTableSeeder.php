<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
                'role_id' => 1,
                'created_at' => Carbon::now()
            ]
            ];
        
        DB::table('users')->insert($users);

    }
}
