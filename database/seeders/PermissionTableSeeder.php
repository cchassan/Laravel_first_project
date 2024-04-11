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
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'location-list',
            'location-create',
            'location-edit',
            'location-delete',
            'material-record-Entry-list',
            'material-record-Entry-create',
            'material-record-Entry-edit',
            'material-record-Entry-delete',
            'material-receiving-list',
            'material-receiving-create',
            'material-receiving-edit',
            'material-receiving-delete',
            'goods-receiving-list',
            'goods-receiving-create',
            'goods-receiving-edit',
            'goods-receiving-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
