@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-12">
                <div class="hidefromprint mt-4 mb-3">
                    @if(Auth::user()->hasRole(['superadministrator','employer']))
                    <a class="btn btn-info" href="{{url()->previous()}}">Back</a>
                    <a class="btn btn-success pull-right" href="" onclick="window.print();return false;">Print</a>
                    @endif
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                {{-- <h1>{{$employer->name}}</h1> --}}
                                <p>Offer Sent: 25 <br/> Hired: 18</p>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong>Address</strong><br/>
                                <span>{{$employer->employer_profile->address ?? 'N/A'}}</span><br/>
                                <span>{{$employer->employer_profile->country_data->name ?? 'N/A'}}</span>
                            </div>
                        </div>
                    </div><!--/.panel-body-->
                </div><!--/.panel panel-default-->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title text-center mt-3">Contact Information</h4>
                                <table class="table table-striped">
                                    <tr>
                                        <th>Employer Name :</th>
                                        <td>{{$employer->name ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Employer Phone :</th>
                                        <td>{{$employer->phone ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Employer Address :</th>
                                        <td>{{$employer->employer_profile->address ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Employer Country :</th>
                                        <td>{{$employer->employer_profile->country_data->name ?? 'N/A'}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h4 class="card-title text-center mt-3">Company Information</h4>
                                <table class="table table-striped">
                                    <tr>
                                        <th>Company Name :</th>
                                        <td>{{$employer->employer_profile->company_name ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Company Address :</th>
                                        <td>{{$employer->employer_profile->company_address ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>City :</th>
                                        <td>{{$employer->employer_profile->company_city ?? 'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <th>Country :</th>
                                        <td>{{$employer->employer_profile->company_country_data->name ?? 'N/A'}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div><!--/.card-body-->
                </div><!--/.card-->
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
@endsection