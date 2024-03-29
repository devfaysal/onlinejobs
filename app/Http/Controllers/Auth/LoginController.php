<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AgentApplication;
use Illuminate\Support\Facades\Notification;
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
    //protected $redirectTo = '/';
    public function redirectTo(){
        if(Auth::user()->hasRole(['superadministrator', 'administrator'])){
            return '/admin';
        }elseif(Auth::user()->hasRole('agent')){
            if(Auth::user()->status == 1){
                //Send notification to admins [Test Purpose]
                // $data = auth()->user()->agent_profile;
                // $admins = User::whereRoleIs('superadministrator')->get();
                // Notification::send($admins, new AgentApplication($data));
                return '/admin';
            }else{
                return '/agent';
            }
        }elseif(Auth::user()->hasRole('employer')){
            return '/employer/profile';
        }else{
            return '/';
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
