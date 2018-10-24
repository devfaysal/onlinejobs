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
                                <td>{{$offer->preferred_country_data->name ?? 'N/A'}}</td>
                                <th>Attachment</th>
                                <th>:</th>
                                <td>
                                    @if ($offer->demand_file != '')
                                        <a href="{{ asset('storage/app/public/demand_letter/' . $offer->demand_file) }}" target="_blank">{{ $offer->demand_file }}</a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Comments</th>
                                <th>:</th>
                                <td colspan="4">{{$offer->comments ?? 'N/A'}}</td>
                            </tr>
                        </table>
                    </div><!--/.panel-body-->

                    <h4 class="card-title text-center mt-3 text-uppercase">Workers Details</h4>
                    <div class="card-body">
                        <form method="post" action="{{route('confirmGWToDemand')}}">
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
                                        <th><input onclick="return confirm('Are you sure?')" class="btn btn-success btn-sm pull-right" type="submit" value="Confirm"></th>
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
                    </div><!--/.panel-body-->
                </div><!--/.panel panel-default-->
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </div><!--/.container-->
@endsection



@section('script')
<script>

    // maids table
    $('#workers-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route('selectedGW', ['damand_id' => $offer->id])}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'image', name: 'image', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'passport', name: 'passport'},
            {data: 'country', name: 'country'},
            {data: 'date_of_birth', name: 'date_of_birth'},
            {data: 'marital_status', name: 'marital_status'},
            {data: 'status', name: 'status', "className": "text-center"},
            {data: 'action', name: 'action', orderable: false, searchable: false, "className": "text-left"}
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
@endsection
