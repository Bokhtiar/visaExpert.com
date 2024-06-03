<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transfer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $this->authorize('updateProfile', ProfileController::class);

        // Retrieve transfers where the authenticated user is the creator
        $createdTransfers = Transfer::where('created_by', Auth::id())->get();
        $receivedTransfers = Transfer::where('recive_id', Auth::id())->get();
        $transfers = $createdTransfers->merge($receivedTransfers);
        $transfers = $transfers->unique('id');
        return view('backend.user.profile.edit', [
            'user' => $request->user(),
            'transfers' => $transfers
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $this->authorize('updateProfile', ProfileController::class);
        $request->user()->fill($request->all());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        logActivity(
            (Auth::user()->name.' updated his/her profile information.'),
            $request->user()->id,
            'updated',
            'users'
        );

        return Redirect::route('admin.profile.edit')->with('success', 'Profile Updated Successfully!');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $this->authorize('updatePassword', ProfileController::class);
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        logActivity(
            (Auth::user()->name.' changed his/her password.'),
            $request->user()->id,
            'updated',
            'users'
        );

        return back()->with('success', 'Password Updated Successfully!');
    }
}
