<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class roles_and_permissions_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'admin']);
        $client = Role::create(['name' => 'cliente']);
        $prof_free = Role::create(['name' => 'profesor']);
        $prof_premium = Role::create(['name' => 'profesor-premium']);
    }
}
