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

    public function getAllDemands(){

        $demands = Offer::whereIn('status', [2, 3, 4])->get();

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
                $status = 'In Progress';
            } elseif ($demand->status == 4) {
                $status = 'Closed';
            } else {
                $status = '';
            }

            return $status;
            // Status >
            // 2=>Demand Submitted
            // 3=>Demand In Progress
            // 4=>Demand Closed
        })
        ->addColumn('issue_date', function($demand) {
            return $demand->issue_date ? \Carbon\Carbon::parse($demand->issue_date)->format('d/m/Y') : '';
        })
        ->addColumn('expexted_date', function($demand) {
            return $demand->expexted_date ? \Carbon\Carbon::parse($demand->expexted_date)->format('d/m/Y') : '';
        })
        ->addColumn('proposed_qty', function($demand) {
            return "...";
        })
        ->addColumn('day_pending', function($demand) {
            $date1 = date_create(date('Y-m-d'));
            $date2 = date_create($demand->expexted_date);

            //difference between two dates
            $diff = date_diff($date1,$date2);

            //count days
            $diff = $diff->format("%a");
            return $diff;
        })
        ->addColumn('selected_qty', function($demand) {
            return "...";
        })
        ->addColumn('final_qty', function($demand) {
            return "...";
        })
        ->rawColumns(['action'])
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

            $request->DemandFile->storeAs('public/deman_letter', $file_name);
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
