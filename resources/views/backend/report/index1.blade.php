@extends('backend.layouts.admin')

@section('title')
@endsection

@section('content')
<div class="content-body">
    <div class="container-fluid timesheet-container">
        <h3>Timesheet Summary</h3>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 border-end">
                            <div class="pt-3 pb-3 ps-0 pe-0 text-center">
                                <div class="pt-3 pb-3 ps-0 pe-0 text-center">
                                    <h4 class="m-1">Start Date</h4>
                                    <div class="input-group date justify-content-center" data-provide="datepicker">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar me-1"></i>
                                        </div>
                                        <input type="text" class="form-control p-0 from_date" readonly placeholder="DD-MM-YYYY" value="">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 border-end">
                            <div class="pt-3 pb-3 ps-0 pe-0 text-center">
                                <div class="pt-3 pb-3 ps-0 pe-0 text-center">
                                    <h4 class="m-1">End Date</h4>
                                    <div class="input-group date justify-content-center" data-provide="datepicker">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar me-1"></i>
                                        </div>
                                        <input type="text" class="form-control p-0 to_date" readonly placeholder="DD-MM-YYYY" value="">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 border-end">
                            <div class="pt-3 pb-3 ps-0 pe-0 text-center">
                                <h4 class="m-1">Timesheet Formate</h4>
                                <p class="m-0">Hours Minutes (HH : MM)</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="pt-3 pb-3 ps-0 pe-0 text-center">
                                <h4 class="m-1">Timesheet Rounding</h4>
                                <p class="m-0">No</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card p-3">
                    <div class="row">
                        <div class="col-xl-3 col-xxl-3 col-sm-4">
                            <div class="d-flex justify-content-evenly">
                                <h5>Hours Tracked</h5>
                                <h6>321:28</h6>
                            </div>


                            <div class="progress mx-auto" data-value='80'>
                                <span class="progress-left">
                                    <span class="progress-bar border-primary"></span>
                                </span>
                                <span class="progress-right">
                                    <span class="progress-bar border-primary"></span>
                                </span>
                                <div
                                    class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                    <div class="h3 font-weight-bold mb-0">80<sup class="small">%</sup></div>
                                </div>
                            </div>
                            <!-- END -->

                            <!-- Demo info -->
                            <div class="row text-center mt-4">
                                <div class="col-6 border-right">
                                    <div class="h4 font-weight-bold mb-0"> 276:28</div><span class="small text-gray"><i
                                            class="fa fa-circle text-secondary me-1"></i>Billable Hours</span>
                                </div>
                                <div class="col-6 border-right">
                                    <div class="h4 font-weight-bold mb-0"> 45:00</div><span class="small text-gray"><i
                                            class="fa fa-circle text-light me-1"></i>Non Billable Hours</span>
                                </div>

                            </div>



                        </div>
                        <div class="col-xl-2 col-xxl-2 col-sm-4">
                            <h4>Billable Amount</h4>
                            <p class="mb-0"><span class="text-light me-3">USD</span> $17,058.50</p>
                            <p class="mb-0"><span class="text-light me-3">GBP</span> $17,058.50</p>
                        </div>
                        <div class="col-xl-3 col-xxl-3 col-sm-4">
                            <h4>Uninvoiced Amount</h4>
                            <p class="mb-0"><span class="text-light me-3">USD</span> $17,058.50</p>
                            <p class="mb-0"><span class="text-light me-3">GBP</span> $17,058.50</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card p-3">

                    <div class="card-body">
                        <!-- Nav tabs -->
                        <div class="default-tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#Customers"
                                        aria-selected="false" role="tab" tabindex="-1"><i class="la la-user me-2"></i>
                                        Customers</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#Tab_2" aria-selected="false" id="Projects"
                                        role="tab" tabindex="-1"><i class="la la-file-alt me-2"></i> Projects</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#Tab_3" aria-selected="false" id="Categories"
                                        role="tab" tabindex="-1"><i class="la la-file-alt me-2"></i> Categories</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#Tab_4" aria-selected="false" id="TeamMember"
                                        role="tab" tabindex="-1"><i class="la la-file-alt me-2"></i> Team Members</a>
                                </li>
                            </ul>
                            <div class="tab-content mt-3">
                                <div class="tab-pane fade" id="Tab_2" role="tabpanel">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="table-responsive">
                                                <table class="table display mb-4 dataTablesCard designation-table table-responsive-xl card-table" id="example5">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Project Name</th>
                                                            <th>Hours</th>
                                                            {{-- <th>Experience Level</th> --}}
                                                            <th>Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="Tab_3" role="tabpanel">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="table-responsive">
                                                <table class="table display mb-4 dataTablesCard designation-table table-responsive-xl card-table" id="example6">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Project Types</th>
                                                            <th>Hours</th>
                                                            {{-- <th>Experience Level</th> --}}
                                                            <th>Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="Tab_4" role="tabpanel">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="table-responsive">
                                            <table class="table display mb-4 dataTablesCard designation-table table-responsive-xl card-table" id="example7">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Employee Name</th>
                                                        <th>Project Name</th>
                                                        <th>Hours</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
