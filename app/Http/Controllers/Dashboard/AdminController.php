<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:عرض-المسؤولين', ['only' => ['index']]);
        $this->middleware('permission:اضافة-المسؤولين', ['only' => ['create', 'store']]);
        $this->middleware('permission:تعديل-المسؤولين', ['only' => ['edit', 'update']]);
        $this->middleware('permission:حذف-المسؤولين', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = Admin::orderBy('id', 'DESC')->paginate(5);

        return view('dashboard.admins.index', ['data' => $data]);
    }

    public function create()
    {
        $roles = Role::query()->select(['id', 'name'])->get();

        return view('dashboard.admins.create', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $admin = Admin::create($input);
        $admin->assignRole($request->input('roles'));

        return redirect()->route('dashboard.admins.index')->withSuccess('تمت اضافة المسؤول بنجاح');
    }

    public function show($id)
    {
        $admin = Admin::find($id);
        return view('dashboard.admins.show',compact('admin'));
    }

    public function edit($id)
    {
        $admin = Admin::find($id);
        $roles = Role::query()->select(['id', 'name'])->get();

        $adminRole = $admin->roles->pluck('id')->all();

        return view('dashboard.admins.edit',compact('admin','roles','adminRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input, ['password']);
        }

        $admin = Admin::find($id);
        $admin->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $admin->assignRole($request->input('roles'));

        return redirect()->route('dashboard.admins.index')
            ->with('success','Admin updated successfully');
    }

    public function destroy($id)
    {
        Admin::find($id)->delete();

        return redirect()->route('dashboard.admins.index')
            ->with('success','Admin deleted successfully');
    }

}
