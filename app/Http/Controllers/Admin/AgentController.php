<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.agent.index');
    }

    public function getAgentsData()
    {
        $users = User::with('agent_profile')->where('status', 1)->whereRoleIs('agent')->select(['id', 'name', 'email', 'password', 'created_at', 'updated_at'])->get();
        //$users = User::with('agent_profile')->where('status', 1)->whereRoleIs('agent')->select('users.*')->get();
        //$users = User::with('agent_profile')->select('users.*')->get();
        // echo '<pre>';
        // print_r($users);
        // echo '</pre>';
        // foreach ($users as $user){
        //     // echo '<pre>';
        //     // print_r($user->agent_profile);
        //     // echo '</pre>';
        //     echo $user->agent_profile['country_data']['name'];
        //     echo '<br/>';
        // }

        return DataTables::of($users)
        ->addColumn('action', function ($user) {
            //return '<a href="'.route('admin.agent.edit', $user->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            return '<a class="btn btn-xs btn-primary" href="#">View</a>';
        })
        ->addColumn('country', function($user) {
            return $user->agent_profile['country_data']['name'];
        })
        ->addColumn('first_name', function($user) {
            return $user->agent_profile['first_name'];
        })
        ->addColumn('phone', function($user) {
            return $user->agent_profile['phone'];
        })
        ->editColumn('id', 'ID: {{$id}}')
        ->removeColumn('password')
        ->make(true);
    }

    public function agentApplication()
    {
        return view('admin.agent.agentApplication');
    }

    public function getAgentsApplicationData()
    {
        $users = User::where('status', 0)->whereRoleIs('agent')->select(['id', 'name', 'email', 'password', 'created_at', 'updated_at'])->get();

        return DataTables::of($users)
        ->addColumn('action', function ($user) {
            return '<a href="#" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a><a class="ml-1 btn btn-success" href="'.route('admin.agent.approve', $user->id).'">Approve</a><a class="ml-1 btn btn-danger" href="'.route('admin.agent.reject', $user->id).'">Reject</a>';
        })
        ->addColumn('country', function($user) {
            return $user->agent_profile['country_data']['name'];
        })
        ->addColumn('first_name', function($user) {
            return $user->agent_profile['first_name'];
        })
        ->addColumn('phone', function($user) {
            return $user->agent_profile['phone'];
        })
        ->editColumn('id', 'ID: {{$id}}')
        ->removeColumn('password')
        ->make(true);
    }

    public function approve($id)
    {
        $agent = User::where('id', $id)->first();

        $agent->status = 1;
        $agent->save();
        Session::flash('message', 'Application Approved!!'); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();
    }

    public function reject($id)
    {
        $agent = User::where('id', $id)->first();

        $agent->status = -1;
        $agent->save();
        Session::flash('message', 'Application Rejected!!'); 
        Session::flash('alert-class', 'alert-danger');
        return redirect()->back();
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
