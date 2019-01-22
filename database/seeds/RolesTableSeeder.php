<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id' => 1,
                'name' => 'Admin',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'name' => 'Employee',
                'created_at' => Carbon::now()
            ],
            [
                'id' => 3,
                'name' => 'Kitchen Staff',
                'created_at' => Carbon::now()
            ]
            ];
        //create roles
        DB::table('roles')->insert($roles);
    }
}
