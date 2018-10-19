@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-12">
                <div class="hidefromprint mt-4 mb-3">
                    @if(Auth::user()->hasRole('agent'))
                    <a class="btn btn-info" href="{{url()->previous()}}">Back</a>
                    @endif
                    <a class="btn btn-success pull-right" href="" onclick="window.print();return false;">Print</a>
                    @if(Auth::user()->hasRole('superadministrator'))
                    <a class="btn btn-info" href="/admin">Back</a>
                    <a class="btn btn-success" href="{{route('agent.print', [$profile->user->id,'license'])}}">Print License</a>
                    <a class="btn btn-success" href="{{route('agent.print', [$profile->user->id,'passport'])}}">Print Passport/NIC</a>
                    @endif
                </div>
                @if($data == 'license')
                    <p class="text-center">
                        @if($profile->license_file != null)
                        <img src="{{asset('storage/'.$profile->license_file)}}" alt="">
                        @else
                        No License File Found
                        @endif
                    </p>
                @elseif($data == 'passport')
                    <p class="text-center">
                        @if($profile->passport_file != null)
                        <img src="{{asset('storage/'.$profile->passport_file)}}" alt="">
                        @else
                        No Passport/NIC File Found
                        @endif
                    </p>
                @elseif($data == 'details')
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title text-center mt-3">Agency Information</h4>
                                    <table class="table table-striped">
                                        <tr>
                                            <th>Agency Registered Name :</th>
                                            <td>{{$profile->agency_registered_name ?? 'N/A'}}</td>
                                        </tr>
                                        <tr>
                                            <th>Agency Address :</th>
                                            <td>{{$profile->agency_address}}</td>
                                        </tr>
                                        <tr>
                                            <th>Agency City :</th>
                                            <td>{{$profile->agency_city}}</td>
                                        </tr>
                                        <tr>
                                            <th>Agency Country :</th>
                                            <td>{{$profile->country_data->name ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <th>Agency Phone :</th>
                                            <td>{{$profile->agency_phone}}</td>
                                        </tr>
                                        <tr>
                                            <th>Agency Email :</th>
                                            <td>{{$profile->agency_email}}</td>
                                        </tr>
                                        <tr>
                                            <th>Agency Fax :</th>
                                            <td>{{$profile->agency_fax}}</td>
                                        </tr>
                                        <tr>
                                            <th>License No :</th>
                                            <td>{{$profile->license_no}}</td>
                                        </tr>
                                        <tr>
                                            <th>License Issue Date :</th>
                                            <td>{{ \Carbon\Carbon::parse($profile->license_issue_date)->format('d/m/Y')}}</td>
                                        </tr>
                                        <tr>
                                            <th>License Expire Date :</th>
                                            <td>{{ \Carbon\Carbon::parse($profile->license_expire_date)->format('d/m/Y')}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="card-title text-center mt-3">Contact Information</h4>
                                    <table class="table table-striped">
                                        <tr>
                                            <th>First Name :</th>
                                            <td>{{$profile->first_name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Middle Name :</th>
                                            <td>{{$profile->middle_name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Last Name :</th>
                                            <td>{{$profile->last_name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Designation:</th>
                                            <td>{{$profile->designation}}</td>
                                        </tr>
                                        <tr>
                                            <th>Address:</th>
                                            <td>{{$profile->address}}</td>
                                        </tr>
                                        <tr>
                                            <th>Address:</th>
                                            <td>{{$profile->address}}</td>
                                        </tr>
                                        <tr>
                                            <th>Nationality:</th>
                                            <td>{{$profile->nationality_data->name ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <th>Passport/NIC:</th>
                                            <td>{{$profile->passport}}</td>
                                        </tr>
                                        <tr>
                                            <th>Phone Number:</th>
                                            <td>{{$profile->phone}}</td>
                                        </tr>
                                        <tr>
                                            <th>Email Address :</th>
                                            <td>{{$profile->email}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title text-center mt-3">License</h4>
                                    <p class="text-center">
                                        @if($profile->license_file != null)
                                        <img src="{{asset('storage/'.$profile->license_file)}}" alt="">
                                        @else
                                        No License File Found
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="card-title text-center mt-3">Passport/NIC</h4>
                                    <p class="text-center">
                                        @if($profile->passport_file != null)
                                        <img src="{{asset('storage/'.$profile->passport_file)}}" alt="">
                                        @else
                                        No Passport/NIC File Found
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div><!--/.card-body-->
                    </div><!--/.card-->
                @endif
            </div>
        </div>
    </div>
@endsection