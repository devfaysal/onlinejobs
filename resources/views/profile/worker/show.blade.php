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
                    <a class="btn btn-info" href="{{url()->previous()}}">Back</a>
                    <a class="btn btn-success pull-right" href="" onclick="window.print();return false;">Print profile</a>
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
                        <table class="table table-striped">
                            <tr>
                                <th>Name :</th>
                                <td>{{$profile->name ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Date of Birth :</th>
                                <td>{{\Carbon\Carbon::parse($profile->date_of_birth)->format('d/m/Y')}}</td>
                            </tr>
                            <tr>
                                <th>Age :</th>
                                {{-- <td>{{ \Carbon\Carbon::parse($profile->date_of_birth)->diffForHumans() }}</td> --}}
                                <td>{{ \Carbon\Carbon::parse($profile->date_of_birth)->diff(\Carbon\Carbon::now())->format('%y years %m months')}}</td>
                            </tr>
                            <tr>
                                <th>Gender :</th>
                                <td>{{$profile->gender_data->name ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Marital Status :</th>
                                <td>{{$profile->marital_status ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Nationality :</th>
                                <td>{{$profile->nationality_data->name ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Highest Education :</th>
                                <td>{{$profile->highest_education ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Religion :</th>
                                <td>{{$profile->religion_data->name ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Height :</th>
                                <td>{{$profile->height ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Weight :</th>
                                <td>{{$profile->weight ?? 'N/A'}}</td>
                            </tr>
                        </table>
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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Employer Name</th>
                                    <th>Country</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Remark</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach ($experiences as $experience)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$experience->employer_name}}</td>
                                    <td>{{$experience->country_data->name ?? ''}}</td>
                                    <td>{{\Carbon\Carbon::parse($experience->from_date)->format('d/m/Y')}}</td>
                                    <td>{{\Carbon\Carbon::parse($experience->to_date)->format('d/m/Y')}}</td>
                                    <td>{{$experience->remark}}</td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div><!--/.container-->
@endsection
