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
            <div class="col-md-12 ml-auto mr-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h1>Welcome {{$employer->name}}</h1>
                                @if(Auth::user()->status == 1)
                                <p>Offer Sent: 25 <br/> Hired: 18</p>
                                @else
                                <p class="text-danger">Your Employer Applications under review</p>
                                @endif
                            </div>
                            <div class="col-md-6 text-right">
                                <strong>Address</strong><br/>
                                <span>{{$employer->employer_profile->address ?? 'N/A'}}</span><br/>
                                <span>{{$employer->employer_profile->country_data->name ?? 'N/A'}}</span>
                            </div>
                        </div>
                    </div><!--/.panel-body-->
                </div><!--/.panel panel-default-->
                <div class="card mt-4">
                    <div class="card-body">
                            <canvas id="myChart" width="75%" height="20vh"></canvas>
                    </div>
                </div>
                @if(Auth::user()->status == 1)
                <!-- Demands list -->
                <div class="card mt-4">
                    <h4 class="card-title text-center mt-3">
                        Demand Letters
                        <a class="btn btn-warning mb-2 mr-2 pull-right" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#demandModal" href="#">Send a Demand</a>
                    </h4>
                    <div class="card-body">
                        <table id="demands-table" class="table table-condensed">
                            <thead>
                                <tr>
                                    <th title="Demand Letter No">DLN</th>
                                    <th title="Company">Company</th>
                                    <th title="Issue Date">Issue Date</th>
                                    <th title="Expected Join Date">EJ Date</th>
                                    <th title="Demand Quantity">D. Qty</th>
                                    <th title="Proposed Quantity">Proposed Qty</th>
                                    <th title="Day Pending">Day Pending</th>
                                    <th title="Selected Quantity">Selected Qty</th>
                                    <th title="Final Quantity">Final Qty</th>
                                    <th title="Status">Status</th>
                                    <th title=""></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th title="Demand Letter No">DLN</th>
                                    <th title="Company">Company</th>
                                    <th title="Issue Date">Issue Date</th>
                                    <th title="Expected Join Date">EJ Date</th>
                                    <th title="Demand Quantity">D. Qty</th>
                                    <th title="Proposed Quantity">Proposed Qty</th>
                                    <th title="Day Pending">Day Pending</th>
                                    <th title="Selected Quantity">Selected Qty</th>
                                    <th title="Final Quantity">Final Qty</th>
                                    <th title="Status">Status</th>
                                    <th title=""></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- Demand Entry Modal -->
                <div class="modal fade" id="demandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
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
                                                    <input id="DemandLetterNo" type="text" class="form-control{{ $errors->has('DemandLetterNo') ? ' is-invalid' : '' }}" name="DemandLetterNo" value="{{ old('DemandLetterNo') }}" placeholder="Demand Letter No*" required>

                                                    @if ($errors->has('DemandLetterNo'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('DemandLetterNo') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input id="DemandQuantity" type="text" class="form-control{{ $errors->has('DemandQuantity') ? ' is-invalid' : '' }}" name="DemandQuantity" value="{{ old('DemandQuantity') }}" placeholder="Demand Quantity*" required>

                                                    @if ($errors->has('DemandQuantity'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('DemandQuantity') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <select name="PreferredCountry" id="PreferredCountry" class="form-control{{ $errors->has('PreferredCountry') ? ' is-invalid' : '' }}">
                                                    <option value="">-- Preferred Country --</option>
                                                    @foreach ($countrys as $country)
                                                        <option value="{{$country->id}}" {{$country->id == old('country') ? 'selected':''}}>{{$country->name}}</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('PreferredCountry'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('PreferredCountry') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <textarea id="Comments" class="form-control{{ $errors->has('Comments') ? ' is-invalid' : '' }}" name="Comments" value="{{ old('Comments') }}" placeholder="Comments"></textarea>

                                                @if ($errors->has('Comments'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('Comments') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <input onchange="previewFile('#image_preview', '#image')" id="DemandFile" type="file" class="form-control-file{{ $errors->has('DemandFile') ? ' is-invalid' : '' }}" name="DemandFile" title="Upload demand letter">
                                                    <p class="text-left small">Supported file format PDF, JPG, JPEG and PNG. Maximum file size: 1MB</p>
                                                </div>

                                                @if ($errors->has('DemandFile'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('DemandFile') }}</strong>
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

                <!-- GW list for Employer -->
                <div class="card mt-4">
                    <h4 class="card-title text-center mt-3">Domestic Maids</h4>
                    <div class="card-body">
                        <form method="post" action="{{route('sendOffer')}}">
                            @csrf
                        <table id="maids-table" class="table table-condensed">
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
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Passport</th>
                                    <th>Country</th>
                                    <th>Date of Birth</th>
                                    <th>Marital Status</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                    </div>
                </div>
                @endif
            </div><!--/.col-md-12-->
        </div>
    </div>
@endsection
@section('script')
<script>
    $('#demands-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route('getAllDemands')}}',
        columns: [
            {data: 'demand_letter_no', name: 'demand_letter_no', "className": "text-left"},
            {data: 'company_name', name: 'company_name'},
            {data: 'issue_date', name: 'issue_date', "className": "text-center"},
            {data: 'expexted_date', name: 'expexted_date', "className": "text-center"},
            {data: 'demand_qty', name: 'demand_qty', "className": "text-center"},
            {data: 'proposed_qty', name: 'proposed_qty', "className": "text-center"},
            {data: 'day_pending', name: 'day_pending', "className": "text-center"},
            {data: 'selected_qty', name: 'selected_qty', "className": "text-center"},
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
        }
    });

    // maids table
    $('#maids-table').DataTable({
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
@endsection