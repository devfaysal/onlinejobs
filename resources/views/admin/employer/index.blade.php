@extends('admin.layouts.master')
@section('content')
    <div class="title-block">
        <h1 class="title"> Employers </h1>
    </div>
    <section class="section">
        <table id="users-table" class="table table-condensed">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Company Name</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Registered On</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="hide">ID</th>
                    <th>Company Name</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th class="hide">Created At</th>
                    <th class="hide">Action</th>
                </tr>
            </tfoot>
        </table>
    </section>
@endsection
@section('javascript')
<script>
    $('#users-table').DataTable({
        order: [[ 5, "desc" ]],
        searching: false,
        processing: true,
        serverSide: true,
        ajax: '{{route('admin.getEmployersData')}}',
        columns: [
            {data: 'code', name: 'code'},
            {data: 'company_name', name: 'company_name'},
            {data: 'email', name: 'email'},
            {data: 'name', name: 'name'},
            {data: 'company_country', name: 'company_country'},
            {data: 'created_at', name: 'created_at'},
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
@endsection