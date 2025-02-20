<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|exists:user,email|email|max:50',
            'password' => 'required|string|min:8',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if ($user) {
            if (Hash::check($request->password, $user->password) && $user->status == 'active') {
                Auth::login($user, $request->has('remember'));
    
                if ($request->session()->get('url.intended')) {
                    return redirect()->intended();
                }    
                return redirect()->route('index');
            }
    
            Session::flash('error', 'Invalid Authentication');
            return redirect()->back()->withInput();
        }
    
        Session::flash('error', 'You are not registered');
        return redirect()->back()->withInput();
    }
    
}
