<?php

use App\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->delete();

        Permission::create([
            'group_name' => 'admin'
        ]);

        Permission::create([
            'group_name' => 'user'
        ]);
    }
}
