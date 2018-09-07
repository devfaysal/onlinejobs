@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif
                    <div class="col-md-4 text-center">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h1 class="text-warning">{{$profile->name}}</h1>
                                @auth
                                    @if(Auth::user()->id == $profile->user->id)
                                        <a href="{{route('profile.edit', $profile->id)}}" class="btn btn-warning">Edit information</a>
                                    @endif
                                @endauth
                            </div>
                            <div class="panel-body">
                                <img class="thumbnail center-thumbnail-image" src="{{$profile->full_image != '' ? asset('storage/'.$profile->full_image) :  asset('images/avatar_full.jpg')}}" alt="avatar">
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-8">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h4 class="text-uppercase">Basic Information</h4></div>
                            <div class="panel-body">
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
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="text-uppercase">Work Experience <a class="btn btn-warning" href="{{route('experience.create')}}">Add Experience</a></h4>
                            </div>
                            <div class="panel-body">
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
                </div><!--/.col-md-9-->
                <div class="col-md-3">
                    @include('layouts.sidebar')
                </div><!--/.col-md-3-->
            </div><!--/.row-->
        </div><!--/.container-->
    </div><!--/.content-->
@endsection
