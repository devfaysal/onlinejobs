@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            @if(Session::has('message'))
            <div class="col-md-12">
                <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
                    <strong>{{ Session::get('message') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            @endif
            <div class="col-md-4 text-center">
                <div class="card">
                    @auth
                    @if(Auth::user()->id == $profile->user->id)
                        <a href="{{route('profile.edit', $profile->id)}}" class="btn btn-primary">Edit information</a>
                    @endif
                    @endauth
                    <h1 class="card-title">{{$profile->name}}</h1>
                    <div class="card-body">
                        <img class="thumbnail center-thumbnail-image" src="{{$profile->full_image != '' ? asset('storage/'.$profile->full_image) :  asset('images/avatar_full.jpg')}}" alt="avatar">
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <h4 class="card-title text-center mt-3">Basic Information</h4>
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="row border-bottom">
                                <div class="col-md-6">
                                    <p class="profile-title">Name</p>
                                    <p class="profile-content">{{$profile->name ?? 'N/A'}}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="profile-title">Phone</p>
                                    <p class="profile-content">{{$profile->phone ?? 'N/A'}}</p>
                                </div>
                            </div>
                            <div class="row border-bottom">
                                <div class="col-md-6">
                                    <p class="profile-title">Gender</p>
                                    <p class="profile-content">{{$profile->gender_data->name ?? 'N/A'}}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="profile-title">Date of birth</p>
                                    <p class="profile-content">{{$profile->date_of_birth ?? 'N/A'}}</p>
                                </div>
                            </div>
                            <div class="row border-bottom">
                                <div class="col-md-6">
                                    <p class="profile-title">Nationality</p>
                                    <p class="profile-content">{{$profile->nationality_data->name ?? 'N/A'}}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="profile-title">Religion</p>
                                    <p class="profile-content">{{$profile->religion_data->name ?? 'N/A'}}</p>
                                </div>
                            </div>
                            <div class="row border-bottom">
                                <div class="col-md-6">
                                    <p class="profile-title">Native Language</p>
                                    <p class="profile-content">{{$profile->native_language_data->name ?? 'N/A'}}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="profile-title">Other Languages</p>
                                    <p class="profile-content">{{$profile->other_languages ?? 'N/A'}}</p>
                                </div>
                            </div>
                            <div class="row border-bottom">
                                <div class="col-md-6">
                                    <p class="profile-title">Marital Status</p>
                                    <p class="profile-content">{{$profile->marital_status_data->name ?? 'N/A'}}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="profile-title">Height</p>
                                    <p class="profile-content">{{$profile->height ?? 'N/A'}}</p>
                                </div>
                            </div>
                            <div class="row border-bottom">
                                <div class="col-md-6">
                                    <p class="profile-title">Weight</p>
                                    <p class="profile-content">{{$profile->weight ?? 'N/A'}}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="profile-title">Highest Education</p>
                                    <p class="profile-content">{{$profile->highest_education ?? 'N/A'}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="profile-title">Skill Level</p>
                                    <p class="profile-content">{{$profile->skill_level_data->name ?? 'N/A'}}</p>
                                </div>
                            </div>
                        </div>
                    </div><!--/.panel-body-->
                </div><!--/.panel panel-default-->
            </div><!--/.col-md-8-->
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-heading">
                        <h4 class="text-uppercase text-center mt-2">Work Experience 
                            @auth
                                @if(Auth::user()->id == $profile->user->id)
                                    <a class="btn btn-warning" href="{{route('experience.create')}}">Add Experience</a>
                                @endif
                            @endauth
                        </h4>
                    </div>
                    <div class="card-body">
                        @foreach ($experiences as $experience)
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row verticle-center">
                                    <div class="col-md-2">
                                        <p class="profile-title">Employer Name</p>
                                        <p class="profile-content">{{$experience->employer_name ?? 'N/A'}}</p>
                                    </div>
                                    <div class="col-md-2">
                                        <p class="profile-title">Country</p>
                                        <p class="profile-content">{{$experience->country_data->name ?? 'N/A'}}</p>
                                    </div>
                                    <div class="col-md-2">
                                        <p class="profile-title">From Date</p>
                                        <p class="profile-content">{{$experience->from_date ?? 'N/A'}}</p>
                                    </div>
                                    <div class="col-md-2">
                                        <p class="profile-title">To Date</p>
                                        <p class="profile-content">{{$experience->to_date ?? 'N/A'}}</p>
                                    </div>
                                    <div class="col-md-2">
                                        <p class="profile-title">Remark</p>
                                        <p class="profile-content">{{$experience->remark ?? 'N/A'}}</p>
                                    </div>
                                    <div class="col-md-2">
                                        @auth
                                            @if(Auth::user()->id == $profile->user->id)
                                                <a href="{{route('experience.edit', $experience->id)}}" class="btn btn-warning">Edit</a>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div><!--/.container-->
@endsection
