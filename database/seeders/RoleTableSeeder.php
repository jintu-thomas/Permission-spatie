<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $roles = [
            'Super_Admin',
            'Sub_Admin',
            'Editor',
            'Reader'

        ];
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
       }
    }
}
