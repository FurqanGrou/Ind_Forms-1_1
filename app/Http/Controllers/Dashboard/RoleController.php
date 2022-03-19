<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:عرض-الادوار', ['only' => ['index']]);
        $this->middleware('permission:اضافة-الادوار', ['only' => ['create', 'store']]);
        $this->middleware('permission:تعديل-الادوار', ['only' => ['edit', 'update']]);
        $this->middleware('permission:حذف-الادوار', ['only' => ['destroy']]);

    }

    public function index(Request $request)
    {
        $roles = Role::orderBy('id','DESC')->paginate(5);

        return view('dashboard.roles.index', ['roles' => $roles]);
    }

    public function create()
    {
        $permissions = Permission::get();

        return view('dashboard.roles.create', ['permissions' => $permissions]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('dashboard.roles.index')->withSuccess('Role created successfully');
    }

    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        return view('dashboard.roles.show', ['role' => $role, 'rolePermissions' => $rolePermissions]);
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('dashboard.roles.edit', ['role' => $role, 'permission' => $permission, 'rolePermissions' => $rolePermissions]);
    }

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

        return redirect()->route('dashboard.roles.index')->withSuccess('Role updated successfully');
    }

    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();

        return redirect()->route('dashboard.roles.index')->withSuccess('Role deleted successfully');
    }
}