@include('backend.toastr-message.alert')
<script src="{{ asset('admin/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('backend/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
<script src="{{ asset('backend/js/plugins-init/sweetalert.init.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.datepicker').datepicker({
            formatDate:'dd-mm-YY',
        });
        $(".startdatepicker").on("change.datepicker", ({date, oldDate}) => {
            $(".enddatepicker").datepicker("destroy");
            $('.enddatepicker').datepicker({
                formatDate:'yy-mm-dd',
                minDate : date
            });
        });

        var date = 0;
        $('.enddatepicker').datepicker({
            formatDate:'yy-mm-dd',
            minDate : new Date(date)
        });
    });

    jQuery(function($){
        $(document).on('click', '#Projects', function() {
            pageTwoTable();
            $(document).on("change",".from_date" ,function()
            {
                $('#example5').DataTable().ajax.reload();
            });
            $(document).on("change",".to_date" ,function()
            {
                $('#example5').DataTable().ajax.reload();
            });
        });
        function pageTwoTable() {
            $('#Projects').removeAttr('id');
            var table = $('#example5').dataTable({
                destroy: true,
                processing:true,
                responsive: true,
                lengthChange: true,
                searching: false,
                info: false,
                paging: false,
                ordering: false,
                autoWidth: false,
                ajax: {
                    'url': "{{ route('admin.getReport') }}",
                    'data' : function(data){
                        data.from_date = $('.from_date').val();
                        data.to_date = $('.to_date').val(); 
                        data.project = 'project';
                    }
                },
                columns: [
                    {render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }},
                    {data: 'project_name'},
                    {data: 'hours'},
                    {data: 'amount'},
                ],
            });
        }

        $(document).on('click', '#Categories', function() {
            pageThreeTable();
            $(document).on("change",".from_date" ,function()
            {
                $('#example6').DataTable().ajax.reload();
            });
            $(document).on("change",".to_date" ,function()
            {
                $('#example6').DataTable().ajax.reload();
            });
        });

        function pageThreeTable() {
            $('#Categories').removeAttr('id');
            var table = $('#example6').dataTable({
                destroy: true,
                processing:true,
                responsive: true,
                lengthChange: true,
                searching: false,
                info: false,
                paging: false,
                ordering: false,
                autoWidth: false,
                ajax: {
                    'url': "{{ route('admin.getReport') }}",
                    'data' : function(data){
                        data.from_date = $('.from_date').val();
                        data.to_date = $('.to_date').val(); 
                        data.categories = 'categories';
                    }
                },
                columns: [
                    {render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }},
                    {data: 'project_name'},
                    {data: 'hours'},
                    {data: 'amount'},
                ],
            });
        }

        $(document).on('click', '#TeamMember', function() {
            pageFourTable();
            $(document).on("change",".from_date" ,function()
            {
                $('#example7').DataTable().ajax.reload();
            });
            $(document).on("change",".to_date" ,function()
            {
                $('#example7').DataTable().ajax.reload();
            });
        });

        function pageFourTable() {
            $('#TeamMember').removeAttr('id');
            var table = $('#example7').dataTable({
                destroy: true,
                processing:true,
                responsive: true,
                lengthChange: true,
                searching: false,
                info: false,
                paging: false,
                ordering: false,
                autoWidth: false,
                ajax: {
                    'url': "{{ route('admin.getReportTeam') }}",
                    'data' : function(data){
                        data.from_date = $('.from_date').val();
                        data.to_date = $('.to_date').val(); 
                        data.team_member = 'team_member';
                    }
                },
                columns: [
                    {render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }},
                    {data: 'employee_name'},
                    {data: 'project_name'},
                    {data: 'hours'},
                ],
            });
        }
    });
    $(function() {
        $(".progress").each(function() {
            var value = $(this).attr('data-value');
            var left = $(this).find('.progress-left .progress-bar');
            var right = $(this).find('.progress-right .progress-bar');

            if (value > 0) {
                if (value <= 50) {
                    right.css('transform', 'rotate(' + percentageToDegrees(value) + 'deg)')
                } else {
                    right.css('transform', 'rotate(180deg)')
                    left.css('transform', 'rotate(' + percentageToDegrees(value - 50) + 'deg)')
                }
            }
        })
    });
    function percentageToDegrees(percentage) {
        return percentage / 100 * 360
    }

</script>
@endsection