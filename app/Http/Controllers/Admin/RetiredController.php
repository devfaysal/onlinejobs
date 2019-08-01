<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class RetiredController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $retired_count = User::with('retired_personnel')->where('status', 0)->whereRoleIs('retired')->count();
        return view('admin.retired.index', compact('retired_count'));
    }

    public function getRetiredPersonnelsData()
    {
        $users = User::with('retired_personnel')->where('status', 0)->whereRoleIs('retired')->get();

        return DataTables::of($users)
        ->addColumn('action', function ($user) {
            $string  = '<a href="'.route('retiredPersonnel.show', $user->id).'" class="btn btn-xs btn-primary">View</a> ';
            // $string .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.retired.delete', $user->id).'">Delete</a>';;
            return $string;
        })
        ->addColumn('address', function($user) {
            return $user->retired_personnel['address'];
        })
        ->addColumn('name', function($user) {
            return $user->retired_personnel['name'];
        })
        ->addColumn('email', function($user) {
            return $user->retired_personnel['email'];
        })
        ->rawColumns(['action'])
        ->removeColumn('password')
        ->make(true);
    }

    public function delete(User $user)
    {
        if($user->retired_personnel){
            $user->retired_personnel->delete();
        }

        if($user->retired_personnel_language){
            foreach($user->retired_personnel_language as $language){
                $language->delete();
            }
        }
        if($user->retired_personnel_experiences){
            foreach($user->retired_personnel_experiences as $experience){
                $experience->delete();
            }
        }
        if($user->retired_personnel_educations){
            foreach($user->retired_personnel_educations as $education){
                $education->delete();
            }
        }
        
        $user->delete();

        Session::flash('message', 'Deleted successfully!'); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('admin.retired.index');
    }
}
