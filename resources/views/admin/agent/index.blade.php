@extends('admin.layouts.master')
@section('content')
    <div class="title-block">
        <h1 class="title"><span class="counter">{{$active_agent_count}}</span> Active Agents </h1>
    </div>
    <section class="section">
        <table id="users-table" class="table table-condensed">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Agency Name</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>Person Name</th>
                    <th>Phone</th>
                    <th>Registered On</th>
                    <th>Last Modified</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Agency Name</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>Person Name</th>
                    <th>Phone</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </tfoot>
        </table>
    </section>
@endsection
@section('javascript')
<script>
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route('admin.getAgentsData')}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'agency_registered_name', name: 'agency_registered_name'},
            {data: 'agency_email', name: 'agency_email'},
            {data: 'country', name: 'country'},
            {data: 'first_name', name: 'first_name'},
            {data: 'phone', name: 'contact_phone'},
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