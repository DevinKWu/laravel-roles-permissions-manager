<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(config('permission.seed') as $role=>$permissions){
            $role = Role::create(['name' => $role]);
            foreach($permissions as $permission){
                Permission::create(['name' => $permission]);
            $role->givePermissionTo($permission);
            }
        }
    }
}
