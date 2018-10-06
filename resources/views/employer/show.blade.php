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
                    <h4 class="card-title text-center mt-3">Employer Information</h4>
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="row border-bottom">
                                <div class="col-md-4">
                                    <p class="profile-title">Employer Name</p>
                                    <p class="profile-content">{{$employer->name ?? 'N/A'}}</p>
                                </div>
                                <div class="col-md-4">
                                    <p class="profile-title">Address</p>
                                    <p class="profile-content">{{$employer->employer_profile->company_address ?? 'N/A'}}</p>
                                </div>
                            </div>
                        </div>
                    </div><!--/.panel-body-->
                </div><!--/.panel panel-default-->
                <div class="card">
                        <h4 class="card-title text-center mt-3">All Domestic Maids</h4>
                    <div class="card-body">
                        <table id="maids-table" class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Registered On</th>
                                    <th>Last Modified</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card">
                        <h4 class="card-title text-center mt-3">All General Workers</h4>
                    <div class="card-body">
                        <table id="workers-table" class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Registered On</th>
                                    <th>Last Modified</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                </tr>
                            </tfoot>
                        </table>
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
            {data: 'email', name: 'email'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
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
    $('#workers-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route('getAllWorkers')}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
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
@endsection