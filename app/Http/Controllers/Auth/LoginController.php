<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

use Auth;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Redirect the user to the google authentication page
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    // Obtain user information from google
    public function  handleProviderCallback()
    {
        $user = Socialite::driver('google')->user();

        // Find User
        $authUser = User::where('email', $user->email)->first();

        if($authUser) {
            Auth::login($authUser);
            return redirect()->route('home');
        }
        else {
            $newUser = new User();
            $newUser->name = $user->name;
            $newUser->email = $user->email;
            $newUser->userid = $user->id;
            $newUser->password = uniqid();  // We don't need password to login
            $newUser->save();

            // login
            Auth::login($newUser);
            return redirect()->route('home');
        }
    }
}
