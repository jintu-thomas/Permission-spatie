<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'blog-read',
            'blog-edit',
            'blog-create',
            'blog-delete',
            'user-create',
            'assign-permission'
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
       }
    }
}
