<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', User::class);
        $users = User::getAllUsers();

        return view('backend.user.index', compact('users'));
    }

    public function create(): View
    {
        $this->authorize('create', User::class);
        $roles = Role::getForSelect();

        return view('backend.user.form', compact('roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', User::class);
        $user = User::create([
            'role_id' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->filled('status'),
        ]);

        logActivity(
            (Auth::user()->name.' created a new user.'),
            $user->id,
            'created',
            'users'
        );

        return redirect()->route('admin.users.index')->with('success', 'User Successfully Added.');
    }

    public function edit(User $user): View
    {
        $this->authorize('edit', $user);
        $roles = Role::all();

        return view('backend.user.form', compact('roles', 'user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        //        $validatedData = $request->validate([
        //            'role' => 'required',
        //            'name' => 'required|string',
        //            'email' => 'required|email|unique:users,email,' . $user->id,
        //            'password' => 'nullable|min:6',
        //            'status' => ['required', Rule::in(UserStatus::collection())],
        //        ]);

        $this->authorize('update', $user);

        $user->update([
            'role_id' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'password' => isset($request->password) ? Hash::make($request->password) : $user->password,
            'status' => $request->filled('status'),
        ]);

        logActivity(
            (Auth::user()->name.' updated a user.'),
            $user->id,
            'updated',
            'users'
        );

        return redirect()->route('admin.users.index')->with('success', 'User Successfully Updated.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('delete', $user);
        $user->delete();

        logActivity(
            (Auth::user()->name.' deleted a user.'),
            $user->id,
            'deleted',
            'users'
        );

        return back()->with('success', 'User Successfully Deleted');
    }
}
