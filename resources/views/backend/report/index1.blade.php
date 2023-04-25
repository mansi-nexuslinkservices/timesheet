@extends('backend.layouts.admin')

@section('title')
@endsection

@section('content')
<link href="{{ asset('admin/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
<div class="content-body">
    <div class="container-fluid timesheet-container">
        <h3>Timesheet Summary</h3>
        <div class="row mb-2">
            <div class="col-lg-6 col-md-6">
                <div class="input-daterange-datepicker">
                    <span></span> <i class="fa fa-calendar-alt ms-4"></i>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 text-end">
                <button class="btn btn-outline-success me-2"><i class="fa fa-download me-2"></i> Excel</button>
                <button class="btn btn-outline-danger"><i class="fa fa-download me-2"></i> PDF</button>
            </div>
        </div>


        <div class="row">
            <div class="col-xl-12">
                <div class="card p-3">

                    <div class="card-body">
                        <!-- Nav tabs -->
                        <div class="default-tab">
                            <div class="row" style="border-bottom: 1px solid #dee2e6;">
                                <div class="col-lg-auto col-md-auto">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#Tab_6"
                                                aria-selected="false" id="Projects" role="tab" tabindex="-1"><i
                                                    class="la la-layer-group me-2"></i>
                                                All</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" data-bs-toggle="tab" href="#Tab_2" aria-selected="false"
                                                id="Projects" role="tab" tabindex="-1"><i
                                                    class="la la-file-alt me-2"></i>
                                                Projects</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link " data-bs-toggle="tab" href="#Tab_3" id="Customers"
                                                aria-selected="false" role="tab" tabindex="-1"><i
                                                    class="la la-user me-2"></i>
                                                Customers</a>
                                        </li>

                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" data-bs-toggle="tab" href="#Tab_4" aria-selected="false"
                                                id="Categories" role="tab" tabindex="-1"><i
                                                    class="la la-list-alt me-2"></i>
                                                Categories</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" data-bs-toggle="tab" href="#Tab_5" aria-selected="false"
                                                id="TeamMember" role="tab" tabindex="-1"><i
                                                    class="la la-users me-2"></i>
                                                Team Members</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-auto col-md-auto text-end ms-auto">
                                    <h5><i class="fa fa-clock me-2 text-secondary"></i> Tracked Hours:<span
                                            class="text-secondary fs-20 ms-2">321:28</span> </h5>
                                </div>
                                <div class="col-lg-auto col-md-auto text-end ms-auto">
                                    <h5><i class="fa fa-wallet me-2 text-secondary"></i> Total Amount:<span
                                            class="text-secondary fs-20 ms-2"> &euro; 345</span> </h5>
                                </div>
                            </div>
                            <div class="tab-content mt-3">
                                <div class="tab-pane fade in active show" id="Tab_6" role="tabpanel">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="table-responsive">
                                                <table
                                                    class="table displaydataTablesCard designation-table customer-table card-table w-100"
                                                    id="example9">
                                                    <thead>
                                                        <tr>
                                                            <th>Customer Name</th>
                                                            <th>Project Name</th>
                                                            <th>Employee Name</th>
                                                            <th>Hours</th>
                                                            <th>Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td rowspan="3">
                                                                <div class="proj_div d-flex align-items-center">

                                                                    <img class="proj_span me-2"
                                                                        src="https://pixinvent.com/materialize-material-design-admin-template/laravel/demo-4/images/user/12.jpg"
                                                                        class="w-100" alt="">

                                                                    Alin Gros
                                                                </div>

                                                            </td>
                                                            <td>
                                                                <div class="proj_div d-flex align-items-center">
                                                                    <div class="proj_primary proj_span me-2">A</div>
                                                                    App Redesign
                                                                </div>

                                                            </td>
                                                            <td>
                                                                <div class="proj_div d-flex align-items-center">

                                                                    <img class="proj_span me-2"
                                                                        src="https://pixinvent.com/materialize-material-design-admin-template/laravel/demo-4/images/user/12.jpg"
                                                                        class="w-100" alt="">

                                                                    Alin Gros
                                                                </div>

                                                            </td>
                                                            <td>
                                                                <p class="mb-0">32:00</p>
                                                            </td>
                                                            <td>
                                                                <p class="mb-0">&euro; 60</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="display: none"></td>
                                                            <td>
                                                                <div class="proj_div d-flex align-items-center">
                                                                    <div class="proj_success proj_span me-2">D</div>
                                                                    Design Work
                                                                </div>

                                                            </td>
                                                            <td>
                                                                <div class="proj_div d-flex align-items-center">

                                                                    <img class="proj_span me-2"
                                                                        src="https://pixinvent.com/materialize-material-design-admin-template/laravel/demo-4/images/user/12.jpg"
                                                                        class="w-100" alt="">

                                                                    Alin Gros
                                                                </div>

                                                            </td>

                                                            <td>
                                                                <p class="mb-0">32:00</p>
                                                            </td>
                                                            <td>
                                                                <p class="mb-0">&euro; 60</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="display: none"></td>
                                                            <td>
                                                                <div class="proj_div d-flex align-items-center">
                                                                    <div class="proj_primary proj_span me-2">A</div>
                                                                    App Redesign
                                                                </div>

                                                            </td>
                                                            <td>
                                                                <div class="proj_div d-flex align-items-center">

                                                                    <img class="proj_span me-2"
                                                                        src="https://www.citrix.com/blogs/wp-content/upload/2018/03/slack_compressed-e1521621363404-360x360.jpg"
                                                                        class="w-100" alt="">

                                                                    Alin Gros
                                                                </div>

                                                            </td>
                                                            <td>
                                                                <p class="mb-0">32:00</p>
                                                            </td>
                                                            <td>
                                                                <p class="mb-0">&euro; 60</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td rowspan="3" class="client-diff">
                                                                <div class="proj_div d-flex align-items-center">

                                                                    <img class="proj_span me-2"
                                                                        src="https://pixinvent.com/materialize-material-design-admin-template/laravel/demo-4/images/user/12.jpg"
                                                                        class="w-100" alt="">

                                                                    Alin Gros
                                                                </div>

                                                            </td>
                                                            <td class="client-diff">
                                                                <div class="proj_div d-flex align-items-center">
                                                                    <div class="proj_primary proj_span me-2">A</div>
                                                                    App Redesign
                                                                </div>

                                                            </td>
                                                            <td class="client-diff"> 
                                                                <div class="proj_div d-flex align-items-center">

                                                                    <img class="proj_span me-2"
                                                                        src="https://www.citrix.com/blogs/wp-content/upload/2018/03/slack_compressed-e1521621363404-360x360.jpg"
                                                                        class="w-100" alt="">

                                                                    Alin Gros
                                                                </div>

                                                            </td>
                                                            <td class="client-diff">
                                                                <p class="mb-0">32:00</p>
                                                            </td>
                                                            <td class="client-diff">
                                                                <p class="mb-0">&euro; 60</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="display: none"></td>
                                                            <td>
                                                                <div class="proj_div d-flex align-items-center">
                                                                    <div class="proj_success proj_span me-2">D</div>
                                                                    Design Work
                                                                </div>

                                                            </td>
                                                            <td>
                                                                <div class="proj_div d-flex align-items-center">

                                                                    <img class="proj_span me-2"
                                                                        src="https://pixinvent.com/materialize-material-design-admin-template/laravel/demo-4/images/user/12.jpg"
                                                                        class="w-100" alt="">

                                                                    Alin Gros
                                                                </div>

                                                            </td>
                                                            <td>
                                                                <p class="mb-0">32:00</p>
                                                            </td>
                                                            <td>
                                                                <p class="mb-0">&euro; 60</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="display: none"></td>
                                                            <td>
                                                                <div class="proj_div d-flex align-items-center">
                                                                    <div class="proj_primary proj_span me-2">A</div>
                                                                    App Redesign
                                                                </div>

                                                            </td>
                                                            <td>
                                                                <div class="proj_div d-flex align-items-center">

                                                                    <img class="proj_span me-2"
                                                                        src="https://pixinvent.com/materialize-material-design-admin-template/laravel/demo-4/images/user/12.jpg"
                                                                        class="w-100" alt="">

                                                                    Alin Gros
                                                                </div>

                                                            </td>
                                                            <td>
                                                                <p class="mb-0">32:00</p>
                                                            </td>
                                                            <td>
                                                                <p class="mb-0">&euro; 60</p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="Tab_2" role="tabpanel">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="table-responsive">
                                                <table
                                                    class="table displaydataTablesCard designation-table card-table w-100"
                                                    id="example5">
                                                    <thead>
                                                        <tr>
                                                            <th>Project Name</th>
                                                            <th>Hours</th>
                                                            <th>Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="proj_div d-flex align-items-center">
                                                                    <div class="proj_primary proj_span me-2">A</div>
                                                                    App Redesign
                                                                </div>

                                                            </td>
                                                            <td>
                                                                <p class="mb-0">32:00</p>
                                                            </td>
                                                            <td>
                                                                <p class="mb-0">&euro; 60</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="proj_div d-flex align-items-center">
                                                                    <div class="proj_success proj_span me-2">D</div>
                                                                    Design Work
                                                                </div>

                                                            </td>
                                                            <td>
                                                                <p class="mb-0">32:00</p>
                                                            </td>
                                                            <td>
                                                                <p class="mb-0">&euro; 60</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="proj_div d-flex align-items-center">
                                                                    <div class="proj_danger proj_span me-2">DW</div>
                                                                    Design Work
                                                                </div>

                                                            </td>
                                                            <td>
                                                                <p class="mb-0">32:00</p>
                                                            </td>
                                                            <td>
                                                                <p class="mb-0">&euro; 60</p>
                                                            </td>
                                                        </tr>
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
                                                <table
                                                    class="table displaydataTablesCard designation-table card-table w-100 customer-table"
                                                    id="example6">
                                                    <thead>
                                                        <tr>
                                                            <th>Customer Name</th>
                                                            <th>Project Name</th>
                                                            <th>Hours</th>
                                                            <th>Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr >
                                                            <td rowspan="2">
                                                                <div class="proj_div d-flex align-items-center">

                                                                    <img class="proj_span me-2"
                                                                        src="https://www.citrix.com/blogs/wp-content/upload/2018/03/slack_compressed-e1521621363404-360x360.jpg"
                                                                        class="w-100" alt="">

                                                                    Alin Gros
                                                                </div>

                                                            </td>
                                                            <td>
                                                                <div class="proj_div d-flex align-items-center">
                                                                    <div class="proj_primary proj_span me-2">A</div>
                                                                    App Redesign
                                                                </div>

                                                            </td>
                                                            <td>
                                                                <p class="mb-0">32:00</p>
                                                            </td>
                                                            <td>
                                                                <p class="mb-0">&euro; 60</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="display:none">
                                                            </td>
                                                            <td>
                                                                <div class="proj_div d-flex align-items-center">
                                                                    <div class="proj_success proj_span me-2">D</div>
                                                                    Design Work
                                                                </div>

                                                            </td>
                                                            <td>
                                                                <p class="mb-0">32:00</p>
                                                            </td>
                                                            <td>
                                                                <p class="mb-0">&euro; 60</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td  class="client-diff" rowspan="2">
                                                                <div class="proj_div d-flex align-items-center">

                                                                    <img class="proj_span me-2"
                                                                        src="https://pixinvent.com/materialize-material-design-admin-template/laravel/demo-4/images/user/12.jpg"
                                                                        class="w-100" alt="">

                                                                    Alin Gros
                                                                </div>

                                                            </td>
                                                            <td  class="client-diff">
                                                                <div class="proj_div d-flex align-items-center">
                                                                    <div class="proj_primary proj_span me-2">A</div>
                                                                    App Redesign
                                                                </div>

                                                            </td>
                                                            <td  class="client-diff">
                                                                <p class="mb-0">32:00</p>
                                                            </td>
                                                            <td  class="client-diff">
                                                                <p class="mb-0">&euro; 60</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="display:none">
                                                            </td>
                                                            <td>
                                                                <div class="proj_div d-flex align-items-center">
                                                                    <div class="proj_success proj_span me-2">D</div>
                                                                    Design Work
                                                                </div>

                                                            </td>
                                                            <td>
                                                                <p class="mb-0">32:00</p>
                                                            </td>
                                                            <td>
                                                                <p class="mb-0">&euro; 60</p>
                                                            </td>
                                                        </tr>
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
                                                <table
                                                    class="table displaydataTablesCard designation-table card-table w-100"
                                                    id="example7">
                                                    <thead>
                                                        <tr>
                                                            <th>Category Name</th>
                                                            <th>Hours</th>
                                                            <th>Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="proj_div d-flex align-items-center">
                                                                    <div class="proj_primary proj_span me-2">A</div>
                                                                    In House
                                                                </div>

                                                            </td>
                                                            <td>
                                                                <p class="mb-0">32:00</p>
                                                            </td>
                                                            <td>
                                                                <p class="mb-0">&euro; 60</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="proj_div d-flex align-items-center">
                                                                    <div class="proj_success proj_span me-2">D</div>
                                                                    Commercial
                                                                </div>

                                                            </td>
                                                            <td>
                                                                <p class="mb-0">32:00</p>
                                                            </td>
                                                            <td>
                                                                <p class="mb-0">&euro; 60</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="proj_div d-flex align-items-center">
                                                                    <div class="proj_danger proj_span me-2">DW</div>
                                                                    Idel
                                                                </div>

                                                            </td>
                                                            <td>
                                                                <p class="mb-0">32:00</p>
                                                            </td>
                                                            <td>
                                                                <p class="mb-0">&euro; 60</p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="Tab_5" role="tabpanel">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="table-responsive">
                                                <table
                                                    class="table displaydataTablesCard designation-table card-table w-100 customer-table"
                                                    id="example8">
                                                    <thead>
                                                        <tr>
                                                            <th>Employee Name</th>
                                                            <th>Project Name</th>
                                                            <th>Hours</th>
                                                            <th>Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr >
                                                            <td rowspan="2">
                                                                <div class="proj_div d-flex align-items-center">

                                                                    <img class="proj_span me-2"
                                                                        src="https://www.citrix.com/blogs/wp-content/upload/2018/03/slack_compressed-e1521621363404-360x360.jpg"
                                                                        class="w-100" alt="">

                                                                    Alin Gros
                                                                </div>

                                                            </td>
                                                            <td>
                                                                <div class="proj_div d-flex align-items-center">
                                                                    <div class="proj_primary proj_span me-2">A</div>
                                                                    App Redesign
                                                                </div>

                                                            </td>
                                                            <td>
                                                                <p class="mb-0">32:00</p>
                                                            </td>
                                                            <td>
                                                                <p class="mb-0">&euro; 60</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="display:none">
                                                            </td>
                                                            <td>
                                                                <div class="proj_div d-flex align-items-center">
                                                                    <div class="proj_success proj_span me-2">D</div>
                                                                    Design Work
                                                                </div>

                                                            </td>
                                                            <td>
                                                                <p class="mb-0">32:00</p>
                                                            </td>
                                                            <td>
                                                                <p class="mb-0">&euro; 60</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td  class="client-diff" rowspan="2">
                                                                <div class="proj_div d-flex align-items-center">

                                                                    <img class="proj_span me-2"
                                                                        src="https://pixinvent.com/materialize-material-design-admin-template/laravel/demo-4/images/user/12.jpg"
                                                                        class="w-100" alt="">

                                                                    Alin Gros
                                                                </div>

                                                            </td>
                                                            <td  class="client-diff">
                                                                <div class="proj_div d-flex align-items-center">
                                                                    <div class="proj_primary proj_span me-2">A</div>
                                                                    App Redesign
                                                                </div>

                                                            </td>
                                                            <td  class="client-diff">
                                                                <p class="mb-0">32:00</p>
                                                            </td>
                                                            <td  class="client-diff">
                                                                <p class="mb-0">&euro; 60</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="display:none">
                                                            </td>
                                                            <td>
                                                                <div class="proj_div d-flex align-items-center">
                                                                    <div class="proj_success proj_span me-2">D</div>
                                                                    Design Work
                                                                </div>

                                                            </td>
                                                            <td>
                                                                <p class="mb-0">32:00</p>
                                                            </td>
                                                            <td>
                                                                <p class="mb-0">&euro; 60</p>
                                                            </td>
                                                        </tr>
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
</div>
@endsection
@section('js')
@include('backend.toastr-message.alert')
<script src="{{ asset('admin/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('backend/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
<script src="{{ asset('backend/js/plugins-init/sweetalert.init.js') }}"></script>
<script>
$(document).ready(function() {
    $('.datepicker').datepicker({
        formatDate: 'dd-mm-YY',
    });
    $(".startdatepicker").on("change.datepicker", ({
        date,
        oldDate
    }) => {
        $(".enddatepicker").datepicker("destroy");
        $('.enddatepicker').datepicker({
            formatDate: 'yy-mm-dd',
            minDate: date
        });
    });

    var date = 0;
    $('.enddatepicker').datepicker({
        formatDate: 'yy-mm-dd',
        minDate: new Date(date)
    });
    $('#example5').dataTable({
        destroy: true,
        processing: true,
        responsive: true,
        searching: true,
        info: false,
        paging: false,
        ordering: false,
        "initComplete": function(settings, json) {
            $("#example5").wrap(
                "<div style='overflow-x:auto; width:100%;position:relative;' class='datatable-main'></div>"
            );
        },
    })
    $('#example6').dataTable({
        destroy: true,
        processing: true,
        responsive: true,
        searching: true,
        info: false,
        paging: false,
        ordering: false,
        "initComplete": function(settings, json) {
            $("#example6").wrap(
                "<div style='overflow-x:auto; width:100%;position:relative;' class='datatable-main'></div>"
            );
        },
    })
    $('#example7').dataTable({
        destroy: true,
        processing: true,
        responsive: true,
        searching: true,
        info: false,
        paging: false,
        ordering: false,
        "initComplete": function(settings, json) {
            $("#example7").wrap(
                "<div style='overflow-x:auto; width:100%;position:relative;' class='datatable-main'></div>"
            );
        },
    })
    $('#example8').dataTable({
        destroy: true,
        processing: true,
        responsive: true,
        searching: true,
        info: false,
        paging: false,
        ordering: false,
        "initComplete": function(settings, json) {
            $("#example8").wrap(
                "<div style='overflow-x:auto; width:100%;position:relative;' class='datatable-main'></div>"
            );
        },
    })
    $('#example9').dataTable({
        destroy: true,
        processing: true,
        responsive: true,
        searching: true,
        info: false,
        paging: false,
        ordering: false,
        "initComplete": function(settings, json) {
            $("#example9").wrap(
                "<div style='overflow-x:auto; width:100%;position:relative;' class='datatable-main'></div>"
            );
        },
    })
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
<script src="{{ asset('admin/moment/moment.min.js') }}"></script>
<script src="{{ asset('admin/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script type="text/javascript">
$(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('.input-daterange-datepicker span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
            'MMMM D, YYYY'));
    }

    $('.input-daterange-datepicker').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month')
                .endOf('month')
            ]
        }
    }, cb);

    cb(start, end);

});
</script>
@endsection