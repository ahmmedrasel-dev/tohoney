<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use app\Models\User;

class RoleController extends Controller
{
    public function roles()
    {
        return view('backend.roles_management.roles', [
            'roles' => Role::all(),
            'permissions' =>Permission::all(),
        ]);
    }

    public function rolesStore(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:roles'],
        ]);
        $role = Role::create(['name' => $request->name]);

        $notification = array(
            'message' => 'Role Add Successfully.',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }

    public function permission()
    {
        return view('backend.roles_management.permission', [
            'permission' => Permission::latest()->simplePaginate(5),
        ]);
    }

    public function rolesAndPermit()
    {
        return view('backend.roles_management.role_as_permission', [
            'roles' => Role::all(),
            'permissions' =>Permission::all(),
        ]);
    }

    public function rolesAndPermitEdit()
    {
        return view('backend.roles_management.role_as_permit_edit', [
            'roles' => Role::all(),
            'permissions' =>Permission::all(),
        ]);
    }

    public function permissionStore(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Permission::create(['name' => $request->name]);

        $notification = array(
            'message' => 'Permission Add Successfully.',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    public function rollAsPermission(Request $request)
    {

        $request->validate([
            'role_id' => ['required'],
            'permission_name' => 'required',
        ]);

        $role = Role::findOrFail($request->role_id);
        $role->givePermissionTo($request->permission_name);

        $notification = array(
            'message' => 'Role Assign to Permission Successfully.',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }

    public function userRoles()
    {
        return view('backend.roles_management.user_roles', [
            'users' => User::all(),
            'roles' => Role::all(),
        ]);
    }

    public function userAssignRoles(Request $request)
    {
        $user = User::findOrFail($request->user_id );
        $user->syncRoles($request->permission_name);

        $notification = array(
            'message' => 'User assign Roles Successfully.',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }
}
