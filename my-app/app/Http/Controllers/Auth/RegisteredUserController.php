<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
       $request->validate([
    'fullname' => ['required', 'string', 'max:255'],
    'email' => [
        'required',
        'string',
        'email',
        'max:255',
        'unique:users,email', // makes email unique
    ],
    'password' => [
        'required',
        'confirmed',           // checks password_confirmation
        'min:7',               // minimum 7 characters
        'regex:/[A-Z]/',       // at least one uppercase letter
        'regex:/[a-z]/',       // at least one lowercase letter
        // optional: 'regex:/[0-9]/' // at least one number
        // optional: 'regex:/[@$!%*#?&]/' // at least one special character
    ],
]);

    $user = User::create([
    'fullname' => $request->fullname,
    'email' => $request->email,
    'password' => Hash::make($request->password),
    'role' => 'customer',
]);


      Auth::login($user);

        // ✅ Redirect by role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'seller') {
            return redirect()->route('seller.dashboard');
        } else {
            return redirect()->route('customer.home');
        }
    }
}
