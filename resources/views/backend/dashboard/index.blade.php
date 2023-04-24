@extends('backend.layouts.admin')

@section('title')
{{ 'Dashboard' }}
@endsection

@section('content')

<!--**********************************
   Content body start
***********************************-->
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">

        <div class="row">
            <div class="col-xl-12 ">
                <div class="card">
                    <div class="card-header border-0 pb-0 flex-wrap">
                        <h4 class="fs-17 mb-1">Spent Hours & Billing</h4>
                        <div class="card-action coin-tabs mt-3 mt-sm-0">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#Daily" role="tab">Today</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " data-bs-toggle="tab" href="#Daily" role="tab">This Week</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " data-bs-toggle="tab" href="#Daily" role="tab">This
                                        Month</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-lg-12 col-md-12">
                                <div class="row separate-row">
                                    <div class="col-xl-3 col-lg-6 col-md-6">
                                        <div class="job-icon px-1 py-3 d-flex justify-content-between">
                                            <div>
                                                <div class=" mb-1">
                                                    <h2 class="mb-0">342</h2>
                                                    <h4 class="mb-0 text-light">&#8364; 100</h4>
                                                </div>
                                                <p class="text-purple">Commercial Projects</p>
                                            </div>
                                            <div class="icon"><i class="fa fa-business-time text-purple"></i></div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-md-6">
                                        <div class="job-icon px-1 py-3 d-flex justify-content-between">
                                            <div>
                                                <div class="mb-1">
                                                    <h2 class="mb-0">984</h2>
                                                    <h4 class="mb-0 text-light">&#8364; 200</h4>
                                                </div>
                                                <p class="text-warning">In-house Project Hours</p>
                                            </div>

                                            <div class="icon"><i class="fa fa-laptop-house text-warning"></i></div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-md-6">
                                        <div class="job-icon px-1 py-3 d-flex justify-content-between">
                                            <div>
                                                <div class=" mb-1">
                                                    <h2 class="mb-0">1,567k </h2>
                                                    <h4 class="mb-0 text-light">&#8364; 300</h4>
                                                </div>
                                                <p class="text-info">Idel Projects</p>
                                            </div>
                                            <div class="icon"><i class="fa fa-file-contract text-info"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-md-6" style="border-right:0px">

                                        <div class="job-icon px-1 py-3 d-flex justify-content-between">
                                            <div>
                                                <div class="mb-1">
                                                    <h2 class="mb-0">437 </h2>
                                                    <h4 class="mb-0 text-light">&#8364; 400</h4>
                                                </div>
                                                <p class="text-danger">Total</p>
                                            </div>
                                            <div class="icon"><i class="fa fa-clock text-danger"></i></div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-8 col-lg-8  h-100">
                <div class="row  mt-2">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header border-0 pb-0 flex-wrap">
                                <h4 class="fs-17 mb-1">Employees</h4>

                            </div>
                            <div class="card-body">
                                <div class="row separate-row">
                                    <div class="col-xl-3 col-lg-6 col-md-6 col-lg-6 col-md-6 px-3">
                                        <div class="job-icon px-1 py-3 d-flex justify-content-between">
                                            <div>

                                                <div class="d-flex align-items-center mb-1">
                                                    <h2 class="mb-0">2</h2>
                                                </div>
                                                <p class="fs-15 d-block mb-0 text-purple">Senior</p>
                                            </div>
                                            <div class="icon"><i class="fa fa-user text-purple"></i></div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-md-6 col-lg-6 col-md-6 px-3">
                                        <div class="job-icon px-1 py-3 d-flex justify-content-between">
                                            <div>

                                                <div class="d-flex align-items-center mb-1">
                                                    <h2 class="mb-0">2</h2>
                                                </div>
                                                <p class="fs-15 d-block mb-0 text-warning">Medior</p>
                                            </div>
                                            <div class="icon"><i class="fa fa-user text-warning"></i></div>
                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-lg-6 col-md-6 col-lg-6 col-md-6 px-3">
                                        <div class="job-icon px-1 py-3 d-flex justify-content-between">
                                            <div>

                                                <div class="d-flex align-items-center mb-1">
                                                    <h2 class="mb-0">2</h2>
                                                </div>
                                                <p class="fs-15 d-block mb-0 text-info">Junior</p>
                                            </div>
                                            <div class="icon"><i class="fa fa-user text-info"></i></div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-md-6 col-lg-6 col-md-6 px-3"
                                        style="border-right:0px">
                                        <div class="job-icon px-1 py-3 d-flex justify-content-between">
                                            <div>

                                                <div class="d-flex align-items-center mb-1">
                                                    <h2 class="mb-0">6</h2>
                                                </div>
                                                <p class="fs-15 d-block mb-0 text-danger">Total</p>
                                            </div>
                                            <div class="icon"><i class="fa fa-users text-danger"></i></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row  mt-2">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header border-0 pb-0 flex-wrap">
                                <h4 class="fs-17 mb-1">Active Projects</h4>

                            </div>
                            <div class="card-body">
                                <div class="row separate-row">
                                    <div class="col-xl-3 col-lg-6 col-md-6 col-lg-6 col-md-6 px-3">
                                        <div class="job-icon px-1 py-3 d-flex justify-content-between">
                                            <div>

                                                <div class="d-flex align-items-center mb-1">
                                                    <h2 class="mb-0">2</h2>
                                                </div>
                                                <p class="fs-15 d-block mb-0 text-purple">Commercial</p>
                                            </div>
                                            <div class="icon"><i class="fa fa-business-time text-purple"></i></div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-md-6 col-lg-6 col-md-6 px-3">
                                        <div class="job-icon px-1 py-3 d-flex justify-content-between">
                                            <div>

                                                <div class="d-flex align-items-center mb-1">
                                                    <h2 class="mb-0">2</h2>
                                                </div>
                                                <p class="fs-15 d-block mb-0  text-warning">In-house</p>
                                            </div>
                                            <div class="icon"><i class="fa fa-laptop-house  text-warning"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-lg-6 col-md-6 col-lg-6 col-md-6 px-3">
                                        <div class="job-icon px-1 py-3 d-flex justify-content-between">
                                            <div>

                                                <div class="d-flex align-items-center mb-1">
                                                    <h2 class="mb-0">2</h2>
                                                </div>
                                                <p class="fs-15 d-block mb-0 text-info">Not Billable</p>
                                            </div>
                                            <div class="icon"><i class="fa fa-file-invoice  text-info"></i></div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-md-6 col-lg-6 col-md-6 px-3"
                                        style="border-right:0px">
                                        <div class="job-icon px-1 py-3 d-flex justify-content-between">
                                            <div>

                                                <div class="d-flex align-items-center mb-1">
                                                    <h2 class="mb-0">6</h2>
                                                </div>
                                                <p class="fs-15 d-block mb-0  text-danger">Total</p>
                                            </div>
                                            <div class="icon"><i class="fa fa-layer-group  text-warning"></i></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 h-100">
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div id="pieChart1"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script src="{{ asset('admin/apexchart/apexchart.js') }}"></script>
<!--**********************************
    Content body end
***********************************-->
@endsection