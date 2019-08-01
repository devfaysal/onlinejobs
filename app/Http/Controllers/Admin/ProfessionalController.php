<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class ProfessionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professional_count = User::with('professional_profile')->where('status', 0)->whereRoleIs('professional')->count();
        return view('admin.professional.index', compact('professional_count'));
    }

    public function getProfessionalsData()
    {
        $users = User::with('professional_profile')->where('status', 0)->whereRoleIs('professional')->get();

        return DataTables::of($users)
        ->addColumn('action', function ($user) {
            $string = '<a href="'.route('professional.show', $user->id).'" class="btn btn-xs btn-primary">View</a> ';
            // $string .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.professional.delete', $user->id).'">Delete</a>';
            return $string;
        })
        ->addColumn('city', function($user) {
            return $user->professional_profile['city'];
        })
        ->addColumn('profile_image', function($user) {
            $img = $user->professional_profile['profile_image'] != '' ? asset('storage/resume/'.$user->professional_profile['profile_image']) :  asset('images/dummy.jpg');
            return '<img src="'.$img.'" border="0" width="40" class="img-rounded" align="center" />';
        })
        ->addColumn('name', function($user) {
            return $user->professional_profile['name'];
        })
        ->addColumn('email', function($user) {
            return $user->professional_profile['email'];
        })
        ->rawColumns(['profile_image', 'action'])
        ->removeColumn('password')
        ->make(true);
    }

    public function delete(User $user)
    {
        if($user->professional_profile){
            $user->professional_profile->delete();
        }

        foreach($user->professional_experiences as $experience){
            $experience->delete();
        }
        
        $user->delete();

        Session::flash('message', 'Deleted successfully!'); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('admin.professional.index');
    }
}
