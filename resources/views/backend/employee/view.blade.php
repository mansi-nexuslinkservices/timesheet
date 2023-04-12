@extends('backend.layouts.admin')

@section('title')
    {{$list_page.' '.$inner_page_module_name}}
@endsection

@section('content')
	<div class="content-body">
		<div class="container-fluid">
			<div class="d-flex align-items-center mb-4">
				<h4 class="fs-20 font-w600 mb-0 me-auto">{{$list_page.' '.$inner_page_module_name}}</h4>
				<div>
					<a href="{{route('admin.employees.index')}}" class="btn btn-primary btn-sm me-3"> <i class="fas fa-arrow-left"></i></a>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-6">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-xl-12">
									<div class="ms-8">
										<p class="font-w600 mb-3">
											<span class="custom-label">Username :</span>
											<span class="font-w400">
												{{$employee['username'] ?? ''}}
											</span>
										</p>
										<p class="font-w600 mb-3">
											<span class="custom-label">Email :</span>
											<span class="font-w400">
												{{$employee['email'] ?? ''}}
											</span>
										</p>
										<p class="font-w600 mb-3">
											<span class="custom-label">User Type :</span>
											<span class="font-w400">
												{{$employeeTypes['name'] ?? ''}}
											</span>
										</p>

										<p class="font-w600 mb-3">
											<span class="custom-label">Project Name :</span>
											<span class="font-w400">
												{{$mprojects ?? ''}}
											</span>
										</p>

										<p class="font-w600 mb-3">
											<span class="custom-label">Designation :</span>
											<span class="font-w400">
												{!! $designations['name'] ?? '' !!}
											</span>
										</p>

										<p class="font-w600 mb-3">
											<span class="custom-label">Joining Date :</span>
											<span class="font-w400">
												{{date("m/d/Y ", strtotime($employee->joining_date)) ?? ''}}
											</span>
										</p>

										<p class="font-w600 mb-3">
											<span class="custom-label">Status:</span>
											<span class="font-w400 @if($employee['status'] == 1) {{'badge badge-success'}} @else {{'badge badge-danger'}}@endif">
												@if($employee['status'] == 1) {{'Active'}} @else {{'InActive'}}@endif
											</span>
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer text-end">
							<div>
								<a href="{{route('admin.employees.index')}}" type="submit" class="btn btn-secondary">Close</a>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
@endsection