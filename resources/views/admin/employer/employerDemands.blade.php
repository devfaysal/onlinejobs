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
        <table id="users-table" class="table table-condensed">
            <thead>
                <tr>
                    <th>Id</th>
                    <th title="Employer Name">Emp. Name</th>
                    <th>Phone</th>
                    <th>Entry</th>
                    <th>DNL</th>
                    <th title="Expected Join Date">EJD</th>
                    <th title="Demand Quantity">D. Qty</th>
                    <th title="Proposed Quantity">Proposed Qty</th>
                    <th>Day Pending</th>
                    <th>Selected Qty</th>
                    <th>Final Qty</th>
                    <th>Status</th>
                    <th>Assigned Agent</th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Id</th>
                    <th title="Employer Name">Emp. Name</th>
                    <th>Phone</th>
                    <th>Entry</th>
                    <th>DNL</th>
                    <th title="Expected Join Date">EJD</th>
                    <th title="Demand Quantity">D. Qty</th>
                    <th title="Proposed Quantity">Proposed Qty</th>
                    <th>Day Pending</th>
                    <th>Selected Qty</th>
                    <th>Final Qty</th>
                    <th>Status</th>
                    <th>Assigned Agent</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </section>
@endsection
@section('javascript')
<script>
    // $('#users-table').DataTable({
    //     processing: true,
    //     serverSide: true,
    //     ajax: '{{route('admin.getEmployersApplicationData')}}',
    //     columns: [
    //         {data: 'id', name: 'id'},
    //         {data: 'name', name: 'name'},
    //         {data: 'email', name: 'email'},
    //         {data: 'created_at', name: 'created_at'},
    //         {data: 'updated_at', name: 'updated_at'},
    //         {data: 'action', name: 'action', orderable: false, searchable: false}
    //     ],
    //     initComplete: function () {
    //         this.api().columns().every(function () {
    //             var column = this;
    //             var input = document.createElement("input");
    //             input.className = 'form-control';
    //             $(input).appendTo($(column.footer()).empty())
    //             .on('keyup change', function () {
    //                 var val = $.fn.dataTable.util.escapeRegex($(this).val());

    //                 column.search(val ? val : '', true, false).draw();
    //             });
    //         });
    //     }
    // });
</script>
@endsection