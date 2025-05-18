<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    /**
     * Display the registration form.
     */
    public function index()
    {
        return view('be.register', [
            'title' => 'Register'
        ]);
    }

    /**
     * Handle registration process.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // User validation
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed',
            
            // Pelanggan validation
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|max:5120',
        ]);

        try {
            // Create new user with 'pelanggan' level
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'level' => 'pelanggan',
            ]);

            // Handle photo upload
            $fotoPath = null;
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('pelanggan_fotos', 'public');
            }

            // Create related pelanggan data
            Pelanggan::create([
                'nama_lengkap' => $validated['name'],
                'no_hp' => $validated['no_hp'],
                'alamat' => $validated['alamat'],
                'foto' => $fotoPath,
                'id_user' => $user->id,
            ]);

            // Login user after registration
            Auth::login($user);

            // Redirect ke halaman utama FE
            return redirect('/')->with('success', 'Registration successful!');

        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Registration failed. Please try again.']);
        }
    }
}