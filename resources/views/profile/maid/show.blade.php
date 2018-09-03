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
                            <div class="panel-heading"><h1 class="text-warning">{{$profile->name}}</h1>
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
                                            <p class="profile-content">{{$profile->name}}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="profile-title">Phone</p>
                                            <p class="profile-content">{{$profile->phone}}</p>
                                        </div>
                                    </div>
                                    <div class="row border-bottom">
                                        <div class="col-md-6">
                                            <p class="profile-title">Gender</p>
                                            <p class="profile-content">{{$profile->gender_data ? $profile->gender_data->name : 'N/A'}}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="profile-title">Date of birth</p>
                                            <p class="profile-content">{{$profile->date_of_birth}}</p>
                                        </div>
                                    </div>
                                    <div class="row border-bottom">
                                        <div class="col-md-6">
                                            <p class="profile-title">Nationality</p>
                                            <p class="profile-content">{{$profile->nationality_data? $profile->nationality_data->name : 'N/A'}}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="profile-title">Religion</p>
                                            <p class="profile-content">{{$profile->religion_data? $profile->religion_data->name : 'N/A'}}</p>
                                        </div>
                                    </div>
                                    <div class="row border-bottom">
                                        <div class="col-md-6">
                                            <p class="profile-title">Native Language</p>
                                            <p class="profile-content">{{$profile->native_language_data? $profile->native_language_data->name : 'N/A'}}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="profile-title">Other Languages</p>
                                            <p class="profile-content">{{$profile->other_languages}}</p>
                                        </div>
                                    </div>
                                    <div class="row border-bottom">
                                        <div class="col-md-6">
                                            <p class="profile-title">Marital Status</p>
                                            <p class="profile-content">{{$profile->marital_status_data ? $profile->marital_status_data->name : 'N/A'}}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="profile-title">Height</p>
                                            <p class="profile-content">{{$profile->height}}</p>
                                        </div>
                                    </div>
                                    <div class="row border-bottom">
                                        <div class="col-md-6">
                                            <p class="profile-title">Weight</p>
                                            <p class="profile-content">{{$profile->weight}}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="profile-title">Highest Education</p>
                                            <p class="profile-content">{{$profile->highest_education}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="profile-title">Skill Level</p>
                                            <p class="profile-content">{{$profile->skill_level_data ? $profile->skill_level_data->name : 'N/A'}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.panel-body-->
                        </div><!--/.panel panel-default-->
                    </div><!--/.col-md-8-->
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h4 class="text-uppercase">Other Information</h4></div>
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <div class="row border-bottom">
                                        <div class="col-md-6">
                                            <p class="profile-title">Willing to work on off days with compensation
                                            </p>
                                            <p class="profile-content">{{$profile->work_on_off_days_with_compensation}}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="profile-title">Able to handle pork</p>
                                            <p class="profile-content">{{$profile->able_to_handle_pork}}</p>
                                        </div>
                                    </div>
                                    <div class="row border-bottom">
                                        <div class="col-md-6">
                                            <p class="profile-title">Able to gardening</p>
                                            <p class="profile-content">{{$profile->able_to_gardening}}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="profile-title">Able to care dog/cat</p>
                                            <p class="profile-content">{{$profile->able_to_care_dog_cat}}</p>
                                        </div>
                                    </div>
                                    <div class="row border-bottom">
                                        <div class="col-md-6">
                                            <p class="profile-title">Able to simple sewing</p>
                                            <p class="profile-content">{{$profile->able_to_simple_sewing}}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="profile-title">Able to car wash</p>
                                            <p class="profile-content">{{$profile->able_to_wash_car}}</p>
                                        </div>
                                    </div>
                                    <div class="row border-bottom">
                                        <div class="col-md-6">
                                            <p class="profile-title">Able to eat pork</p>
                                            <p class="profile-content">{{$profile->able_to_eat_pork}}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="profile-title">Care of infants/children</p>
                                            <p class="profile-content">{{$profile->able_to_care_infants}}</p>
                                        </div>
                                    </div>
                                    <div class="row border-bottom">
                                        <div class="col-md-6">
                                            <p class="profile-title">Care of elderly</p>
                                            <p class="profile-content">{{$profile->able_to_care_elderly}}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="profile-title">Care of disabled</p>
                                            <p class="profile-content">{{$profile->able_to_care_disabled}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="profile-title">General housework</p>
                                            <p class="profile-content">{{$profile->able_to_do_general_housework}}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="profile-title">Cooking</p>
                                            <p class="profile-content">{{$profile->able_to_cook}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/.panel-body-->
                        </div><!--/.panel panel-default-->
                    </div>
                </div><!--/.col-md-9-->
                <div class="col-md-3">
                    @include('layouts.sidebar')
                </div><!--/.col-md-3-->
            </div><!--/.row-->
        </div><!--/.container-->
    </div><!--/.content-->
@endsection
