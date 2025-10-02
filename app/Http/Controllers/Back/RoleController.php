<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::where('guard_name', '=', 'admin')->get();
        $roles = Role::where('guard_name', '=', 'admin')
            ->paginate(config('app.paginate_limit'));
        return view('back.roles.index', compact(['roles', 'permissions']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleStoreRequest $request)
    {
        $data = $request->validated();
        $role = Role::create(['name' => $data['name'], 'guard_name' => 'admin']);
        $role->givePermissionTo($data['permissions']);
        return redirect()->back()->with('status', 'Role Add Succefully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUpdateRequest $request, string $id)
    {
        $data = $request->validated();
        $role = Role::findOrFail($id);
        $role->update(['name' => $data['name']]);
        $role->syncPermissions($data['permissions']);
        return redirect()->back()->with('status', 'Role Edit Succefully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::findOrFail($id)->delete();
        return redirect()->back()->with('status', 'Role Deleted Succefully');
    }
}
