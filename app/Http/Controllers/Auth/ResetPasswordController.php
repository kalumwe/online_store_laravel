<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function reset()
    {
        $viewData = [];
        $viewData["title"] = "Reset Password - Online Store";
        $viewData["subtitle"] =  "Reset Password";
        return view('auth.passwords.reset')->with("viewData", $viewData);;
    }

     /**
     * Create a new update user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    public function update(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'exists:users'],
            'current_password' => ['required', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::where('email', $request->input('email'))->first();

         // Check if the user exists
         if (!$user) {
            return redirect()->back()->with('error', 'User with this email does not exist.');
        }

        $password = $user->getPassword();

        // Check if the current password is correct
        if (!Hash::check($request->input('current_password'), $password)) {
            return redirect()->back()->with('error', 'The current password is incorrect.');
        }

        $new_password = Hash::make($request->input('password'));
        $user->setPassword($new_password);
        $user->save();

        return redirect()->route('auth.passwords.reset')->with('success', 'Password updated successfully.');
    }
}
