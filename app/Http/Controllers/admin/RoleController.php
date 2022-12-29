<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function addShow(Request $request)
    {
        return view('admin/role/role-add');
    }

    public function addData(Request $request)
    {
        $arrper = $request->input('models');

        $role = Role::create(['name' => $request->input('name')]);

        if ($role->givePermissionTo($arrper)) {
            $request->session()->flash('success_msg', 'Role created successfully and added permissions');

            return redirect('admin/users/role');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');

            return redirect('admin/users/role/add');
        }
    }

    public function index()
    {
        $role = Role::paginate(20);

        return view('admin/role/role', [
            'roles' => $role,
        ]);
    }

    public function editShow(Request $request, Role $role)
    {
        //Gate::authorize('roleedit', $role->name);
        // dd($role->permissions);
        return view('admin/role/role-edit', [
            'role' => $role,
        ]);
    }

    public function editUpdate(Request $request, Role $role)
    {
        //Gate::authorize('roleedit', $role->name);

        $arrper = $request->input('models');

        if ($role->syncPermissions($arrper)) {
            $request->session()->flash('success_msg', 'Role updated successfully and updated permissions');

            return redirect('admin/users/role');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }

        return view('admin/role/role-edit', [
            'role' => $role,
        ]);
    }

    public function delete(Request $request, Role $role)
    {
        //Gate::authorize('roleedit', $role->name);

        if ($role->delete()) {
            $request->session()->flash('success_msg', 'Role deleted successfully and deleted permissions');

            return redirect('admin/users/role');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');

            return redirect('admin/users/role');
        }
    }

    public function show(Request $request, Role $role)
    {
        $per = $role->getAllPermissions();

        //dd($per);
        $totalp = DB::table('role_has_permissions')->where('role_id', '=', $role->id)->count();
        $totalu = DB::table('model_has_roles')->where('role_id', '=', $role->id)->count();

        return view('admin/role/role-view', [
            'role' => $role,
            'per' => $per,
            'totalper' => $totalp,
            'totalu' => $totalu,
        ]);
    }
}
