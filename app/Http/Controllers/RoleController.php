<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Roles\AddRoleRequest;
use App\Http\Requests\Roles\UpdateRoleRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        try {
            $roles = Role::all();
            $permissions = Permission::all();
            return view('backend.user.role', compact('roles', 'permissions'));
        } catch (\Throwable $th) {
             
        }
    }

    public function storeRole(AddRoleRequest $request)
    {
        try {
            $role = Role::create([
                'name' => $request->name,
                'guard_name' => 'web',
            ]);
            if ($request->permissions) {
                foreach($request->permissions as $permission) {
                    $role->givePermissionTo($permission);
                }
            }
            return back()->with('successt', 'Thêm vai trò thành công');
        } catch (\Throwable $th) {
            return back()->with('error', 'Thêm vai trò thất bại');
        }
    }

    public function destroyRole($id)
    {
        try {
            $role = Role::find($id);
            $role->delete();

            return back()->with('successX', 'Xóa vai trò thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('errorx', 'Không tìm thấy vai trò này');
        }
    }

    public function delete(Request $request)
    {
        foreach($request->id as $id)
        {
            $role = Role::find($id);
            $role->delete();
        }
        return response()->json('Thành công',200);
    }

    public function updateRole (UpdateRoleRequest $request, $id)
    {
        try {
            $permissions = Permission::all();
            $role = Role::find($id);
            $role->name = $request->name;
            $role->save();
            foreach ($permissions as $revokePermission) {
                $role->revokePermissionTo($revokePermission->name);
            }
            if ($request->permissions) {
                foreach($request->permissions as $permission) {
                    $role->givePermissionTo($permission);
                }
            }

            return back()->with('successsua', 'Cập nhật vai trò thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Không tìm thấy vai trò này');
        }
    }
}
