<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('settings.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        return redirect()->route('settings.profile')->with('success', 'Profile updated successfully.');
    }

    public function security()
    {
        return view('settings.security');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = Auth::user();

        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('settings.security')->with('success', 'Password updated successfully.');
    }

    public function system()
    {
        $this->authorize('admin');
        
        // Get system settings (you can store these in a settings table or config)
        $settings = [
            'app_name' => config('app.name', 'Boda Stage Registration'),
            'timezone' => config('app.timezone', 'UTC'),
            'registration_approval' => true, // Example setting
        ];

        return view('settings.system', compact('settings'));
    }

    public function updateSystem(Request $request)
    {
        $this->authorize('admin');

        $validated = $request->validate([
            'app_name' => 'required|string|max:255',
            'timezone' => 'required|string',
        ]);

        // Here you would typically save to a settings table or update config
        // For now, we'll just redirect with success

        return redirect()->route('settings.system')->with('success', 'System settings updated successfully.');
    }
}
