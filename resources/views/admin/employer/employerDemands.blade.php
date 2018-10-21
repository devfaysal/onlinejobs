@extends('admin.layouts.master')
@section('content')
    <div class="title-block">
        <h1 class="title"> Employer Demands </h1>
    </div>
    <section class="section">
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
        <table id="demands-table" class="table table-condensed">
            <thead>
                <tr>
                    <th title="Employer Name">Emp. Name</th>
                    <th title="Demand Letter No">DLN</th>
                    <th title="Expected Join Date">EJD</th>
                    <th title="Demand Quantity">D. Qty</th>
                    <th title="Proposed Quantity">Proposed Qty</th>
                    <th title="Day Pending">Day Pending</th>
                    <th title="Selected Quantity">Selected Qty</th>
                    <th title="Final Quantity">Final Qty</th>
                    <th title="Status">Status</th>
                    <th title="Assigned Agent">Assigned Agent</th>
                    <th title=""></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th title="Employer Name">Emp. Name</th>
                    <th title="Demand Letter No">DLN</th>
                    <th title="Expected Join Date">EJD</th>
                    <th title="Demand Quantity">D. Qty</th>
                    <th title="Proposed Quantity">Proposed Qty</th>
                    <th title="Day Pending">Day Pending</th>
                    <th title="Selected Quantity">Selected Qty</th>
                    <th title="Final Quantity">Final Qty</th>
                    <th title="Status">Status</th>
                    <th title="Assigned Agent">Assigned Agent</th>
                    <th title=""></th>
                </tr>
            </tfoot>
        </table>
    </section>
@endsection
@section('javascript')
<script>
    $('#demands-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route('admin.getEmployersDemandData')}}',
        columns: [
            {data: 'employer_name', name: 'employer_name'},
            {data: 'demand_letter_no', name: 'demand_letter_no'},
            {data: 'expexted_date', name: 'expexted_date', "className": "text-center"},
            {data: 'demand_qty', name: 'demand_qty', "className": "text-right"},
            {data: 'proposed_qty', name: 'proposed_qty', "className": "text-right"},
            {data: 'day_pending', name: 'day_pending', "className": "text-right"},
            {data: 'selected_qty', name: 'selected_qty', "className": "text-right"},
            {data: 'final_qty', name: 'final_qty', "className": "text-right"},
            {data: 'status', name: 'status', "className": "text-center"},
            {data: 'assigned_agent', name: 'assigned_agent', "className": "text-center"},
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
</script>
@endsection