<?php

namespace App\Http\Controllers\Back;

use App\Models\Admin;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\BackStoreAdminRequest;
use App\Http\Requests\BackUpdateAdminRequest;

class AdminHomeController extends Controller
{



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::paginate(config('app.paginate_limit'));
        $roles = Role::where('guard_name', '=', 'admin')->get();
        return view('back.admins.index', compact('admins', 'roles'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(BackStoreAdminRequest $request)
    {
        $data = $request->validated();
        $data['email_verified_at'] = $request->input('status') == 1 ? now() : null;
        $data['password'] = Hash::make($data['password']);
        $admin = Admin::create($data);

        if ($request->filled('role')) {
            $admin->assignRole($data['role']);
        }

        return redirect()->back()->with('status', 'Admin Add Successfully');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(BackUpdateAdminRequest $request, string $id)
    {
        $data = $request->validated();
        $data['email_verified_at'] = $request->input('status') == 1 ? now() : null;

        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $admin = Admin::findOrFail($id);
        $admin->update($data);
        $request->filled('role') ? $admin->syncRoles($data['role']) : '';
        return redirect()->back()->with('status', 'Admin Edit Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::guard('admin')->id() === 1) {
            Admin::findOrFail($id)->delete();
            return to_route('back.admins.index')->with('status', 'Admin Deleted Successfully');
        }
        return abort(403);
    }
}
