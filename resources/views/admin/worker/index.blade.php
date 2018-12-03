@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="title-block">
            <h1 class="title"> General Workers @if(Auth::user()->hasRole('agent') && Auth::user()->status == 1)<a class="btn btn-success" href="/agent/createuser?t=gw">Add General Worker</a>@endif</h1>
        </div>
        <table id="users-table" class="table table-condensed">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Passport</th>
                    <th>Country</th>
                    <th>Date of Birth</th>
                    <th>Marital Status</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Passport</th>
                    <th>Country</th>
                    <th>Date of Birth</th>
                    <th>Marital Status</th>
                    <th>Status</th>
                </tr>
            </tfoot>
        </table>
    </section>
@endsection
@section('javascript')
<script>
    $('#users-table').DataTable({
        searching: false,
        processing: true,
        serverSide: true,
        ajax: '{{route('admin.getWorkersData')}}',
        columns: [
            {data: 'image', name: 'image'},
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
@endsection