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
                    <h4 class="card-title text-center mt-3">Demand Requests</h4>
                    <div class="card-body">
                        <a class="btn btn-warning mb-2 pull-right" data-toggle="modal" data-target="#demandModal" href="#">Send a Demand</a>
                        <table id="demands-table" class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>DLN</th>
                                    <th>Company</th>
                                    <th>Issue Date</th>
                                    <th title="Expected Join Date">EJ Date</th>
                                    <th title="Demand Quantity">D. Qty</th>
                                    <th title="Proposed Quantity">Proposed Qty</th>
                                    <th>Day Pending</th>
                                    <th title="Selected Quantity">Selected Qty</th>
                                    <th title="Final Quantity">Final Qty</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <!-- <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>DLN</th>
                                    <th>Company</th>
                                    <th>Issue Date</th>
                                    <th title="Expected Join Date">EJ Date</th>
                                    <th title="Demand Quantity">D. Qty</th>
                                    <th>Proposed Qty</th>
                                    <th>Day Pending</th>
                                    <th>Selected Qty</th>
                                    <th>Final Qty</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </tfoot> -->
                        </table>
                    </div>
                </div>
                <!-- Demand Entry Modal -->
                <div class="modal fade" id="demandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content tex-center">
                            <div class="modal-header">
                                <h5 class="modal-title text-center" id="exampleModalLongTitle"> Send a Demand Request </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <div class="row justify-content-md-center">
                                    <div class="col-md-10">
                                        <form method="POST" action="#">
                                            @csrf
                                            <div class="form-group">
                                                <select id="HiringPackage" class="form-control" name="HiringPackage">
                                                    <option>--- Hiring Package ---</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input id="CompanyName" type="text" class="form-control" name="CompanyName" value="{{ old('CompanyName') }}" placeholder="Company Name*" required>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <input id="IssueDate" type="text" class="form-control" name="IssueDate" value="{{ old('IssueDate') }}" placeholder="Issue Date*" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input id="DemandLetterNo" type="text" class="form-control" name="DemandLetterNo" value="{{ old('DemandLetterNo') }}" placeholder="Demand Letter No*" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <input id="ExpectedJoinDate" type="text" class="form-control" name="ExpectedJoinDate" value="{{ old('ExpectedJoinDate') }}" placeholder="Expected Join Date*" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input id="DemandQuantity" type="text" class="form-control" name="DemandQuantity" value="{{ old('DemandQuantity') }}" placeholder="Demand Quantity*" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <select id="PreferredCountry" class="form-control" name="PreferredCountry">
                                                    <option>--- Preferred Country* ---</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <textarea id="Comments" class="form-control" name="Comments" value="{{ old('Comments') }}" placeholder="Comments"></textarea>
                                            </div>
                    
                                            <div class="form-group mb-0 text-center">
                                                <button type="submit" class="btn btn-warning btn-block">
                                                    {{ __('Send Request') }}
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
                    <h4 class="card-title text-center mt-3">General Workers</h4>
                    <div class="card-body">
                        <form method="post" action="{{route('sendOffer')}}">
                            <input onclick="return confirm('Are you sure?')" class="btn btn-success mb-2 pull-right" type="submit" value="Send Offer">
                            @csrf
                        <table id="workers-table" class="table table-condensed">
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
                                    <th>Offer</th>
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
                                    <th>Offer</th>
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
    $('#workers-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route('getAllWorkers')}}',
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