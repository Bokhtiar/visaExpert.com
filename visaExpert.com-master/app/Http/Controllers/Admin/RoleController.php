<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', Role::class);

        return view('backend.user.roles.index', [
            'roles' => Role::getAllRoles(),
        ]);
    } 

    public function create(): View
    {
        $this->authorize('create', Role::class);
        $modules = Module::getWithPermissions();

        return view('backend.user.roles.form', compact('modules'));
    }

    public function store(Request $request): RedirectResponse
    {
        $role = Role::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        logActivity(
            (Auth::user()->name.' created a new role.'),
            $role->id,
            'created',
            'roles'
        );

        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('admin.roles.index')->with('success', "Role id $role->id Successfully Added.");
    }

    public function edit(Role $role): View
    {
        $this->authorize('update', $role);
        $modules = Module::all();
        $role = $role->load('permissions');

        return view('backend.user.roles.form', compact('role', 'modules'));
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        $this->authorize('update', $role);
        $role->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        $role->permissions()->sync($request->input('permissions', []));

        logActivity( 
            (Auth::user()->name.' updated a role.'),
            $role->id,
            'updated',
            'roles'
        );

        return redirect()->route('admin.roles.index')->with('success', 'Role Successfully Updated.');
    }

    public function destroy(Role $role): RedirectResponse
    {
        $this->authorize('delete', $role);
        if ($role->deletable) {

            $role->delete();

            logActivity(
                (Auth::user()->name.' deleted a role.'),
                $role->id,
                'deleted',
                'roles'
            );

            return back()->with('success', 'Role Successfully Deleted');
        } else {
            return back()->with('error', "You can\'t delete system role.");
        }
    }
}
