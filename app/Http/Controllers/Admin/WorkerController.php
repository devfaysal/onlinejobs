<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Applicant;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.worker.index');
    }

    public function getWorkersData()
    {
        if(auth()->user()->hasRole('agent')){
            $users = User::whereRoleIs('worker')->whereHas('profile', function ($q) {
                $agent = auth()->user();
                $q->where('agent_code', $agent->agent_profile->agent_code);
            })->get();
        }else{
            $users = User::where('status', 1)->whereRoleIs('worker')->get();
        }
        

        return DataTables::of($users)
        ->addColumn('action', function ($user) {
            //return '<a href="'.route('admin.worker.edit', $user->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';

            $string =  '<a target="_blank" class="btn btn-xs btn-primary" href="'.route('profile.public', $user->public_id).'">View </a> ';
            $string .= '<a target="_blank" class="btn btn-xs btn-info mr-2" href="'.route('profile.edit', $user->id).'">Edit</a>';
            $string .= '<a class="btn btn-xs btn-danger" onclick="return confirm('."'Are you sure?'".')" href="'.route('admin.worker.delete', $user->id).'">Delete</a>';
            return $string;
        })
        ->addColumn('selectQW', function ($user) {
            if ( ! $user->applicants()->first()['user_id'] ) {
                $string = '<input style="width: 38px;height: 38px;vertical-align: middle;" onchange="updateId(this)" type="checkbox" id="gw'.$user->id.'" name="id[]" value="'.$user->id.'">';
            } else {
                $string = '';
            }

            return $string;
        })
        ->addColumn('status', function($user) {
            $applicant_status = 'Active';
            if($user->applicants()->first()['finialized'] == 1){
                $applicant_status = 'Finalized by Agent';
            }elseif($user->applicants()->first()['confirmed'] == 1){
                $applicant_status = 'Selected by Employer';
            }elseif($user->applicants()->first()['proposed'] == 1){
                $applicant_status = 'Proposed by Agent';
            }
            
            return $applicant_status;



            // if($user->applicants()->first()['proposed'] == 1){
            //     return 'Offered';
            // }elseif($user->applicants()->first()['confirmed'] == 1)
            // return 'Active';
        })
        ->addColumn('country', function($user) {
            return $user->profile->nationality_data['name'];
        })
        ->addColumn('date_of_birth', function($user) {
            return $user->profile->date_of_birth ? \Carbon\Carbon::parse($user->profile->date_of_birth)->format('d/m/Y') : '';
        })
        ->addColumn('passport', function($user) {
            return $user->profile->passport_number;
        })
        ->addColumn('marital_status', function($user) {
            return $user->profile->marital_status_data['name'];
        })
        ->addColumn('image', function($user) {
            $img = $user->profile->image != '' ? asset('storage/'.$user->profile->image) :  asset('images/dummy.jpg');
            return '<img src="'.$img.'" border="0" width="40" class="img-rounded" align="center" />';
        })
        ->rawColumns(['image', 'action', 'selectQW'])
        ->removeColumn('password')
        ->make(true);
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

    public function delete(User $user)
    {
        if($user->profile){
            $user->profile->delete();
        }

        $applications = Applicant::where('user_id', $user->id) ->get();
        if($applications){
            foreach($applications as $application){
                $application->delete();
            }
        }
        
        $user->delete();

        Session::flash('message', 'Deleted successfully!'); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('admin.worker.index');
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
