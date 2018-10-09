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
                                <p>Offer Sent: 25 <br/> Hired: 18</p>
                            </div>
                            <div class="col-md-6">
                                <span>Address</span><br/>
                                <span>{{$employer->employer_profile->address}}</span><br/>
                                <span>{{$employer->employer_profile->country_data->name}}</span>
                                
                            </div>
                        </div>
                    </div><!--/.panel-body-->
                </div><!--/.panel panel-default-->
                <div class="card mt-4">
                    <div class="card-body">
                            <canvas id="myChart" width="75%" height="20vh"></canvas>
                    </div>
                </div>
                <div class="card mt-4">
                        <h4 class="card-title text-center mt-3">All Domestic Maids and General Workers</h4>
                    <div class="card-body">
                        <form method="post" action="{{route('sendOffer')}}">
                            <input style="float: right;" class="btn btn-success mb-2" type="submit" value="Send Offer">
                            @csrf
                        <table id="maids-table" class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Passport</th>
                                    <th>Country</th>
                                    <th>Date of Birth</th>
                                    <th>Marital Status</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Offer</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Passport</th>
                                    <th>Country</th>
                                    <th>Date of Birth</th>
                                    <th>Marital Status</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                    </div>
                </div>
            </div><!--/.col-md-12-->
        </div>
    </div>
@endsection
@section('script')
<script>
    $('#maids-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route('getAllMaids')}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'passport', name: 'passport'},
            {data: 'country', name: 'country'},
            {data: 'date_of_birth', name: 'date_of_birth'},
            {data: 'marital_status', name: 'marital_status'},
            {data: 'role', name: 'role'},
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