@extends('layouts.app')

@section('content')
<section class="banner" style="min-height: 350px;background-size: 108%;background:url(/images/Professional.png) no-repeat fixed;">

        @include('layouts.topbar')

        <!--  banner body and search   -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-3 text-white text-uppercase text-center" style="border-bottom: 1px solid;">
                        Professionals
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
                                    </select>
                                </div>
                                
                                <div class="col-3">
                                    <button type="submit" class="btn btn-primary text-capitalize btn-block">Search Professional</button>
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
                    <!-- <h1>Search Results</h1> -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row verticle-center">
                                @foreach ($jobseekers as $user)
                                <div class="col-md-2 mb-2 text-center" style="border: 1px solid #e6edee; height: 210px; padding-top: 10px;">
                                    <img class="img-thumbnail" src="{{$user->professional_profile->profile_image != '' ? asset('storage/'.$user->professional_profile->profile_image) : asset('images/avatar.jpg')}}" style="height: 130px; width: 130px; border-radius: 50%; margin-bottom: 10px;" alt="{{$user->professional_profile->profile_image ?? ''}}">
                                    <br>
                                    <a href="{{route('professional.show', $user->id)}}" class="btn btn-block btn-primary" target="_blank">Details</a>
                                </div>
                                <div class="col-md-4 mb-2" style="border: 1px solid #e6edee; border-left: none; height: 210px; padding-top: 10px;">
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
                                    </table>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div><!--/.col-md-9-->
        </div><!--/.row-->
    </div><!--/.container-->
@endsection
