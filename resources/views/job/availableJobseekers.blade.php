@extends('layouts.app')

@section('content')
<section class="banner" style="min-height: 350px;background-size: 108%;background:url(/images/Professional.png) no-repeat fixed;">

        @include('layouts.topbar')

        <!--  banner body and search   -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-3 text-white text-uppercase text-center" style="border-bottom: 1px solid;">
                        Available Professionals
                        <span class="pull-right"><small style="font-size: 14px;">Available:</small> <span class="counter">{{count($jobseekers)}}</span></span>
                    </h1>
                </div>
                <div class="col-md-12">
                    <div class="banner_tranparent">
                        <form method="GET" action="{{ route('availableJobseekers', $job->id) }}">
                            <div class="form-row justify-content-center ext-box">
                                <div class="col-2">
                                    <label class="sr-only" for="age_term">Age</label>
                                    <select name="age_term" id="age_term" class="form-control">
                                        <option value="">-- Age --</option>
                                        <option value="18-24" @if(request('age_term')=="18-24"){{"selected"}} @endif>18-24</option>
                                        <option value="25-35" @if(request('age_term')=="25-35"){{"selected"}} @endif>25-35</option>
                                        <option value="36-45" @if(request('age_term')=="36-45"){{"selected"}} @endif>36-45</option>
                                        <option value="46-60" @if(request('age_term')=="46-60"){{"selected"}} @endif>46-60</option>
                                        <option value="Above 60" @if(request('age_term')=="Above 60"){{"selected"}} @endif>Above 60</option>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <label class="sr-only" for="qualification">Qualification</label>
                                    <select name="qualification" id="qualification" class="form-control">
                                        <option value="">-- Qualification --</option>
                                        @foreach ($qualifications as $qualification)
                                            <option value="{{ $qualification->name }}" @if(request('qualification')==$qualification->name){{"selected"}} @endif>{{ $qualification->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2">
                                    <label class="sr-only" for="field_of_study">Field of study</label>
                                    <select name="field_of_study" id="field_of_study" class="form-control">
                                        <option value="">-- Field of study --</option>
                                        @foreach ($field_of_studys as $field_of_study)
                                            <option value="{{ $field_of_study->name }}" @if(request('field_of_study')==$field_of_study->name){{"selected"}} @endif>{{ $field_of_study->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2">
                                    <label class="sr-only" for="salary">Salary</label>
                                    <select name="salary" id="salary" class="form-control">
                                        <option value="">-- Salary --</option>
                                        @foreach ($salarys as $salary)
                                            <option value="{{ $salary->name }}" @if(request('salary')==$salary->name){{"selected"}} @endif>RM {{ $salary->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2">
                                    <label class="sr-only" for="city">Age</label>
                                    <input type="text" class="form-control" id="city" name="city" placeholder="Type City" value="{{request('city')}}">
                                </div>
                                
                                <div class="col-1">
                                    <button type="submit" class="btn btn-primary text-capitalize btn-block">Search</button>
                                </div>
                                <div class="col-1">
                                    <a href="{{ route('availableJobseekers', $job->id) }}" class="btn btn-danger text-capitalize">Clear</a>
                                </div>
                            </div>
                        </form>
                    </div><!--  banner trand end   -->
                </div>
            </div><!--  /.row  -->
        </div><!--  /.container  -->
    </section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(isset($jobseekers))
                <form method="post" action="{{route('inviteProfessional', $job->id)}}">
                @csrf
                    <div class="text-center py-2">
                        <input onclick="return confirm('Are you sure?')" class="btn btn-success btn-sm" type="submit" value="Submit Selected Professionals">
                        @if ($errors->has('ids'))
                            <span class="badge badge-danger">Please Select at least one Jobseeker</span>
                        @endif
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row verticle-center">
                                @foreach ($jobseekers as $user)
                                <div class="col-md-2 mb-2 text-center" style="border: 1px solid #e6edee; height: 300px; padding-top: 10px;">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="ids[]" id="userid{{$user->id}}" value="{{$user->id}}">
                                        <label class="custom-control-label text-success" for="userid{{$user->id}}">Select</label>
                                    </div>
                                    <img class="img-thumbnail" src="{{$user->professional_profile->profile_image != '' ? asset('storage/resume/'.$user->professional_profile->profile_image) : asset('images/avatar.jpg')}}" style="height: 130px; width: 130px; border-radius: 50%; margin-bottom: 10px;" alt="{{$user->professional_profile->name ?? ''}}">
                                    <br>
                                    <a href="{{route('professional.show', $user->id)}}" class="btn btn-sm btn-block btn-primary" target="_blank">Details</a>
                                </div>
                                <div class="col-md-4 mb-2" style="border: 1px solid #e6edee; border-left: none; height: 300px; padding-top: 10px;">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <th width="35%">Position</th>
                                            <th width="5%">:</th>
                                            <td width="60%">{{$user->professional_profile->resume_headline ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <th width="35%">Name</th>
                                            <th width="5%">:</th>
                                            <td width="60%">{{$user->professional_profile->name ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <th width="35%">Age</th>
                                            <th width="5%">:</th>
                                            <td width="60%">{{$user->professional_profile->age() ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <th width="35%">City</th>
                                            <th width="5%">:</th>
                                            <td width="60%">{{$user->professional_profile->city ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <th width="35%">Salary</th>
                                            <th width="5%">:</th>
                                            <td width="60%">{{$user->professional_profile->expected_salary ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <th width="35%">Qualification</th>
                                            <th width="5%">:</th>
                                            <td width="60%">{{$user->professional_profile->highest_qualification ?? $user->qualifications->first()->qualification}}</td>
                                        </tr>
                                        <tr>
                                            <th width="35%">Field of Study</th>
                                            <th width="5%">:</th>
                                            <td width="60%">{{$user->professional_profile->subject ?? $user->qualifications->first()->subject}}</td>
                                        </tr>
                                    </table>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    </form>
                @endif
            </div><!--/.col-md-9-->
        </div><!--/.row-->
    </div><!--/.container-->
@endsection
