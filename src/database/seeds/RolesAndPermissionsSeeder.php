<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayOfUserPermissionNames = [
            # Manage
            'Manage.Administration',
            'Manage.Communication',
            'Manage.Content',
            'Manage.See',
            '*',

            # Roles
            'Roles.Create',
            'Roles.Edit',
            'Roles.Delete',
            'Roles.See',

            # Permissions
            'Permissions.See',
            'Permissions.Create',
            'Permissions.Delete',

            # ApiKeys
            'Api.Create',
            'Api.Edit',
            'Api.Delete',
            'Api.See',

            # Contact
            'Contact.See',
            'Contact.Delete',

            # Alerts
            'Alerts.Create',
            'Alerts.Delete',
            'Alerts.See',

            # Files
            'File.Create',
            'File.Delete',
            'File.Edit',
            'File.See',

            # Projects
            'Project.Create',
            'Project.Delete',
            'Project.Edit',
            'Project.See'

        ];
        $permissions = collect($arrayOfUserPermissionNames)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'web'];
        });

        Permission::insert($permissions->toArray());

        # API Permissions
        $arrayOfApiPermissionNames = [
            #SourceQueryApi
            'SourceQuery',

            #WalrusAPI
            'WalrusFacts',

            #GitHub
            'GitHubWebhook'

        ];
        $apipermissions = collect($arrayOfApiPermissionNames)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'api'];
        });

        Permission::insert($apipermissions->toArray());

        #Create Default Roles
        if(!Role::where('name','Owner')->first()){
            Role::create(['name' => 'Owner'])->givePermissionTo(['*']);
            echo "\nSeeded Owner Role\n";
        }
        if(!Role::where('name','User')->first()){
            Role::create(['name' => 'User']);
            echo "\nSeeded User Role\n";
        }

    }
}
