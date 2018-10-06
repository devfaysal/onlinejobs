<?php

namespace App\Http\Controllers;

use App\User;
use App\Country;
use App\EmployerProfile;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EmployerProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countrys = Country::where('status', 1)->get();
        return view('employer.create', compact('countrys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmployerProfile  $employerProfile
     * @return \Illuminate\Http\Response
     */
    public function show(EmployerProfile $employerProfile)
    {
        if(!auth()->user()){
            abort(404);
        }
        if(auth()->user()->hasRole('employer')){
            $employer = auth()->user();
        }else{
            abort(404);
        }

        return view('employer.show', compact('employer'));
    }
    public function getAllMaids(){

        $users = User::where('status', 1)->whereRoleIs('maid')->select(['id','public_id', 'name', 'email', 'password', 'created_at', 'updated_at'])->get();
        
        return DataTables::of($users)
        ->addColumn('action', function ($user) {
            //return '<a href="'.route('admin.worker.edit', $user->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            return '<a target="_blank" class="btn btn-xs btn-primary" href="'.route('profile.public', $user->public_id).'">View</a>';
        })
        ->editColumn('id', 'ID: {{$id}}')
        ->removeColumn('password')
        ->make(true);
    }
    public function getAllWorkers(){

        $users = User::where('status', 1)->whereRoleIs('worker')->select(['id','public_id', 'name', 'email', 'password', 'created_at', 'updated_at'])->get();
        
        return DataTables::of($users)
        ->addColumn('action', function ($user) {
            //return '<a href="'.route('admin.worker.edit', $user->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            return '<a target="_blank" class="btn btn-xs btn-primary" href="'.route('profile.public', $user->public_id).'">View</a>';
        })
        ->editColumn('id', 'ID: {{$id}}')
        ->removeColumn('password')
        ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmployerProfile  $employerProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployerProfile $employerProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmployerProfile  $employerProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployerProfile $employerProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmployerProfile  $employerProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployerProfile $employerProfile)
    {
        //
    }
}
