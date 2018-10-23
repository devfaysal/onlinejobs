@extends('admin.layouts.master')
@section('content')
    <div class="title-block">
        <h1 class="title"> Employer Demands </h1>
    </div>
    <section class="section">
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

                    @if(Auth::user()->hasRole('agent') && Auth::user()->status == 1)
                        <th title="Hired Quantity">Hired Qty</th>
                        <th title="Status">Status</th>
                        <th title="Proposed General Worker">Proposed GW</th>
                    @else
                        <th title="Final Quantity">Final Qty</th>
                        <th title="Status">Status</th>
                        <th title="Assigned Agent">Assigned Agent</th>
                    @endif
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

                    @if(Auth::user()->hasRole('agent') && Auth::user()->status == 1)
                        <th title="Hired Quantity">Hired Qty</th>
                        <th title="Status">Status</th>
                        <th title="Proposed General Worker">Proposed GW</th>
                    @else
                        <th title="Final Quantity">Final Qty</th>
                        <th title="Status">Status</th>
                        <th title="Assigned Agent">Assigned Agent</th>
                    @endif
                    <th title=""></th>
                </tr>
            </tfoot>
        </table>
    </section>

    @if(Auth::user()->hasRole('agent') && Auth::user()->status == 1)
    <!-- Select GW Modal -->
    <div class="modal fade" id="selectGWModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content tex-center">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle"> Select General Workers </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-md-center">
                        <div class="col-md-12">

                            <form method="post" action="{{route('admin.selectGWToDemand')}}">
                            @csrf

                                <input type="hidden" id="demandID" name="demandID" value="">
                                <table id="workers-table" class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <!-- <th>Id</th> -->
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Passport</th>
                                            <th>Country</th>
                                            <!-- <th>Date of Birth</th> -->
                                            <!-- <th>Marital Status</th> -->
                                            <th>Status</th>
                                            <th></th>
                                            <th><input onclick="return confirm('Are you sure?')" class="btn btn-success btn-sm pull-right" type="submit" value="Send Offer"></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <!-- <th>Id</th> -->
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Passport</th>
                                            <th>Country</th>
                                            <!-- <th>Date of Birth</th> -->
                                            <!-- <th>Marital Status</th> -->
                                            <th>Status</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </form>




                            {{--<form method="POST" action="{{ route('saveDemand') }}" aria-label="{{ __('Save Demand') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <select name="AgentAssign" id="AgentAssign" class="form-control{{ $errors->has('AgentAssign') ? ' is-invalid' : '' }}">
                                        <option value="">-- Select an Agent --</option>
                                        @foreach ($agents as $agent)
                                            <option value="{{$agent->id}}" {{$agent->id == old('AgentAssign') ? 'selected':''}}>{{$agent->name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('AgentAssign'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('AgentAssign') }}</strong>
                                        </span>
                                    @endif
                                </div>
        
                                <div class="form-group mb-0 text-center">
                                    <button type="submit" class="btn btn-warning btn-block">
                                        {{ __('Assign') }}
                                    </button>
                                </div>
                            </form>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div><!--  /.modal-dialog modal-dialog-centered  -->
    </div><!--  /.modal fade  -->
    <!-- /.Login Modal -->
    @else
    <!-- Assign Agent Modal -->
    <div class="modal fade" id="assignDemandAgentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content tex-center">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle"> Assign an Agent </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="row justify-content-md-center">
                        <div class="col-md-11">
                            <form method="POST" action="{{ route('admin.assignDemandAgent') }}" aria-label="{{ __('Assign Demand Agent') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" id="demandID" name="demandID" value="">
                                    <select name="AgentAssign" id="AgentAssign" class="form-control{{ $errors->has('AgentAssign') ? ' is-invalid' : '' }}">
                                        <option value="">-- Select an Agent --</option>
                                        @foreach ($agents as $agent)
                                            <option value="{{$agent->id}}" {{$agent->id == old('AgentAssign') ? 'selected':''}}>{{$agent->name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('AgentAssign'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('AgentAssign') }}</strong>
                                        </span>
                                    @endif
                                </div>
        
                                <div class="form-group mb-0 text-center">
                                    <button type="submit" class="btn btn-warning btn-block">
                                        {{ __('Assign Demand Agent') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--  /.modal-dialog modal-dialog-centered  -->
    </div><!--  /.modal fade  -->
    <!-- /.Login Modal -->
    @endif

@endsection
@section('javascript')
<script>
    // get Demand Id as hidden value
    $(document).on("click", '.btn-assign-agent, .btn-selectGW', function (e) {
        var demandID = $(this).attr('demandID');
        $("#demandID").attr('value', demandID);
    });

    // demand table list
    $('#demands-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route('admin.getEmployersDemandData')}}',
        columns: [
            {data: 'employer_name', name: 'employer_name'},
            {data: 'demand_letter_no', name: 'demand_letter_no'},
            {data: 'expexted_date', name: 'expexted_date', "className": "text-center"},
            {data: 'demand_qty', name: 'demand_qty', "className": "text-center"},
            {data: 'proposed_qty', name: 'proposed_qty', "className": "text-center"},
            {data: 'day_pending', name: 'day_pending', "className": "text-center"},
            {data: 'selected_qty', name: 'selected_qty', "className": "text-center"},
            {data: 'final_qty', name: 'final_qty', "className": "text-center"},
            {data: 'status', name: 'status', "className": "text-center"},

            @if(Auth::user()->hasRole('agent') && Auth::user()->status == 1)
                {data: 'proposed_gw', name: 'proposed_gw', "className": "text-center"},
            @else
                {data: 'assigned_agent', name: 'assigned_agent', "className": "text-center"},
            @endif
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



    // workers table
    $('#workers-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route('admin.getWorkersData')}}',
        columns: [
            // {data: 'id', name: 'id'},
            {data: 'image', name: 'image', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'passport', name: 'passport'},
            {data: 'country', name: 'country'},
            // {data: 'date_of_birth', name: 'date_of_birth'},
            // {data: 'marital_status', name: 'marital_status'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            {data: 'selectQW', name: 'selectQW', orderable: false, searchable: false}
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