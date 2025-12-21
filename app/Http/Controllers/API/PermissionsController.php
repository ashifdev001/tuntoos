<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsController extends BaseController
{
    public function getPermissions(Request $request)
    {
        try {
            $permissions = Permission::get();
            $data = [];
            foreach ($permissions as $key => $permission) {
                $data[$permission->permission_group][] = $permission;
            }
            return $this->sendResponse($data, 'Permission list');
        } catch (\Throwable $e) {
            return $this->sendError('Something went wrong!', $e);
        }
    }

    public function editRolePermissions(Request $request)
    {
        try {
            $roleData = Role::find($request->input('role_id'));
            $roles = [];
            $roles['role_name'] = $roleData->name;
            $roles['permissions'] = $roleData->permissions->pluck('id');
            $permissions = Permission::get();

            $data = [];
            foreach ($permissions as $key => $permission) {
                $data[$permission->permission_group][] = $permission;
            }
            
            $rolePermissions['permissions'] = $data;
            $rolePermissions['roles'] = $roles;

            return $this->sendResponse($rolePermissions, 'Permission list');
        } catch (\Throwable $e) {
            return $this->sendError('Something went wrong!', $e);
        }
    }

}
