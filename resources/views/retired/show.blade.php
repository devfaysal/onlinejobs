@extends('layouts.app')

@section('content')
<div class="container mt-4 mb-5">
    <div class="row justify-content-md-center">
        <div class="col-md-12">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-11 ml-auto mr-auto">
                            <h4 class="mb-0">{{$user->name}}
                                @if(Auth::id() == $user->id)
                                    <a class="text-white" href="{{route('retiredPersonnel.edit', $user->id)}}"> <i class="ml-3 fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                @endif
                            </h4>

                            <div class="row">
                                <div class="col-md-5">
                                    <p class="mb-0"><i class="mr-3 fa fa-map-marker" aria-hidden="true"></i> {{$user->retired_personnel->address}}</p>
                                    <p class="mb-0"><i class="mr-3 fa fa-map-marker" aria-hidden="true"></i> {{$user->retired_personnel->state}} , {{$user->retired_personnel->country}}</p>
                                </div>
                                <div class="col-md-5">
                                    <p class="mb-0"><i class="mr-2 fa fa-phone" aria-hidden="true"></i> {{$user->retired_personnel->phone}}</p>
                                    <p class="mb-0"><i class="mr-2 fa fa-envelope-o" aria-hidden="true"></i> {{$user->retired_personnel->email}}</p>
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
                            @if($user->retired_personnel->resume_file)
                                <a class="mt-2 btn btn-sm btn-secondary" target="_blank" href="{{asset('storage/resume/'.$user->retired_personnel->resume_file)}}">View Resume</a>
                            @endif
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
                            <p>Personal Details</p>
                            <p>Attach Resume</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <h4>Employment 
                                @if(Auth::id() == $user->id)
                                    <a class="text-black" href="{{route('retiredPersonnelExperience.edit', $user->id)}}"> <i class="ml-3 fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                @endif
                            </h4>
                            @foreach($user->retired_personnel_experiences as $experience)
                                <div class="mt-1">
                                    <p class="mb-0">{{$experience->position}}</p>
                                    <p class="mb-0">{{$experience->company_name}}</p>
                                    <p class="mb-0">{{\Carbon\Carbon::parse($experience->from)->format('M-Y') }} to {{\Carbon\Carbon::parse($experience->to)->format('M-Y') }}</p>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-body">
                            <h4>Education
                                @if(Auth::id() == $user->id)
                                    <a class="text-black" href="{{route('retiredPersonnel.edit', $user->id)}}"> <i class="ml-3 fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                @endif
                            </h4>
                            <p class="mb-0"><strong>Highest Academic Qualification:</strong> {{$user->retired_personnel->highest_academic_qualification}}</p>
                            <p class="mb-0"><strong>Specialization:</strong> {{$user->retired_personnel->specialization}}</p>
                            <hr>
                            @foreach($user->retired_personnel_educations as $education)
                                <div class="mt-1">
                                    <p class="mb-0"><strong>Academic Qualification:</strong> {{$education->academic_qualification}}</p>
                                    <p class="mb-0"><strong>Specialization:</strong> {{$education->specialization}}</p>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                    @if($user->retired_personnel_language->count() > 0)
                    <div class="card mt-4">
                        <div class="card-body">
                            <h4>Language 
                                @if(Auth::id() == $user->id)
                                    <a class="text-black" href="{{route('retiredPersonnelsLanguage.edit', $user->id)}}"> <i class="ml-3 fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                @endif
                            </h4>
                            @foreach($user->retired_personnel_language as $language)
                                <div class="mt-1">
                                    <p class="mb-0">{{$language->language}}</p>
                                    <p class="mb-0">{{$language->speaking}}</p>
                                    <p class="mb-0">{{$language->writing}}</p>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <div class="card mt-4">
                        <div class="card-body">
                            <h4>Health 
                                @if(Auth::id() == $user->id)
                                    <a class="text-black" href="{{route('retiredPersonnel.edit', $user->id)}}"> <i class="ml-3 fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                @endif
                            </h4>
                            <p class="mb-0"><strong>Health Statement: </strong> {{$user->retired_personnel->health_statement }}</p>
                            <p class="mb-0"><strong>Additional Health Information: </strong> {{$user->retired_personnel->additional_health_statement }}</p>
                            <p class="mb-0"><strong>Fit to work ? </strong> {{$user->retired_personnel->fit_to_work }}</p>
                            <p class="mb-0"><strong>Have blood pressure ? </strong> {{$user->retired_personnel->have_blood_pressure }}</p>
                            <p class="mb-0"><strong>Have diabetes ? </strong> {{$user->retired_personnel->have_diabetes }}</p>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-body">
                            <h4>Other Info 
                                @if(Auth::id() == $user->id)
                                    <a class="text-black" href="{{route('retiredPersonnel.edit', $user->id)}}"> <i class="ml-3 fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                @endif
                            </h4>
                            <p class="mb-0"><strong>Were you government servent ? </strong> {{$user->retired_personnel->government_employee }}</p>
                            <p class="mb-0"><strong>Prefer Working hours: </strong> {{$user->retired_personnel->full_time ? 'Full Time' : $user->retired_personnel->describe_working_hours}}</p>
                            <p class="mb-0"><strong>NRIC </strong> {{$user->retired_personnel->nric }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection