@extends('admin.layouts.master')
@section('content')
    <div class="title-block">
        <h1 class="title"> Jobs </h1>
    </div>
    <section class="section">
        <table id="users-table" class="table table-condensed">
            <thead>
                <tr>
                    <th></th>
                    <th>Title</th>
                    <th>Company</th>
                    <th>Location</th>
                    <th>Nature</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="hide"></th>
                    <th>Title</th>
                    <th>Company</th>
                    <th>Location</th>
                    <th>Nature</th>
                    <th class="hide">Action</th>
                </tr>
            </tfoot>
        </table>
    </section>
@endsection
@section('javascript')
<script>
    $('#users-table').DataTable({
        order: [[ 0, "desc" ]],
        processing: true,
        serverSide: true,
        ajax: '{{route('admin.getJobsData')}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'company', name: 'company'},
            {data: 'location', name: 'location'},
            {data: 'nature', name: 'nature'},
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