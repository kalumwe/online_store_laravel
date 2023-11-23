<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = [
        'home' => RouteServiceProvider::HOME,
        'admin' => RouteServiceProvider::ADMIN
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
       try {

       if (Auth::user() && Auth::user()->getRole() === 'admin') {
        Log::info('Admin ' . Auth::user()->getName() . ' logged in successfully.');

        return $this->redirectTo["admin"];
       }

       Log::info('User ' . Auth::user()->getName() . ' logged in successfully.');

       return $this->redirectTo["home"];

       } catch (Exception $e) {
                // Log an error or exception
                Log::error('Error occurred: ' . $e->getMessage());

                // Handle the exception
       }
   }
}
