<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Profile;
use App\AgentProfile;
use Image; /* https://github.com/Intervention/image */
use Storage;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'agreement' => 'required',
            'role' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->password = Hash::make($data['password']);
        $user->public_id = time().md5($data['email']);

        $role = $data['role'];
        if($role == 'maid' || $role == 'worker'){
            $user->status = 1;
        }elseif($role == 'agent'){
            $user->status = 0;
        }

        $user->save();
  
        if($role == 'maid' || $role == 'worker' || $role == 'agent'){
            $user->attachRole($role);
        }
        
        if($role == 'maid' || $role == 'worker'){
            $profile = new Profile;
            $profile->user_id = $user->id;
            $profile->agent_code = 'self';
            $profile->name = $user->name;
            $profile->phone = $user->phone;
            $profile->save();
        }

        if($role == 'agent'){
            $agent = new AgentProfile;
            $agent->user_id = $user->id;
            $agent->agent_code = time();
            $agent->agency_registered_name = $data['name'];
            $agent->agency_address = $data['agency_address'];
            $agent->agency_city = $data['agency_city'];
            $agent->agency_country = $data['agency_country'];
            $agent->agency_phone = $data['phone'];
            $agent->agency_fax = $data['agency_fax'];
            $agent->agency_email = $data['email'];
            $agent->license_no = $data['license_no'];
            $agent->license_issue_date = $data['license_issue_date'];
            $agent->license_expire_date = $data['license_expire_date'];

            $request = request();

            if($request->file('license_file')){
                $this->validate($request, [
                    'license_file' => 'image|max:250',
                ]);
                
                $image_basename = explode('.',$request->file('license_file')->getClientOriginalName())[0];
                $image = $image_basename . '-' . time() . '.' . $request->file('license_file')->getClientOriginalExtension();
    
                $img = Image::make($request->file('license_file')->getRealPath());
                $img->stream();
    
                //Upload image
                Storage::disk('local')->put('public/'.$image, $img);
    
                //add new image path to database
                $agent->license_file = $image;
                
            }
            //Point of Contact
            $agent->first_name = $data['first_name'];
            $agent->middle_name = $data['middle_name'];
            $agent->last_name = $data['last_name'];
            $agent->designation = $data['designation'];
            $agent->address = $data['address'];
            $agent->nationality = $data['nationality'];
            $agent->passport = $data['passport'];
            $agent->nic = $data['nic'];
            $agent->phone = $data['contact_phone'];
            $agent->email = $data['contact_email'];
            $agent->save();
        }

        // Session::flash('message', ucfirst($role).' Registered successfully!!'); 
        // Session::flash('alert-class', 'alert-success');
        return $user;
    }
}
