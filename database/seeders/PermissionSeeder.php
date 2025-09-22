<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'Add_User',
            'Edit_User',
            'Show_User',
            'Delete_User',
        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name'          => $permission,
                'guard_name'    => 'admin'
            ]);
        }
    }
}
