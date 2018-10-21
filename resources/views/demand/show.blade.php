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
            <div class="col-md-12">
                <div class="card">
                    <h4 class="card-title text-center mt-3 text-uppercase">Demand Information</h4>
                    <div class="card-body">
                        <table class="table table-striped table-sm">
                            <tr>
                                <th>Hiring Package</th>
                                <th>:</th>
                                <td>{{$offer->hiring_package ?? 'N/A'}}</td>
                                <th>Company Name</th>
                                <th>:</th>
                                <td>{{$offer->company_name ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Issue Date</th>
                                <th>:</th>
                                <td>{{\Carbon\Carbon::parse($offer->issue_date)->format('d/m/Y')}}</td>
                                <th>Expected Join Date</th>
                                <th>:</th>
                                <td>{{\Carbon\Carbon::parse($offer->expexted_date)->format('d/m/Y')}}</td>
                            </tr>
                            <tr>
                                <th>Demand Letter No</th>
                                <th>:</th>
                                <td>{{$offer->demand_letter_no ?? 'N/A'}}</td>
                                <th>Demand Quantity</th>
                                <th>:</th>
                                <td>{{$offer->demand_qty ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Preferred Country</th>
                                <th>:</th>
                                <td>{{$offer->preferred_country->name ?? 'N/A'}}</td>
                                <th>Comments</th>
                                <th>:</th>
                                <td>{{$offer->comments ?? 'N/A'}}</td>
                            </tr>
                        </table>
                    </div><!--/.panel-body-->

                    <h4 class="card-title text-center mt-3 text-uppercase">Workers Details</h4>
                    <div class="card-body">
                        {{-- <table class="table table-striped table-sm">
                            <tr>
                                <th>Hiring Package</th>
                                <th>:</th>
                                <td>{{$offer->hiring_package ?? 'N/A'}}</td>
                                <th>Company Name</th>
                                <th>:</th>
                                <td>{{$offer->company_name ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Issue Date</th>
                                <th>:</th>
                                <td>{{\Carbon\Carbon::parse($offer->issue_date)->format('d/m/Y')}}</td>
                                <th>Expected Join Date</th>
                                <th>:</th>
                                <td>{{\Carbon\Carbon::parse($offer->expexted_date)->format('d/m/Y')}}</td>
                            </tr>
                            <tr>
                                <th>Demand Letter No</th>
                                <th>:</th>
                                <td>{{$offer->demand_letter_no ?? 'N/A'}}</td>
                                <th>Demand Quantity</th>
                                <th>:</th>
                                <td>{{$offer->demand_qty ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <th>Preferred Country</th>
                                <th>:</th>
                                <td>{{$offer->preferred_country->name ?? 'N/A'}}</td>
                                <th>Comments</th>
                                <th>:</th>
                                <td>{{$offer->comments ?? 'N/A'}}</td>
                            </tr>
                        </table> --}}
                    </div><!--/.panel-body-->
                </div><!--/.panel panel-default-->
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </div><!--/.container-->
@endsection
