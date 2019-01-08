@extends('layouts.app')

@section('content')
<div class="container mt-4 mb-5">
    <div class="row justify-content-md-center">
        <div class="col-md-12">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1">
                            <img class="rounded-circle" style="width: 75px; height:75px;" src="{{$user->professional_profile->profile_image != '' ? asset('storage/resume/'.$user->professional_profile->profile_image) :  asset('images/dummy.jpg')}}">
                        </div>
                        <div class="col-md-8">
                            <h4 class="mb-0">{{$user->name}}
                                @if(Auth::id() == $user->id)
                                    <a class="text-white" href="{{route('professional.edit', $user->id)}}"> <i class="ml-3 fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                @endif
                            </h4>
                            <p>{{$user->professional_experiences[0]->designation}}, {{$user->professional_experiences[0]->company}}</p>

                            <div class="row">
                                <div class="col-md-5">
                                    <p class="mb-0"><i class="mr-3 fa fa-map-marker" aria-hidden="true"></i> {{$user->professional_profile->city}}, {{$user->professional_profile->country}}</p>
                                    <p class="mb-0"><i class="mr-2 fa fa-briefcase" aria-hidden="true"></i> {{$user->professional_profile->city}}</p>
                                    <p class="mb-0"><i class="mr-2 fa fa-money" aria-hidden="true"></i> {{$user->professional_profile->expected_salary}}</p>
                                </div>
                                <div class="col-md-5">
                                    <p class="mb-0"><i class="mr-2 fa fa-phone" aria-hidden="true"></i> {{$user->professional_profile->phone}}</p>
                                    <p class="mb-0"><i class="mr-2 fa fa-envelope-o" aria-hidden="true"></i> {{$user->professional_profile->email}}</p>
                                </div>
                                <div class="col-md-2">
                                    <p class="mb-0 bg-light text-center rounded text-uppercase text-primary">Verify</p>
                                    <p class="mb-0 text-right"><i class="fa-lg fa fa-check-circle-o" aria-hidden="true"></i></i></p>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <span>Profile Strength (Good)</span>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                                    </div>                          
                                </div>
                            </div>

                            @if($user->professional_profile->resume_file)
                                <a class="mt-2 btn btn-sm btn-secondary" target="_blank" href="{{asset('storage/resume/'.$user->professional_profile->resume_file)}}">View Resume</a>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info">
                                <div class="card-body">
                                    <p class="mb-0 font-weight-bold">Tips for getting noticed by recruiters</p>
                                    <p class="mb-0"><small>- Attach updated Resume</small></p>
                                    <p class="mb-0"><small>- Keep profile & contact details updated</small></p>
                                    <p class="mb-0"><small>- Make your resume headline stand out</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h4>Quick Links</h4>
                            <hr>
                            <p>Resume Headline</p>
                            <p>Key Skills</p>
                            <p>Employment</p>
                            <p>Educaition</p>
                            <p>IT SKills</p>
                            <p>Projects</p>
                            <p>Profile Summary</p>
                            <p>Acknowledgements</p>
                            <p>Desired Career Profile</p>
                            <p>Personal Details</p>
                            <p>Attach Resume</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <h4>Resume Headline
                                @if(Auth::id() == $user->id) 
                                    <a class="text-black" href="{{route('professional.edit', $user->id)}}"> <i class="ml-3 fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                @endif
                            </h4>
                            <p class="mb-0">{{$user->professional_profile->resume_headline}}</p>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-body">
                            <h4>Key Skills 
                                @if(Auth::id() == $user->id)
                                    <a class="text-black" href="{{route('professional.edit', $user->id)}}"> <i class="ml-3 fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                @endif
                            </h4>
                            @php
                                $skills = explode(",",$user->professional_profile->skills);
                            @endphp
                            @foreach ($skills as $skill)
                            <span class="d-inline-block pl-2 pr-2 pt-1 pb-1 mr-2 mb-2 border border-secondary">{{$skill}}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-body">
                            <h4>Employment 
                                @if(Auth::id() == $user->id)
                                    <a class="text-black" href="{{route('professionalExperience.edit', $user->id)}}"> <i class="ml-3 fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                @endif
                            </h4>
                            @foreach($user->professional_experiences as $experience)
                                <div class="mt-1">
                                    <p class="mb-0">{{$experience->designation}}</p>
                                    <p class="mb-0">{{$experience->company}}</p>
                                    <p class="mb-0">{{\Carbon\Carbon::parse($experience->from)->format('M-Y') }} to {{\Carbon\Carbon::parse($experience->to)->format('M-Y') }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-body">
                            <h4>Education 
                                @if(Auth::id() == $user->id)
                                    <a class="text-black" href="{{route('qualification.edit', $user->id)}}"> <i class="ml-3 fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                @endif
                            </h4>
                            @foreach($user->qualifications as $qualification)
                                <div class="mt-1">
                                    <p class="mb-0">{{$qualification->qualification}}</p>
                                    <p class="mb-0">{{$qualification->subject}}</p>
                                    <p class="mb-0">{{$qualification->specialization}}</p>
                                    <p class="mb-0">{{$qualification->university}}</p>
                                    <p class="mb-0">{{$qualification->passing_year}}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection