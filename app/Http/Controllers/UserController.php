<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Users\AddRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\model_has_role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function Form_add_user()
    {
        // $role = Role::where('name', '!=', 'Super_admin')->get();
        $role=Role::all();
        return view('backend.user.form_user', compact('role'));
    }

    public function storeUser(AddRequest $request)
    {
        $image = config('user.img');
        if ($request->hasFile('profile_photo_path')) {
            $file = $request->profile_photo_path;
            $filename = str::random(4) . "_" . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $image = $filename;
        }

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "profile_photo_path" => $image
        ]);
        foreach ($request->role_id as $role) {
            $user->assignRole($role);
        }

        return back()->with('success', 'Thêm quản trị viên thành công');
        try {
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Không tìm thấy vai trò');
        }
    }

    public function show_user()
    {
        try {
            // $role = Role::where('name', '!=', 'Super_admin')->get();
            $role=Role::all();
            $role_model = model_has_role::where('role_id', 1)->first();
            $users = User::where([['id', '!=', Auth::id()], ['id', '!=', $role_model->model_id]])->get();
            return view('backend.user.users', compact('users', 'role'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Không tìm thấy vai trò');
        }
    }

    public function destroyUser($id)
    {
        try {
            $user = User::find($id);
            $img = $user->profile_photo_path;
            if ($img == config('user.img')) {
                $user->delete();
            } else {
                $patholdfile = 'images/' . $img;
                File::delete($patholdfile);
                $user->delete();
            }
            return back()->with('successx', 'Xóa quản trị viên thành công');
        } catch (\Throwable $th) {
            return back()->with('error', 'Không tìm thấy vai trò');
        }
    }

    public  function destroy(Request $request)
    {
        foreach ($request->id as $id) {
            $user = User::find($id);
            $img = $user->profile_photo_path;
            if ($img == config('user.img')) {
                $user->delete();
            } else {
                $patholdfile = 'images/' . $img;
                File::delete($patholdfile);
                $user->delete();
            }
        }
        return response()->json("Thành công", 200);
    }

    public function updateUser(UpdateRequest $request, $id)
    {
        try {
            $user = User::find($id);
            $image = $user->profile_photo_path;
            if ($request->hasFile('profile_photo_path')) {
                $file = $request->profile_photo_path;
                $filename = str::random(4) . "_" . $file->getClientOriginalName();
                $patholdfile = 'images/' . $image;
                if ($image == config('user.img')) {
                    $file->move(public_path('images'), $filename);
                    $image = $filename;
                } else {
                    File::delete($patholdfile);
                    $file->move(public_path('images'), $filename);
                    $image = $filename;
                }
                // File::delete($patholdfile);
                // $file->move(public_path('images'), $filename);
                // $image = $filename;
            }
            $user->name  = $request->name;
            $user->email = $request->email;
            $user->profile_photo_path = $image;
            $user->save();
            $roles = Role::all();
            if ($request->role_id != null) {
                foreach ($roles as $role) {
                    $user->removeRole($role);
                }
                foreach ($request->role_id as $role) {
                    $user->assignRole($role);
                }
            } else {
                foreach ($roles as $role) {
                    $user->removeRole($role);
                }
            }
            return back()->with('successS', 'Sửa quản trị viên thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Không tìm thấy vai trò');
        }
    }
}
