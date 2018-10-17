<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.employer.index');
    }

    public function getEmployersData()
    {
        $users = User::with('employer_profile')->where('status', 1)->whereRoleIs('employer')->select(['id', 'name', 'email', 'password', 'created_at', 'updated_at'])->get();

        return DataTables::of($users)
        ->addColumn('action', function ($user) {
            //return '<a href="'.route('admin.agent.edit', $user->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            return '<a class="btn btn-xs btn-primary" href="#">View</a>';
        })
        ->editColumn('id', 'ID: {{$id}}')
        ->removeColumn('password')
        ->make(true);
    }

    public function employerApplication()
    {
        return view('admin.employer.employerApplication');
    }

    public function getEmployersApplicationData()
    {
        $users = User::where('status', 0)->whereRoleIs('employer')->select(['id', 'name', 'email', 'password', 'created_at', 'updated_at'])->get();

        return DataTables::of($users)
        ->addColumn('action', function ($user) {
            return '<a href="#" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a><a class="ml-1 btn btn-success" href="'.route('admin.agent.approve', $user->id).'" onclick="return confirm(\'Are you sure?\')">Approve</a><a class="ml-1 btn btn-danger" href="'.route('admin.agent.reject', $user->id).'" onclick="return confirm(\'Are you sure?\')">Reject</a>';
        })
        ->editColumn('id', 'ID: {{$id}}')
        ->removeColumn('password')
        ->make(true);
    }

    public function employerDemands()
    {
        return view('admin.employer.employerDemands');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
