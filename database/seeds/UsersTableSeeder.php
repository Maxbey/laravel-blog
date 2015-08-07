<?php

use App\User;
use Illuminate\Database\Seeder;
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
        DB::table('users')->delete();

        User::create([
            'login' => 'admin',
            'permission_id' => 1,
            'email' => 'admin_email@admin_email.com',
            'password' => bcrypt('secret')
        ]);
    }
}
