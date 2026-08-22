<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('admin.profile.edit', [
            'user' => $request->user('admin'),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        /** @var Admin $admin */
        $admin = $request->user('admin');

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique('admin', 'email')->ignore($admin->id),
            ],
            'mobile' => ['required', 'string', 'max:30'],
        ]);

        $admin->update($validated);

        return redirect()->route('admin.profile.edit')->with('status', 'profile-updated');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        /** @var Admin $admin */
        $admin = $request->user('admin');

        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'string'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        if (! Hash::check($validated['current_password'], $admin->password)) {
            return back()->withErrors([
                'current_password' => 'The current password is incorrect.',
            ], 'updatePassword');
        }

        $admin->update(['password' => $validated['password']]);

        return back()->with('status', 'password-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        /** @var Admin $admin */
        $admin = $request->user('admin');

        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'string'],
        ]);

        if (! Hash::check($request->string('password')->toString(), $admin->password)) {
            return back()->withErrors([
                'password' => 'The password is incorrect.',
            ], 'userDeletion');
        }

        Auth::guard('admin')->logout();
        $admin->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
