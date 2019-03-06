<?php

namespace App\Http\Controllers\Admin;

use Session;
use App\Applicant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class SuperadminController extends Controller
{
    public function proposedGwDm()
    {

        return view('admin.proposedGwDm.index');

    }


    public function getProposedGwDm()
    {

        $applicants = Applicant::all();

        return DataTables::of($applicants)

            ->addColumn('action', function ($applicant) {

                $string =  '<a onclick="return confirm(\'Are you sure?\')" class="btn btn-xs btn-primary" href="'.route('admin.releaseProposedGwDm', $applicant->id).'">Release</a> ';

                return $string;
            })
            ->addColumn('gw_dm', function($applicant) {

                return $applicant->gw_dm->profile['name'];

            })
            ->addColumn('employer', function($applicant) {

                return $applicant->offer->employer['name'];

            })
            ->addColumn('agent', function($applicant) {

                return $applicant->offer->agent['name'];

            })
            ->addColumn('proposed_time', function($applicant) {

                $proposed_date = Carbon::parse($applicant->offer->proposed_date);

                $now = Carbon::now();

                $length = $proposed_date->diffInDays($now);

                return $length . ' Days Ago';
            })

            // ->rawColumns(['image', 'action', 'selectQW'])
            // ->removeColumn('password')
            ->make(true);

    }


    public function releaseProposedGwDm(Applicant $applicant)
    {

        $applicant->delete();

        Session::flash('message', 'Released successfully!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.proposedGwDm');

    }



}
