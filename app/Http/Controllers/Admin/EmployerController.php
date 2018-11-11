<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\User;
use App\Offer;
use App\Country;
use App\Applicant;
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
        $users = User::with('employer_profile')->where('status', 1)->whereRoleIs('employer')->select(['id','public_id', 'name', 'email', 'password', 'created_at', 'updated_at'])->get();

        return DataTables::of($users)
        ->addColumn('action', function ($user) {
            //return '<a href="'.route('admin.agent.edit', $user->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            return '<a class="btn btn-xs btn-primary" href="'.route('employer.public', $user->public_id).'">View</a>';
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

    // Demand
    public function employerDemands()
    {
        // get all agetns
        $agents = User::with('agent_profile')->where('status', 1)->whereRoleIs('agent')->select(['id', 'name', 'email'])->get();
        // return to demand view
        return view('admin.employer.employerDemands', compact('agents'));
    }

    public function getEmployersDemandData()
    {
        if(auth()->user()->hasRole('agent'))
        {
            // Demand letters agent wise
            $loggedInUserId = auth()->user()->id;

            $demands = Offer::whereIn('status', [2, 3, 4, 5, 6, 7])->where('assigned_agent', $loggedInUserId)->get();
        } else {
            // all demand letters for super admin
            $demands = Offer::whereIn('status', [2, 3, 4, 5, 6, 7])->get();
        }

        return DataTables::of($demands)
        ->addColumn('employer_name', function($demand) {
            return $demand->employer->name;
        })
        ->addColumn('expexted_date', function($demand) {
            return $demand->expexted_date ? \Carbon\Carbon::parse($demand->expexted_date)->format('d/m/Y') : '';
        })
        ->addColumn('proposed_qty', function($demand) {

            $countProposedGW = count( $demand->applicants()->where('proposed', 1)->get() );

            $countProposedGW = $countProposedGW ?: '...';

            $string = '<span title="Proposed Date: '. (($demand->proposed_date != '') ? \Carbon\Carbon::parse($demand->proposed_date)->format('d/m/Y') : 'N/A') .'">'. $countProposedGW .'</span>';

            return $string;
        })
        ->addColumn('day_pending', function($demand) {

            if ($demand->proposed_date)
            {
                $date1 = date_create(date('Y-m-d'));
                
                $proposed_date = strtotime($demand->proposed_date);
                $proposed_date7 = strtotime("+6 day", $proposed_date);
                $date2 = date_create(date('Y-m-d', $proposed_date7));

                //difference between two dates
                $diff = date_diff($date1,$date2);

                //count days
                $diff = $diff->format("%a");
                return $diff;
            } else {
                return '...';
            }

        })
        ->addColumn('confirmed_qty', function($demand) {
            return count( $demand->applicants()->where('confirmed', 1)->get() ) ?: '...';
        })
        ->addColumn('final_qty', function($demand) {
            return count( $demand->applicants()->where('finalized', 1)->get() ) ?: '...';
        })
        ->addColumn('status', function($demand) {
            $status = '';

            if ($demand->status == 2) {
                $status = 'Submitted';
            } elseif ($demand->status == 3) {
                $status = 'Assigned Agent';
            } elseif ($demand->status == 4) {
                $status = 'Proposed GW';
            } elseif ($demand->status == 5) {
                $status = 'Confirmed GW';
            } elseif ($demand->status == 6) {
                $status = 'Finalized GW';
            } elseif ($demand->status == 7) {
                $status = 'Closed';
            } else {
                $status = '';
            }

            return $status;
        })
        ->addColumn('assigned_agent', function($demand) {
            if ($demand->assigned_agent) {
                return $demand->agent->name;
            } else {
                return '<a class="btn btn-sm btn-warning btn-assign-agent" data-toggle="modal" demandID="'. $demand->id .'" data-backdrop="static" data-keyboard="false" data-target="#assignDemandAgentModal" href="#">Assign</a>';
            }
        })
        ->addColumn('proposed_gw', function($demand) {
            // if ($demand->assigned_agent) {
            //     return $demand->agent->name;
            // } else {
                return '<a class="btn btn-sm btn-warning btn-selectGW" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#selectGWModal" href="#" demandID="'. $demand->id .'">Select GW</a>';
            // }
        })
        ->addColumn('action', function ($demand) {
            $string =  '<a class="btn btn-sm btn-primary" href="'.route('demand', $demand->id).'">View</a>';

            return $string;
        })
        ->rawColumns(['proposed_qty', 'assigned_agent', 'proposed_gw', 'action'])
        ->make(true);
    }

    public function assignDemandAgent(Request $request)
    {
        $demandUpdate = Offer::where('id', $request->demandID)->first();
        $demandUpdate->assigned_agent = $request->AgentAssign;
        $demandUpdate->status = 3;  // assigned agent
        $demandUpdate->save();

        Session::flash('message', 'Deman agent assigned successfully!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect('/admin/employer-demands');
    }

    public function proposeGWToDemand(Request $request)
    {
        if(!$request->id) {
            Session::flash('message', 'No General Worker Selected!'); 
            Session::flash('alert-class', 'alert-danger');

            return redirect()->back();
        }

        // update demand
        $demandUpdate = Offer::where('id', $request->demandID)->first();
        $demandUpdate->status = 4;  // proposed GW
        $demandUpdate->proposed_date = date('Y-m-d');  // proposed GW
        $demandUpdate->save();

        $ids = $request->id;
        foreach($ids as $id){
            $applicant = new Applicant;
            $applicant->offer_id = $request->demandID;
            $applicant->user_id = $id;
            $applicant->proposed = 1; // Proposed GW
            $applicant->status = 1; // Proposed GW
            $applicant->save();
        }

        Session::flash('message', 'Proposed GW successfully!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect('/admin/employer-demands');
    }

    public function finalizeGWToDemand(Request $request)
    {
        if(!$request->id) {
            Session::flash('message', 'No General Worker were Selected!'); 
            Session::flash('alert-class', 'alert-danger');

            return redirect()->back();
        }

        // update demand
        $demandUpdate = Offer::where('id', $request->demandID)->first();
        $demandUpdate->status = 6;  // finalized GW
        $demandUpdate->save();

        $ids = $request->id;
        foreach($ids as $id){
            $applicantUpdate = Applicant::where('id', $id)->first();
            $applicantUpdate->finalized = 1;  // finalized GW
            $applicantUpdate->status = 3;  // finalized GW
            $applicantUpdate->save();
        }

        Session::flash('message', 'Worker(s) finalized successfully!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect('/admin/employer-demands');
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
