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
                @auth
                @if(Auth::user()->can('print'))
                    <div class="col-md-12 hidefromprint mb-3">
                        <a class="btn btn-success" href="" onclick="window.print();return false;">Print profile</a>
                    </div>
                @endif
                @endauth
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
                        <h4 class="card-title text-uppercase text-center mt-2">Other Information</h4>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="row border-bottom">
                                    <div class="col-md-6">
                                        <p class="profile-title">Willing to work on off days with compensation
                                        </p>
                                        <p class="profile-content">{{$profile->work_on_off_days_with_compensation == 1 ? 'Yes' : 'No'}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="profile-title">Able to handle pork</p>
                                        <p class="profile-content">{{$profile->able_to_handle_pork == 1 ? 'Yes' : 'No'}}</p>
                                    </div>
                                </div>
                                <div class="row border-bottom">
                                    <div class="col-md-6">
                                        <p class="profile-title">Able to gardening</p>
                                        <p class="profile-content">{{$profile->able_to_gardening == 1 ? 'Yes' : 'No'}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="profile-title">Able to care dog/cat</p>
                                        <p class="profile-content">{{$profile->able_to_care_dog_cat == 1 ? 'Yes' : 'No'}}</p>
                                    </div>
                                </div>
                                <div class="row border-bottom">
                                    <div class="col-md-6">
                                        <p class="profile-title">Able to simple sewing</p>
                                        <p class="profile-content">{{$profile->able_to_simple_sewing == 1 ? 'Yes' : 'No'}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="profile-title">Able to car wash</p>
                                        <p class="profile-content">{{$profile->able_to_wash_car == 1 ? 'Yes' : 'No'}}</p>
                                    </div>
                                </div>
                                <div class="row border-bottom">
                                    <div class="col-md-6">
                                        <p class="profile-title">Able to eat pork</p>
                                        <p class="profile-content">{{$profile->able_to_eat_pork == 1 ? 'Yes' : 'No'}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="profile-title">Care of infants/children</p>
                                        <p class="profile-content">{{$profile->able_to_care_infants == 1 ? 'Yes' : 'No'}}</p>
                                    </div>
                                </div>
                                <div class="row border-bottom">
                                    <div class="col-md-6">
                                        <p class="profile-title">Care of elderly</p>
                                        <p class="profile-content">{{$profile->able_to_care_elderly == 1 ? 'Yes' : 'No'}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="profile-title">Care of disabled</p>
                                        <p class="profile-content">{{$profile->able_to_care_disabled == 1 ? 'Yes' : 'No'}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="profile-title">General housework</p>
                                        <p class="profile-content">{{$profile->able_to_do_general_housework == 1 ? 'Yes' : 'No'}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="profile-title">Cooking</p>
                                        <p class="profile-content">{{$profile->able_to_cook == 1 ? 'Yes' : 'No'}}</p>
                                    </div>
                                </div>
                            </div>
                        </div><!--/.panel-body-->
                    </div><!--/.panel panel-default-->
                </div>
        </div><!--/.row-->
    </div><!--/.container-->
@endsection
