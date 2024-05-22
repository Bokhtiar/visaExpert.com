<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionUserController extends Controller
{


    public function store(Request $request)
    {
       try {
            $user = User::findOrFail($request->user_id);
            $user->permissions()->sync($request->input('permissions', []));

            logActivity(
                (Auth::user()->name . 'created a new user permission.'),
                $request->user_id,
                'created',
                'roles'
            );

            return redirect()->back()->with('success', "Successfully Added.");
       } catch (\Throwable $th) {
        dd($th->getMessage());
        throw $th;
       }
    }

    public function edit($id)
    {
        // $this->authorize('update', $role);
        // $modules = Module::all();
        // $role = $role->load('permissions');

        // return view('backend.user.roles.form', compact('role', 'modules'));
    }

    public function update(Request $request,  $id)
    {
        // $this->authorize('update', $role);
        // $role->update([
        //     'name' => $request->name,
        //     'slug' => Str::slug($request->name),
        // ]);
        // $role->permissions()->sync($request->input('permissions', []));

        // logActivity(
        //     (Auth::user()->name . ' updated a role.'),
        //     $role->id,
        //     'updated',
        //     'roles'
        // );

        // return redirect()->route('admin.roles.index')->with('success', 'Role Successfully Updated.');
    }

    public function destroy($id)
    {
       
    }
}
