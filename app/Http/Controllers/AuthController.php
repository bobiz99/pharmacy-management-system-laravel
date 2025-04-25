<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLoginForm() {
        return view('pages.auth.login');
    }

    public function doLogin(Request $request) {

        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error-msg', 'No user found');
        }

        if (!Hash::check($password, $user->password)) {
            return redirect()->back()->with('error-msg', 'Wrong password!');
        }

        Auth::login($user);

        Log::channel('activity')->info('Logged in', [
            'user_id' => auth()->id(),
            'timestamp' => now(),
        ]);

        return redirect()->route('dashboard');
    }

    public function showRegistrationForm() {
        return view('pages.auth.register');
    }

    public function doRegister(Request $request) {

        $request->validate([
            'first_name' => 'required|string|min:2|max:50',
            'last_name' => 'required|string|min:2|max:50',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:6',
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'required|date',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string',
            'JMBG' => 'required|string|min:13|max:13|unique:patients'
        ]);



        try {
            DB::beginTransaction();

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone_number' => $request->phone_number,
                'role_id' => 3
            ]);

            Patient::create([
                'user_id' => $user->id,
                'address' => $request->address,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'JMBG' => $request->JMBG
            ]);

            DB::commit();

            return redirect()->route('login')->with('success-msg', 'Successfully created account. Please login');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error-msg', $e->getMessage());
        }
    }

    public function logout() {
        Log::channel('activity')->info('Log out', [
            'user_id' => auth()->id(),
            'timestamp' => now(),
        ]);
        Auth::logout();
        return redirect()->route('home');
    }
}
