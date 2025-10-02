<?php

namespace App\Http\Controllers\Back;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\BackStoreUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            // new Middleware('permission:Add_User,admin', only: ['store']),
            new Middleware('permission:Edit_User,admin', only: ['update']),
            new Middleware('permission:Delete_User,admin', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(config('app.paginate_limit'));
        return view('back.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BackStoreUserRequest $request)
    {
        Gate::forUser(Auth::guard('admin')->user())->authorize('create');

        $data = $request->validated();
        $data['email_verified_at'] = $request->input('status') == 1 ? now() : null;
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return redirect()->back()->with('status', 'User Add Successfully');
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:256|min:3',
            'email' => 'required|email|max:256|unique:users,email,' . $id,
            'status' => 'required|in:0,1'
        ]);
        $data['email_verified_at'] = $request->input('status') == 1 ? now() : null;
        if ($request->filled('password')) {
            $data = $request->validate(['password' => ['string', 'confirmed', Password::default()]]);
            $data['password'] = Hash::make($data['password']);
        }
        $user = User::findOrFail($id);
        $user->update($data);
        return redirect()->back()->with('status', 'User Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->delete();
        return to_route('back.users.index')->with('status', 'User Delete Successfully');
    }
}
