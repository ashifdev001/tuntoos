<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends BaseController
{
    function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    
    public function getUserRoles(Request $request)
    {
        try {
            $per_page=10;
            if($request->has('per_page')) $per_page=$request->per_page;

            $roles = Role::orderBy('id','DESC')->paginate($per_page);

            foreach ($roles as $key => &$role) {
                $role['action'] = '<a class="btn btn-primary" href="'. url('edit-roles/'.$role->id.'').'">Edit</a>
                    <button type="submit" data-delete-role="'. $role->id .'" class="btn btn-danger">Delete</button>';
            }
            return $this->sendResponse($roles, 'User roles.');
        } catch (\Throwable $e) {
            return $this->sendError('Something went wrong!', $e);
        }
    }

    public function getUserRolesList(Request $request)
    {
        try {
            $roles = Role::orderBy('id','DESC')->get();
            return $this->sendResponse($roles, 'User roles.');
        } catch (\Throwable $e) {
            return $this->sendError('Something went wrong!', $e);
        }
    }

    public function createNewUserRoles(Request $request)
    { 
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:roles,name',
                'permission' => 'required',
            ]);
            
            if ($validator->fails()) {
                return $this->sendError($validator->errors()->first(), $validator->errors());
            }
            
            $role = Role::create(['name' => $request->input('name')]);
            $role->syncPermissions(explode(",", $request->input('permission')));
            return $this->sendResponse([], 'Role created successfully');
        } catch (\Throwable $e) {
            return $this->sendError('Something went wrong!', $e);
        }
    }
    
    public function getRoleAndPermissions($id)
    {
        try {
            $role = Role::find($id);
            $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();

            return $this->sendResponse(['role' => $role, 'permissions' => $rolePermissions], 'Role and permissions');
        } catch (\Throwable $e) {
            return $this->sendError('Something went wrong!', $e);
        }
        
    }
    
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
    
        
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
    
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
    
        $role->syncPermissions($request->input('permission'));
    
        // return redirect()->route('roles.index')->with('success','Role updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        // return redirect()->route('roles.index')->with('success','Role deleted successfully');
    }
}
