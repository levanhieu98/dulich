<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Permissions\AddPermissionRequest;
use App\Http\Requests\Permissions\UpdatePermissionRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        try {
            $permissions = Permission::all();
            return view('backend.user.permission', compact('permissions'));
        } catch (\Throwable $th) {
             
        }
    }

    public function storePermission(AddPermissionRequest $request)
    {
        try {
            $permission = Permission::create([
                'name' => $request->name,
                'guard_name' => 'web',
            ]);
           
            return back()->with('success', 'Thêm quyền thành công');
        } catch (\Throwable $th) {
            return back()->with('error', 'Thêm quyền thất bại');
        }
    }

    public function destroyPermission($id)
    {
        try {
            $permission = Permission::find($id);
            $permission->delete();

            return back()->with('success', 'Xóa quyền thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Không tìm thấy quyền này');
        }
    }

    public function updatePermission (UpdatePermissionRequest $request, $id)
    {
        try {
            $permission = Permission::find($id);
            $permission->name = $request->name;
            $permission->save();

            return back()->with('success', 'Cập nhật quyền thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Không tìm thấy quyền này');
        }
    }
}
