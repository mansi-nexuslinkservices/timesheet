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
            <div class="col-xl-12">
                <div class="card">
				<div class="card-header border-0 pb-0 flex-wrap">
                        <h4 class="fs-17 mb-1">Spent Hours & Billing</h4>
                        <div class="card-action coin-tabs mt-3 mt-sm-0">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link " data-bs-toggle="tab" href="#Daily" role="tab">Today</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " data-bs-toggle="tab" href="#Daily" role="tab">This Week</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#Daily" role="tab">This Month</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row separate-row">
                            <div class="col-xl-3">
                                <div class="job-icon py-3 d-flex justify-content-between">
                                    <div>
                                        <div class="d-flex align-items-center mb-1">
                                            <h2 class="mb-0">342</h2>
                                        </div>
                                        <span class="fs-14 d-block mb-0">Commercial Projects</span>
                                    </div>
                                    <div id="NewCustomers"></div>
                                </div>
                            </div>
							<div class="col-xl-3">
                                <div class="job-icon py-3 d-flex justify-content-between">
                                    <div>
                                        <div class="d-flex align-items-center mb-1">
                                            <h2 class="mb-0">984</h2>
                                        </div>
                                        <span class="fs-14 d-block mb-0">In-house Project Hours</span>
                                    </div>
                                    <div id="NewCustomers"></div>
                                </div>
                            </div>
							<div class="col-xl-3">
                                <div class="job-icon py-3 d-flex justify-content-between">
                                    <div>
                                        <div class="d-flex align-items-center mb-1">
                                            <h2 class="mb-0">1,567k</h2>
                                        </div>
                                        <span class="fs-14 d-block mb-0">Idle Hours</span>
                                    </div>
                                    <div id="NewCustomers"></div>
                                </div>
                            </div>
							<div class="col-xl-3">
                                <div class="job-icon py-3 d-flex justify-content-between">
                                    <div>
                                        <div class="d-flex align-items-center mb-1">
                                            <h2 class="mb-0">437</h2>
                                        </div>
                                        <span class="fs-14 d-block mb-0">Total Hours</span>
                                    </div>
                                    <div id="NewCustomers"></div>
                                </div>
                            </div>
                        </div>
						<div class="row separate-row">
                            <div class="col-xl-3">
                                <div class="job-icon py-3 d-flex justify-content-between">
                                    <div>
                                        <div class="d-flex align-items-center mb-1">
                                            <h2 class="mb-0">&#8364; 100</h2>
                                        </div>
                                        <span class="fs-14 d-block mb-0">Commercial Projects</span>
                                    </div>
                                    <div id="NewCustomers"></div>
                                </div>
                            </div>
							<div class="col-xl-3">
                                <div class="job-icon py-3 d-flex justify-content-between">
                                    <div>
                                        <div class="d-flex align-items-center mb-1">
                                            <h2 class="mb-0">&#8364; 200</h2>
                                        </div>
                                        <span class="fs-14 d-block mb-0">In-house Project Hours</span>
                                    </div>
                                    <div id="NewCustomers"></div>
                                </div>
                            </div>
							<div class="col-xl-3">
                                <div class="job-icon py-3 d-flex justify-content-between">
                                    <div>
                                        <div class="d-flex align-items-center mb-1">
                                            <h2 class="mb-0">&#8364; 300</h2>
                                        </div>
                                        <span class="fs-14 d-block mb-0">Idle Hours</span>
                                    </div>
                                    <div id="NewCustomers"></div>
                                </div>
                            </div>
							<div class="col-xl-3">
                                <div class="job-icon py-3 d-flex justify-content-between">
                                    <div>
                                        <div class="d-flex align-items-center mb-1">
                                            <h2 class="mb-0">&#8364; 600</h2>
                                        </div>
                                        <span class="fs-14 d-block mb-0">Total Hours</span>
                                    </div>
                                    <div id="NewCustomers"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header border-0 pb-0 flex-wrap">
                        <h4 class="fs-17 mb-1">Employees</h4>
                        
                    </div>
                    <div class="card-body">
                        <div class="row separate-row">
                            <div class="col-xl-3"  style="border-bottom:0px ">
                                <div class="job-icon py-3 d-flex justify-content-between" >
                                    <div>
                                        <div class="d-flex align-items-center mb-1">
                                            <h2 class="mb-0">2</h2>
                                        </div>
                                        <span class="fs-14 d-block mb-0">Senior</span>
                                    </div>
                                    <div id="NewCustomers"></div>
                                </div>
                            </div>
							<div class="col-xl-3" style="border-bottom:0px ">
                                <div class="job-icon py-3 d-flex justify-content-between" >
                                    <div>
                                        <div class="d-flex align-items-center mb-1">
                                            <h2 class="mb-0">2</h2>
                                        </div>
                                        <span class="fs-14 d-block mb-0">Medior</span>
                                    </div>
                                    <div id="NewCustomers"></div>
                                </div>
                            </div>
							<div class="col-xl-3" style="border-bottom:0px ">
                                <div class="job-icon py-3 d-flex justify-content-between" >
                                    <div>
                                        <div class="d-flex align-items-center mb-1">
                                            <h2 class="mb-0">2</h2>
                                        </div>
                                        <span class="fs-14 d-block mb-0">Junior</span>
                                    </div>
                                    <div id="NewCustomers"></div>
                                </div>
                            </div>
							<div class="col-xl-3" style="border-bottom:0px ">
                                <div class="job-icon py-3 d-flex justify-content-between" >
                                    <div>
                                        <div class="d-flex align-items-center mb-1">
                                            <h2 class="mb-0">6</h2>
                                        </div>
                                        <span class="fs-14 d-block mb-0">Total</span>
                                    </div>
                                    <div id="NewCustomers"></div>
                                </div>
                            </div>
                        </div>
						
                    </div>
                </div>
            </div>
        </div>
		<div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header border-0 pb-0 flex-wrap">
                        <h4 class="fs-17 mb-1">Active Projects</h4>
                        
                    </div>
                    <div class="card-body">
                        <div class="row separate-row">
                            <div class="col-xl-3" style="border-bottom:0px ">
                                <div class="job-icon py-3 d-flex justify-content-between" >
                                    <div>
                                        <div class="d-flex align-items-center mb-1">
                                            <h2 class="mb-0">2</h2>
                                        </div>
                                        <span class="fs-14 d-block mb-0">Commercial</span>
                                    </div>
                                    <div id="NewCustomers"></div>
                                </div>
                            </div>
							<div class="col-xl-3" style="border-bottom:0px ">
                                <div class="job-icon py-3 d-flex justify-content-between" >
                                    <div>
                                        <div class="d-flex align-items-center mb-1">
                                            <h2 class="mb-0">2</h2>
                                        </div>
                                        <span class="fs-14 d-block mb-0">In-house</span>
                                    </div>
                                    <div id="NewCustomers"></div>
                                </div>
                            </div>
							<div class="col-xl-3" style="border-bottom:0px ">
                                <div class="job-icon py-3 d-flex justify-content-between" >
                                    <div>
                                        <div class="d-flex align-items-center mb-1">
                                            <h2 class="mb-0">2</h2>
                                        </div>
                                        <span class="fs-14 d-block mb-0">Not Billable</span>
                                    </div>
                                    <div id="NewCustomers"></div>
                                </div>
                            </div>
							<div class="col-xl-3" style="border-bottom:0px ">
                                <div class="job-icon py-3 d-flex justify-content-between" >
                                    <div>
                                        <div class="d-flex align-items-center mb-1">
                                            <h2 class="mb-0">6</h2>
                                        </div>
                                        <span class="fs-14 d-block mb-0">Total</span>
                                    </div>
                                    <div id="NewCustomers"></div>
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
<!--**********************************
    Content body end
***********************************-->
@endsection