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
                        </div><!--/.card-body-->
                    </div><!--/.card-->
                </div><!--/.col-md-8-->
                <div class="col-md-12 mt-2">
                    <div class="card">
                            <h4 class="card-title text-center mt-3">Other Information</h4>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>Willing to work on off days with compensation :</th>
                                            <td>{{$profile->work_on_off_days_with_compensation == 1 ? 'Yes' : 'No'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Able to gardening :</th>
                                            <td>{{$profile->able_to_gardening == 1 ? 'Yes' : 'No'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Able to care dog/cat :</th>
                                            <td>Yes</td>
                                        </tr>
                                        <tr>
                                            <th>Able to simple sewing :</th>
                                            <td>Yes</td>
                                        </tr>
                                        <tr>
                                            <th>Care of disabled :</th>
                                            <td>Yes</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>Able to handle pork :</th>
                                            <td>{{$profile->able_to_handle_pork == 1 ? 'Yes' : 'No'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Able to car wash :</th>
                                            <td>Yes</td>
                                        </tr>
                                        <tr>
                                            <th>Care of infants/children :</th>
                                            <td>Yes</td>
                                        </tr>
                                        <tr>
                                            <th>Care of elderly :</th>
                                            <td>Yes</td>
                                        </tr>
                                        <tr>
                                            <th>General housework :</th>
                                            <td>Yes</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div><!--/.row-->
    </div><!--/.container-->
@endsection
