@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            {{-- @if(Session::has('message'))
                <div class="col-md-12">
                    <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('message') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif --}}
            <div class="col-md-12 ml-auto mr-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h1>Welcome {{$employer->employer_profile->company_name}}</h1>
                                @if(Auth::user()->status == 1)
                                {{-- <p>Offer Sent: 25 <br/> Hired: 18</p> --}}

                                @else
                                <p class="text-danger">Your Employer Applications under review</p>
                                @endif
                            </div>
                            <div class="col-md-6 text-right">
                                <strong>Address</strong><br/>
                                <span>{{$employer->employer_profile->address ?? 'N/A'}}</span><br/>
                                <span>{{$employer->employer_profile->country_data->name ?? 'N/A'}}</span>
                            </div>

                            @if(Auth::user()->status == 1)
                            <div class="col-md-12">
                                <hr>
                                {{-- <a class="btn btn-info btn-sm pull-left" href="#downloads"> <i class="fa fa-download"></i> Download files</a> --}}
                                @if($employer->employer_profile->looking_for_pro == 'yes')
                                    <a class="btn btn-success btn-sm ml-3" href="{{route('job.create')}}">Post a Job</a>
                                @endif
                                @if($employer->employer_profile->looking_for_gw == 'yes')
                                    <a class="btn btn-warning btn-sm ml-3" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#demandModal" href="#">Send a Demand</a>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div><!--/.panel-body-->
                </div><!--/.panel panel-default-->
                {{-- <div class="card mt-4">
                    <div class="card-body">
                        <canvas id="myChart" width="75%" height="20vh"></canvas>
                    </div>
                </div> --}}
                @if(Auth::user()->status == 1)
                @if($employer->employer_profile->looking_for_pro == 'yes')
                {{-- Jobs Posted --}}
                <div class="card mt-4">
                    <h4 class="card-title text-center mt-3">
                        All Jobs
                    </h4>
                    <div class="card-body">
                        <table id="jobs-table" class="my_datatable table table-condensed">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Positions Name</th>
                                    <th>Vacancies</th>
                                    <th>Closing Date</th>
                                    <th>Nature</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="hide"></th>
                                    <th>Positions Name</th>
                                    <th>Vacancies</th>
                                    <th>Closing Date</th>
                                    <th>Nature</th>
                                    <th class="hide">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                @endif
                @if($employer->employer_profile->looking_for_gw == 'yes')
                <!-- Demands list -->
                <div class="card mt-4">
                    <h4 class="card-title text-center mt-3">
                        
                        Demand for Foreign Workers
                        
                        <a class="btn btn-warning btn-sm mb-2 mr-2 pull-right" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#demandModal" href="#">Send a Demand</a>
                    </h4>
                    <div class="card-body">
                        <table id="demands-table" class="my_datatable table table-condensed">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th title="Approval KDN No">KDN No</th>
                                    <th title="Company">Company</th>
                                    <th title="Issue Date">Issue Date</th>
                                    <th title="Expected Join Date">EJ Date</th>
                                    <th title="Demand Quantity">D. Qty</th>
                                    <th title="Proposed Quantity">Proposed Qty</th>
                                    <th title="Day Pending">Day Pending</th>
                                    <th title="Confirmed Quantity">Confirmed Qty</th>
                                    <th title="Final Quantity">Final Qty</th>
                                    <th title="Status">Status</th>
                                    <th title=""></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="hide"></th>
                                    <th title="Approval KDN No">KDN No</th>
                                    <th title="Company">Company</th>
                                    <th title="Issue Date">Issue Date</th>
                                    <th title="Expected Join Date">EJ Date</th>
                                    <th title="Demand Quantity">D. Qty</th>
                                    <th title="Proposed Quantity">Proposed Qty</th>
                                    <th title="Day Pending">Day Pending</th>
                                    <th title="Confirmed Quantity">Confirmed Qty</th>
                                    <th title="Final Quantity">Final Qty</th>
                                    <th title="Status">Status</th>
                                    <th class="hide" title=""></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                @endif
                <!-- Demand Entry Modal -->
                <div class="modal fade" id="demandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content tex-center">
                            <div class="modal-header">
                                <h5 class="modal-title text-center" id="exampleModalLongTitle"> Send a Demand Letter </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <div class="row justify-content-md-center">
                                    <div class="col-md-11">
                                        <form method="POST" action="{{ route('saveDemand') }}" aria-label="{{ __('Save Demand') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <select id="HiringPackage" class="form-control{{ $errors->has('HiringPackage') ? ' is-invalid' : '' }}" name="HiringPackage">
                                                        <option value="">-- Hiring Package --</option>
                                                        <option value="p1">Package 1</option>
                                                        <option value="p2">Package 2</option>
                                                        <option value="p3">Package 3</option>
                                                    </select>

                                                    @if ($errors->has('HiringPackage'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('HiringPackage') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input id="CompanyName" type="text" class="form-control{{ $errors->has('CompanyName') ? ' is-invalid' : '' }}" name="CompanyName" value="{{ old('CompanyName') }}" placeholder="Company Name*" required>

                                                    @if ($errors->has('CompanyName'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('CompanyName') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="IssueDate" class="pull-left">Issue Date*</label>
                                                    <input id="IssueDate" type="date" class="form-control{{ $errors->has('IssueDate') ? ' is-invalid' : '' }}" name="IssueDate" value="{{ old('IssueDate') }}" title="Issue Date*" required>

                                                    @if ($errors->has('IssueDate'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('IssueDate') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="ExpectedJoinDate" class="pull-left">Expected Join Date*</label>
                                                    <input id="ExpectedJoinDate" type="date" class="form-control{{ $errors->has('ExpectedJoinDate') ? ' is-invalid' : '' }}" name="ExpectedJoinDate" value="{{ old('ExpectedJoinDate') }}" title="Expected Join Date*" required>

                                                    @if ($errors->has('ExpectedJoinDate'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('ExpectedJoinDate') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <input id="DemandLetterNo" type="text" class="form-control{{ $errors->has('DemandLetterNo') ? ' is-invalid' : '' }}" name="DemandLetterNo" value="{{ old('DemandLetterNo') }}" placeholder="Approval KDN No*" required>

                                                    @if ($errors->has('DemandLetterNo'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('DemandLetterNo') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                {{-- <div class="form-group col-md-6">
                                                    <input id="demand_qty" type="text" class="form-control{{ $errors->has('demand_qty') ? ' is-invalid' : '' }}" name="demand_qty[]" value="{{ old('demand_qty') }}" placeholder="Demand Quantity*" required>

                                                    @if ($errors->has('demand_qty'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('demand_qty') }}</strong>
                                                        </span>
                                                    @endif
                                                </div> --}}
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <select name="preferred_country[]" id="preferred_country" class="form-control{{ $errors->has('preferred_country') ? ' is-invalid' : '' }}">
                                                        <option value="">-- Preferred Country --</option>
                                                        @foreach ($countrys as $country)
                                                            <option value="{{$country->id}}" {{$country->id == old('country') ? 'selected':''}}>{{$country->name}}</option>
                                                        @endforeach
                                                    </select>
    
                                                    @if ($errors->has('preferred_country'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('preferred_country') }}</strong>
                                                        </span>
                                                    @endif

                                                    <input id="demand_qty" type="text" class="mt-3 form-control{{ $errors->has('demand_qty') ? ' is-invalid' : '' }}" name="demand_qty[]" value="{{ old('demand_qty') }}" placeholder="Demand Quantity*">

                                                    @if ($errors->has('demand_qty'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('demand_qty') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <select name="preferred_country[]" id="preferred_country" class="form-control{{ $errors->has('preferred_country') ? ' is-invalid' : '' }}">
                                                        <option value="">-- Preferred Country --</option>
                                                        @foreach ($countrys as $country)
                                                            <option value="{{$country->id}}" {{$country->id == old('country') ? 'selected':''}}>{{$country->name}}</option>
                                                        @endforeach
                                                    </select>
    
                                                    @if ($errors->has('preferred_country'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('preferred_country') }}</strong>
                                                        </span>
                                                    @endif

                                                    <input id="demand_qty" type="text" class="mt-3 form-control{{ $errors->has('demand_qty') ? ' is-invalid' : '' }}" name="demand_qty[]" value="{{ old('demand_qty') }}" placeholder="Demand Quantity*">

                                                    @if ($errors->has('demand_qty'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('demand_qty') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <select name="preferred_country[]" id="preferred_country" class="form-control{{ $errors->has('preferred_country') ? ' is-invalid' : '' }}">
                                                        <option value="">-- Preferred Country --</option>
                                                        @foreach ($countrys as $country)
                                                            <option value="{{$country->id}}" {{$country->id == old('country') ? 'selected':''}}>{{$country->name}}</option>
                                                        @endforeach
                                                    </select>
    
                                                    @if ($errors->has('preferred_country'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('preferred_country') }}</strong>
                                                        </span>
                                                    @endif

                                                    <input id="demand_qty" type="text" class="mt-3 form-control{{ $errors->has('demand_qty') ? ' is-invalid' : '' }}" name="demand_qty[]" value="{{ old('demand_qty') }}" placeholder="Demand Quantity*">

                                                    @if ($errors->has('demand_qty'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('demand_qty') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                {{-- <div class="form-group col-md-4">
                                                    <select name="PreferredCountry2" id="PreferredCountry2" class="form-control{{ $errors->has('PreferredCountry2') ? ' is-invalid' : '' }}">
                                                        <option value="">-- Preferred Country 2 --</option>
                                                        @foreach ($countrys as $country)
                                                            <option value="{{$country->id}}" {{$country->id == old('country') ? 'selected':''}}>{{$country->name}}</option>
                                                        @endforeach
                                                    </select>
    
                                                    @if ($errors->has('PreferredCountry2'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('PreferredCountry2') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <select name="PreferredCountry3" id="PreferredCountry3" class="form-control{{ $errors->has('PreferredCountry3') ? ' is-invalid' : '' }}">
                                                        <option value="">-- Preferred Country 3 --</option>
                                                        @foreach ($countrys as $country)
                                                            <option value="{{$country->id}}" {{$country->id == old('country') ? 'selected':''}}>{{$country->name}}</option>
                                                        @endforeach
                                                    </select>
    
                                                    @if ($errors->has('PreferredCountry3'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('PreferredCountry3') }}</strong>
                                                        </span>
                                                    @endif
                                                </div> --}}
                                            </div>
                                            <div class="form-group">
                                                <textarea id="Comments" class="form-control{{ $errors->has('Comments') ? ' is-invalid' : '' }}" name="comments" value="{{ old('Comments') }}" placeholder="Comments"></textarea>

                                                @if ($errors->has('Comments'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('Comments') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label class="pull-left" for="">Demand Letter</label>
                                                    <input id="DemandFile" type="file" class="form-control-file{{ $errors->has('DemandFile') ? ' is-invalid' : '' }}" name="DemandFile" title="Upload demand letter">
                                                    <p class="text-left small">Supported file PDF, JPG and PNG. Max file size: 1MB</p>
                                                </div>

                                                @if ($errors->has('DemandFile'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('DemandFile') }}</strong>
                                                    </span>
                                                @endif
                                                <div class="form-group col-md-6">
                                                    <label class="pull-left" for="">KDN, Quota Approval and Levy Receipt</label>
                                                    <input id="approvalQuotaAndLevy" type="file" class="form-control-file{{ $errors->has('approvalQuotaAndLevy') ? ' is-invalid' : '' }}" name="approvalQuotaAndLevy" title="KDN, Quota Approval and Levy Receipt">
                                                    <p class="text-left small">Supported file PDF, JPG and PNG. Max file size: 1MB</p>
                                                </div>

                                                @if ($errors->has('approvalQuotaAndLevy'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('approvalQuotaAndLevy') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                    
                                            <div class="form-group mb-0 text-center">
                                                <button type="submit" class="btn btn-warning btn-block">
                                                    {{ __('Send') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--  /.modal-dialog modal-dialog-centered  -->
                </div><!--  /.modal fade  -->
                <!-- /.Login Modal -->
                @if($employer->employer_profile->looking_for_dm == 'yes')
                <!-- GW list for Employer -->
                <div class="card mt-4">
                    <h4 class="card-title text-center mt-3">Domestic Maids</h4>
                    <div class="card-body">
                        <form method="post" action="{{route('sendOffer')}}">
                            @csrf
                            <table id="maids-table" class="my_datatable table table-condensed">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Passport</th>
                                        <th>Country</th>
                                        <th>Date of Birth</th>
                                        <th>Marital Status</th>
                                        <th>Status</th>
                                        <th><input onclick="return confirm('Are you sure?')" class="btn btn-success btn-sm pull-right" type="submit" value="Send Offer"></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th class="hide">Id</th>
                                        <th class="hide">Image</th>
                                        <th>Name</th>
                                        <th>Passport</th>
                                        <th>Country</th>
                                        <th>Date of Birth</th>
                                        <th>Marital Status</th>
                                        <th>Status</th>
                                        <th class="hide"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>
                    </div>
                </div>
                @endif
                @if($employer->employer_profile->looking_for_gw == 'yes' || $employer->employer_profile->looking_for_dm == 'yes')
                <!-- Downloads list -->
                <div class="card mt-4" id="downloads">
                    <h4 class="card-title text-center mt-3">Download files</h4>
                    <div class="card-body">
                        <table id="files-table" class="my_datatable table table-condensed">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th width="50%" title="File Title">Title</th>
                                    <th width="30%" title=""></th>
                                    <th width="20%" title="Updated">Updated</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="hide"></th>
                                    <th title="File Title">Title</th>
                                    <th title=""></th>
                                    <th title="Updated">Updated</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                @endif
                @endif
            </div><!--/.col-md-12-->
        </div>
    </div>
@endsection
@section('script')
<script>
    $('#demands-table').DataTable({
        order: [[ 0, 'desc' ]],
        processing: true,
        serverSide: true,
        ajax: '{{route('getAllDemands')}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'demand_letter_no', name: 'demand_letter_no', "className": "text-left"},
            {data: 'company_name', name: 'company_name'},
            {data: 'issue_date', name: 'issue_date', "className": "text-center"},
            {data: 'expexted_date', name: 'expexted_date', "className": "text-center"},
            {data: 'demand_qty', name: 'demand_qty', "className": "text-center"},
            {data: 'proposed_qty', name: 'proposed_qty', "className": "text-center"},
            {data: 'day_pending', name: 'day_pending', "className": "text-center"},
            {data: 'confirmed_qty', name: 'confirmed_qty', "className": "text-center"},
            {data: 'final_qty', name: 'final_qty', "className": "text-center"},
            {data: 'status', name: 'status', "className": "text-center"},
            {data: 'action', name: 'action', orderable: false, searchable: false, "className": "text-center"}
        ],
        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var input = document.createElement("input");
                input.className = 'form-control';
                $(input).appendTo($(column.footer()).empty())
                .on('keyup change', function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                    column.search(val ? val : '', true, false).draw();
                });
            });
            $('.hide input').hide();
        }
    });

    // maids table
    $('#maids-table').DataTable({
        order: [[ 0, 'desc' ]],
        processing: true,
        serverSide: true,
        ajax: '{{route('getAllMaids')}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'image', name: 'image', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'passport', name: 'passport'},
            {data: 'country', name: 'country'},
            {data: 'date_of_birth', name: 'date_of_birth'},
            {data: 'marital_status', name: 'marital_status'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var input = document.createElement("input");
                input.className = 'form-control';
                $(input).appendTo($(column.footer()).empty())
                .on('keyup change', function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                    column.search(val ? val : '', true, false).draw();
                });
            });
            $('.hide input').hide();
        }
    });

    // Files table
    $('#files-table').DataTable({
        order: [[ 0, 'desc' ]],
        processing: true,
        serverSide: true,
        ajax: '{{route('getDownloadsFile', 'emp')}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'action', name: 'action', orderable: false, searchable: false, "className": "text-center"},
            {data: 'updated_at', name: 'updated_at'}
        ],
        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var input = document.createElement("input");
                input.className = 'form-control';
                $(input).appendTo($(column.footer()).empty())
                .on('keyup change', function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                    column.search(val ? val : '', true, false).draw();
                });
            });
            $('.hide input').hide();
        }
    });
</script>
<script>
    $('#jobs-table').DataTable({
        order: [[ 0, "desc" ]],
        processing: true,
        serverSide: true,
        ajax: '{{route('admin.getJobsData')}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'positions_name', name: 'positions_name'},
            {data: 'total_number_of_vacancies', name: 'total_number_of_vacancies'},
            {data: 'closing_date', name: 'closing_date'},
            {data: 'job_vacancies_type', name: 'job_vacancies_type'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var input = document.createElement("input");
                input.className = 'form-control';
                $(input).appendTo($(column.footer()).empty())
                .on('keyup change', function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                    column.search(val ? val : '', true, false).draw();
                });
            });
            $('.hide input').hide();
        }
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
<script>

    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Domestic Maids Registered","Domestic Maids Hired", "General Workers Registered","General Workers Hired"],
            datasets: [{
                label: '',
                data: [856,330, 725,295],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(54, 162, 235, 0.5)',
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(54, 162, 235, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            },
            legend: { 
                display: false 
            }
        }
    });
</script>
<script type="text/javascript">
    function KeepCount() {                    
        var inputTags = document.getElementsByName('id[]');                  
        var total = 0;

        for (var i = 0; i < inputTags.length; i++) {

            if (inputTags[i].checked) {                      
                    total = total + 1;
            }

            if (total > 1) {
                alert('Please select only 1')
                inputTags[i].checked = false;
                return false;
            }
        }
    }
</script>
@endsection