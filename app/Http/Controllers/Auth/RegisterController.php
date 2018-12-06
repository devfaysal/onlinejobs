<?php

namespace App\Http\Controllers\Auth;

use Session;
use Storage;
use App\User;
use App\Country;
use App\Profile;
use App\AgentProfile;
use App\EmployerProfile;
use App\ProfessionalProfile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\AgentApplication;
use Illuminate\Support\Facades\Validator;
use App\Notifications\EmployerApplication;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Auth\RegistersUsers;
use Image; /* https://github.com/Intervention/image */

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
    //protected $redirectTo = '/';
    public function redirectTo()
    {
        if(Auth::user()->hasRole('employer')){
            return '/employer/profile';
        }elseif(Auth::user()->hasRole('agent')){
            return '/agent';
        }elseif(Auth::user()->hasRole('professional')){
            Session::flash('message', 'Information saved successfully!!'); 
            Session::flash('alert-class', 'alert-success');
            return route('qualification.edit', Auth::user()->id);
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
        $request = request();
        if($request->file('license_file')){
            $this->validate($request, [
                'license_file' => 'mimes:pdf,jpg,jpeg,png|max:1024',
            ]);
        }
        if($request->file('passport_file')){
            $this->validate($request, [
                'passport_file' => 'mimes:pdf,jpg,jpeg,png|max:1024',
            ]);
        }
        if($request->file('resume_file')){
            $this->validate($request, [
                'resume_file' => 'mimes:pdf,doc,docx|max:1024',
            ]);
        }


        // If agent set defailt values for sign-up
        $role = $data['role'];

        if ($role == 'agent') {
            $data['name'] = $data['agency_registered_name'];
            $data['email'] = $data['agency_email'];
            $data['password'] = "DefPassAgent";
            $data['password_confirmation'] = "DefPassAgent";
            $data['phone'] = $data['agency_phone'] ?? '';
        }
        if ($role == 'employer') {
            $data['name'] = $data['name'];
            $data['email'] = $data['email'];
            $data['password'] = "DefPassAgent";
            $data['password_confirmation'] = "DefPassAgent";
            $data['phone'] = $data['phone'] ?? '';
        }

        return Validator::make($data, [
            'name' => 'sometimes|string|max:255',
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
        // If agent set defailt values for sign-up
        $role = $data['role'];

        if ($role == 'agent') {
            $data['name'] = $data['agency_registered_name'];
            $data['email'] = $data['agency_email'];
            $data['password'] = "DefPassAgent";
            $data['password_confirmation'] = "DefPassAgent";
            $data['phone'] = $data['agency_phone'] ?? '';
        }
        if ($role == 'employer') {
            $data['name'] = $data['name'];
            $data['email'] = $data['email'];
            $data['password'] = "DefPassAgent";
            $data['password_confirmation'] = "DefPassAgent";
            $data['phone'] = $data['phone'] ?? '';
        }

        // Create use
        $user = new User;
        $user->name = $data['name'] ?? '';
        $user->email = $data['email'];
        $user->phone = $data['phone'] ?? '';
        $user->password = Hash::make($data['password']);
        $user->public_id = time().md5($data['email']);

        // User wise status
        if($role == 'maid' || $role == 'worker'){
            $user->status = 1;
        }elseif($role == 'agent'){
            $user->status = 0;
        }
        
        if(isset($data['company_country'])){
            $user_country = $data['country'];
        }elseif(isset($data['country'])){
            $user_country = $data['agency_country'];
        }elseif(isset($data['agency_country'])){
            $user_country = $data['agency_country'];
        }
        
        $user->code = $this->user_code($user_country);
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

        if($role == 'employer'){
            $user->attachRole($role);
            $employer = new EmployerProfile;
            $employer->user_id = $user->id;
            $employer->address = $data['address'];
            $employer->country = $data['country'];
            $employer->nric = $data['nric'];
            $employer->roc = $data['roc'];
            $employer->state = $data['state'];
            $employer->company_name = $data['company_name'];
            $employer->company_address = $data['company_address'];
            $employer->company_city = $data['company_city'];
            $employer->company_country = $data['company_country'];

            $employer->save();
            Session::flash('message', 'Your Employer Application Submitted Successfully!!'); 
            Session::flash('alert-class', 'alert-success');

            //Send notification to admins
            $data = $employer;
            $admins = User::whereRoleIs('superadministrator')->get();
            Notification::send($admins, new EmployerApplication($data));
        }

        if($role == 'agent'){

            // Mail::to('devfaysal@gmail.com')
            // ->send(new SendPasswordAfterRegistration());

            $agent = new AgentProfile;
            $agent->user_id = $user->id;
            $agent->agent_code = time();
            $agent->agency_registered_name = $data['agency_registered_name'];
            $agent->agency_address = $data['agency_address'];
            $agent->agency_city = $data['agency_city'];
            $agent->agency_country = $data['agency_country'];
            $agent->agency_phone = $data['agency_phone'];
            // $agent->agency_fax = $data['agency_fax'];
            $agent->agency_email = $data['agency_email'];
            $agent->license_no = $data['license_no'];
            $agent->license_issue_date = $data['license_issue_date'];
            $agent->license_expire_date = $data['license_expire_date'];

            $request = request();

            if($request->file('license_file')){
                $image_basename = explode('.',$request->file('license_file')->getClientOriginalName())[0];
                $image = $image_basename . '-' . time() . '.' . $request->file('license_file')->getClientOriginalExtension();

                $request->license_file->storeAs('public', $image);
    
                // $img = Image::make($request->file('license_file')->getRealPath());
                // $img->stream();
    
                // //Upload image
                // Storage::disk('local')->put('public/'.$image, $img);
    
                //add new image path to database
                $agent->license_file = $image;
                
            }
            //Point of Contact
            $agent->first_name = $data['first_name'];
            // $agent->middle_name = $data['middle_name'];
            $agent->last_name = $data['last_name'];
            $agent->designation = $data['designation'];
            // $agent->address = $data['address'];
            $agent->nationality = $data['nationality'];
            $agent->passport = $data['passport'];
            if($request->file('passport_file')){
                $image_basename = explode('.',$request->file('passport_file')->getClientOriginalName())[0];
                $image = $image_basename . '-' . time() . '.' . $request->file('passport_file')->getClientOriginalExtension();

                $request->passport_file->storeAs('public', $image);
                // $img = Image::make($request->file('passport_file')->getRealPath());
                // $img->stream();
    
                // //Upload image
                // Storage::disk('local')->put('public/'.$image, $img);
    
                //add new image path to database
                $agent->passport_file = $image;
                
            }
            //$agent->nic = $data['nic'];
            $agent->contact_phone = $data['contact_phone'];
            // $agent->contact_email = $data['contact_email'];
            $agent->save();
            
            //Send notification to admins
            $data = $agent;
            $admins = User::whereRoleIs('superadministrator')->get();
            Notification::send($admins, new AgentApplication($data));
        }

        if($role == 'professional'){
            $request = request();
            $user->attachRole($role);
            $professional = new ProfessionalProfile;
            $professional->user_id = $user->id;
            $professional->name = $request->name;
            $professional->email = $request->email;
            $professional->phone = $request->phone;
            if($request->file('resume_file')){
                $image_basename = explode('.',$request->file('resume_file')->getClientOriginalName())[0];
                $image = $image_basename . '-' . time() . '.' . $request->file('resume_file')->getClientOriginalExtension();

                $request->resume_file->storeAs('public/resume', $image);
    
                //add new image path to database
                $professional->resume_file = $image;
                
            }
            $professional->save();
        }

        // Session::flash('message', ucfirst($role).' Registered successfully!!'); 
        // Session::flash('alert-class', 'alert-success');
        return $user;
    }

    public function user_code($country_id)
    {
        $country = Country::where('id', $country_id)->first();
        for($i=1; $i<10000; $i++){
            if($i < 10){
                //00009
                $j = '0000' . $i;
            }elseif($i >= 10 && $i < 100){
                //00099
                $j = '000' . $i;
            }elseif($i >= 100 && $i < 1000){
                //00999
                $j = '00' . $i;
            }elseif($i >= 1000 && $i < 10000){
                //09999
                $j = '0' . $i;
            }else{
                //99999
                $j = $i;
            }
            $user_code = $country->code . $j;
            if(!User::where('code', '=', $user_code)->exists()){
                break;
            }
        }
        return $user_code;
    }
}
