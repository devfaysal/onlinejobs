<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

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
            $string = '<a href="'.route('retiredPersonnel.show', $user->id).'" class="btn btn-xs btn-primary">View</a> ';
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
}
