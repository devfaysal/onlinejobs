<?php

namespace App\Http\Controllers;

use Session;
use Image; /* https://github.com/Intervention/image */
use Storage;
use App\User;
use App\Offer;
use App\Country;
use App\Applicant;
use Carbon\Carbon;
use App\EmployerProfile;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class EmployerProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employer.index');
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

        $countrys = Country::where('status', 1)->get();
        $total_maids = User::whereRoleIs('maid')->count();
        $total_workers = User::whereRoleIs('worker')->count();
        $total_agents = User::whereRoleIs('agent')->count();
        $offer_sent = Offer::where('employer_id', auth()->user()->id)->count();

        return view('employer.show', compact('employer','total_maids','total_workers', 'total_agents','offer_sent', 'countrys'));
    }

    public function getAllDemands()
    {
        if(auth()->user()->hasRole('employer'))
        {
            // Demand letters employer wise
            $loggedInUserId = auth()->user()->id;

            $demands = Offer::whereIn('status', [2, 3, 4, 5, 6, 7])->where('employer_id', $loggedInUserId)->get();
        } else {
            // all demand letters for super admin
            $demands = Offer::whereIn('status', [2, 3, 4, 5, 6, 7])->get();
        }

        return DataTables::of($demands)
        ->addColumn('action', function ($demand) {
            $string =  '<a class="btn btn-xs btn-primary" href="'.route('demand', $demand->id).'">View</a>';

            return $string;
        })
        ->addColumn('status', function($demand) {
            $status = '';

            if ($demand->status == 2) {
                $status = 'Submitted';
            } elseif ($demand->status == 3) {
                $status = 'Assigned Agent';
            } elseif ($demand->status == 4) {
                $status = 'Selected GW';
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
        ->addColumn('issue_date', function($demand) {
            return $demand->issue_date ? \Carbon\Carbon::parse($demand->issue_date)->format('d/m/Y') : '';
        })
        ->addColumn('expexted_date', function($demand) {
            return $demand->expexted_date ? \Carbon\Carbon::parse($demand->expexted_date)->format('d/m/Y') : '';
        })
        ->addColumn('proposed_qty', function($demand) {

            $countSelectedGW = count( $demand->applicants()->where('status', 1)->get() );

            $string = '<span title="Proposed Date: '. (($demand->proposed_date != '') ? \Carbon\Carbon::parse($demand->proposed_date)->format('d/m/Y') : 'N/A') .'">'. $countSelectedGW .'</span>';

            return $string;
        })
        ->addColumn('day_pending', function($demand) {
            $date1 = date_create(date('Y-m-d'));
            $date2 = date_create($demand->proposed_date);

            //difference between two dates
            $diff = date_diff($date1,$date2);

            //count days
            $diff = $diff->format("%a");
            return $diff;
        })
        ->addColumn('selected_qty', function($demand) {
            return count( $demand->applicants()->where('status', 2)->get() );
        })
        ->addColumn('final_qty', function($demand) {
            return "...";
        })
        ->rawColumns(['proposed_qty', 'action'])
        ->make(true);
    }

    public function getAllMaids(){

        $users = User::where('status', 1)->whereRoleIs('maid')->select(['id','public_id', 'name'])->get();

        return DataTables::of($users)
        ->addColumn('action', function ($user) {
            $string =  '<a class="btn btn-xs btn-primary" href="'.route('profile.public', $user->public_id).'">View</a>';
            if ( ! $user->applicants()->first()['id'] ) {
                $string .= ' <input style="width: 38px;height: 38px;vertical-align: middle;" type="checkbox" name="id[]" value="'.$user->id.'">';
            }

            return $string;
        })
        ->addColumn('status', function($user) {
            if($user->applicants()->first()['id']){
                return 'Offered';
            }
            return 'Active';
        })
        ->addColumn('country', function($user) {
            return $user->profile->nationality_data['name'];
        })
        ->addColumn('date_of_birth', function($user) {
            return $user->profile->date_of_birth ? \Carbon\Carbon::parse($user->profile->date_of_birth)->format('d/m/Y') : '';
        })
        ->addColumn('passport', function($user) {
            return '';
        })
        ->addColumn('marital_status', function($user) {
            return $user->profile->marital_status;
        })
        ->addColumn('image', function($user) {
            $img = $user->profile->image != '' ? asset('storage/'.$user->profile->image) :  asset('images/dummy.jpg');
            return '<img src="'.$img.'" border="0" width="40" class="img-rounded" align="center" />';
        })
        ->rawColumns(['image', 'action'])
        ->make(true);
    }

    public function selectedGW($damand_id){

        $users = User::whereRoleIs('worker')
                        ->with('applicants')
                        ->where('status', 1)
                        ->whereHas('applicants', function($query) use($damand_id){
                            $query->whereIn('status', [1, 2, 3, 4])->where('offer_id', $damand_id);
                        })->get();

        // datatable return
        return DataTables::of($users)
        ->addColumn('action', function ($data) {
            $string =  '<a class="btn btn-xs btn-primary" href="'.route('profile.public', $data->public_id).'">View</a>';

            // only for agent
            if(auth()->user()->hasRole('agent'))
            {
                if ( $data->applicants()->first()['status'] == 2 ) {
                    $string .= ' <input class="pull-right" style="width: 38px;height: 38px;vertical-align: middle;" type="checkbox" name="id[]" value="'.$data->applicants()->first()['id'].'">';
                }
            } else {
                if ( $data->applicants()->first()['status'] == 1 ) {
                    $string .= ' <input class="pull-right" style="width: 38px;height: 38px;vertical-align: middle;" type="checkbox" name="id[]" value="'.$data->applicants()->first()['id'].'">';
                }                
            }

            // hidden input
            $string .= '<input type="hidden" name="demandID" value="'.$data->applicants()->first()['offer_id'].'">';

            return $string;
        })
        ->addColumn('status', function($data) {
            $status = $data->applicants()->first()['status'];
            $statusLabel = '';

            if ($status == 1) {
                $statusLabel = 'Proposed';  // selected
            } elseif ($status == 2) {
                $statusLabel = 'Confirmed';
            } elseif ($status == 3) {
                $statusLabel = 'Finalized';
            } elseif ($status == 4) {
                $statusLabel = 'Hired';
            } else {
                $statusLabel = '';
            }

            return $statusLabel;
        })
        ->addColumn('country', function($data) {
            return $data->profile->nationality_data['name'];
        })
        ->addColumn('date_of_birth', function($data) {
            return $data->profile->date_of_birth ? \Carbon\Carbon::parse($data->profile->date_of_birth)->format('d/m/Y') : '';
        })
        ->addColumn('passport', function($data) {
            return $data->profile->passport_number;
        })
        ->addColumn('marital_status', function($data) {
            return $data->profile->marital_status_data->name;
        })
        ->addColumn('image', function($data) {
            $img = $data->profile->image != '' ? asset('storage/'.$data->profile->image) :  asset('images/dummy.jpg');
            return '<img src="'.$img.'" border="0" width="40" class="img-rounded" align="center" />';
        })
        ->rawColumns(['image', 'action'])
        ->make(true);
    }

    public function confirmGWToDemand(Request $request)
    {
        if(!$request->id) {
            Session::flash('message', 'No General Worker were Selected!'); 
            Session::flash('alert-class', 'alert-danger');

            return redirect()->back();
        }

        // update demand
        $demandUpdate = Offer::where('id', $request->demandID)->first();
        $demandUpdate->status = 5;  // confirmed GW
        $demandUpdate->save();

        $ids = $request->id;
        foreach($ids as $id){
            $applicantUpdate = Applicant::where('id', $request->id)->first();
            $applicantUpdate->status = 2;  // confirmed GW
            $applicantUpdate->save();
        }

        Session::flash('message', 'Worker(s) confirmed successfully!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('employer.show');
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

    public function saveDemand(Request $request)
    {
        /*Validation*/
        $this->validate($request, [
            'IssueDate' => 'date',
            'ExpectedJoinDate' => 'date',
        ]);

        if($request->file('DemandFile')){
            $this->validate($request, [
                'DemandFile' => 'mimes:pdf,jpg,jpeg,png|max:5024',
            ]);
        }

        $offer = new Offer;
        $offer->employer_id = auth()->user()->id;
        $offer->title = 'Demand Letter';
        $offer->hiring_package = $request->HiringPackage;
        $offer->company_name = $request->CompanyName;
        $offer->demand_letter_no = $request->DemandLetterNo;
        $offer->issue_date = $request->IssueDate;
        $offer->expexted_date = $request->ExpectedJoinDate;
        $offer->demand_qty = $request->DemandQuantity;
        $offer->preferred_country = $request->PreferredCountry;

        if($request->file('DemandFile')){            
            $file_basename = explode('.',$request->file('DemandFile')->getClientOriginalName())[0];
            $file_name = $file_basename . '-' . time() . '.' . $request->file('DemandFile')->getClientOriginalExtension();

            $request->DemandFile->storeAs('public/demand_letter', $file_name);
            //add new image path to database
            $offer->demand_file = $file_name;
            
        }

        $offer->comments = $request->comments;
        $offer->status = 2;
        $offer->save();

        Session::flash('message', 'Deman sent successfully!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('employer.show');
    }

    public function sendOffer(Request $request)
    {
        if(!$request->id){
            Session::flash('message', 'No Domestic Maid or Worker Selected!'); 
            Session::flash('alert-class', 'alert-danger');

            return redirect()->back();
        }
        $offer = new Offer;
        $offer->employer_id = auth()->user()->id;
        $offer->save();

        $ids = $request->id;
        foreach($ids as $id){
            $applicant = new Applicant;
            $applicant->offer_id = $offer->id;
            $applicant->user_id = $id;
            $applicant->save();
        }

        Session::flash('message', 'Offer sent successfully!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('employer.show');
    }

    public function viewDemand ($id)
    {
        $offer = Offer::where('id', '=', $id)->first();
        $applicants = Applicant::where('offer_id', $offer->id)->get();

        return view('demand.show', compact('offer','applicants'));
    }
}
