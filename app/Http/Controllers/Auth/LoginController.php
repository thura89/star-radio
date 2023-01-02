<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePassword;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
        $validate = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validate->fails()) {

            
            $errors = $validate->errors();
 
            $error = [];
            foreach ($errors->all() as $error){
                echo $error;
            }
            return redirect()->route('login')->with('fail_validator', $errors);
        }
        

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            /* AGent Adding */
            $user = User::find(auth()->user()->id);
            $user->ip = $request->ip();
            $user->user_agent = $request->server('HTTP_USER_AGENT');
            $user->login_at = date('Y-m-d H:i:s');
            $user->update();
            /* Admin */
            if (auth()->user()->user_type == 1) {
                return redirect()->route('admin.dashboard');
            }
            if (auth()->user()->user_type == 2) {
                return redirect()->route('admin.dashboard');
            }
        }else{
                return redirect()->route('login')->with('fail', 'Username / Password invalid');
        }
          
    }
}
