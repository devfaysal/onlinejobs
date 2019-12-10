@extends('admin.layouts.master')
@section('content')
    <div class="title-block">
        <h1 class="title"> {{ $job->positions_name}} </h1>
        <p>{{ $job->total_number_of_vacancies }} {{ $job->job_vacancies_type }} vacancy open</p>
        @if($job->suggested_jobseekers != null)
        <p><span class="badge badge-success">{{count($job->suggested_jobseekers)}} Jobseekers Suggested</span></p>
        @endif
    </div>
    <section class="section">
        <h1>Available Jobseekers</h1>
        <form method="post" action="{{route('admin.job.sendSuggesion', $job->id)}}">
            @csrf
            <table id="resume-table" class="my_datatable table table-condensed">
                <thead>
                    <tr>
                        <th></th>
                        <th class="hide">Image</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Education</th>
                        <th>Position</th>
                        <th>City</th>
                        <th><input onclick="return confirm('Are you sure?')" class="btn btn-success btn-sm pull-right" type="submit" value="Suggest"></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="hide"></th>
                        <th class="hide">Image</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Education</th>
                        <th>Position</th>
                        <th>City</th>
                        <th class="hide">Action</th>
                    </tr>
                </tfoot>
            </table>
        </form>
    </section>
@endsection
@section('javascript')
<script>
$('#resume-table').DataTable({
    order: [[ 0, "desc" ]],
    processing: true,
    serverSide: true,
    ajax: '{{route('admin.job.getJobseekerByPosition', $job->id)}}',
    columns: [
        {data: 'id', name: 'id'},
        {data: 'profile_image', name: 'profile_image'},
        {data: 'name', name: 'name'},
        {data: 'age', name: 'age'},
        {data: 'education', name: 'education'},
        {data: 'position', name: 'position'},
        {data: 'city', name: 'city'},
        {data: 'action', name: 'action', orderable: false, searchable: false, class: 'd-flex'}
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