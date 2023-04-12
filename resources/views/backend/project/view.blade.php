@extends('backend.layouts.admin')

@section('title')
    {{ $list_page.' '.$inner_page_module_name }}
@endsection

@section('content')
	<div class="content-body">
		<div class="container-fluid">
			<div class="d-flex align-items-center mb-4">
				<h4 class="fs-20 font-w600 mb-0 me-auto">{{ $list_page.' '.$inner_page_module_name }}</h4>
				<div>
					<a href="{{route('admin.projects.index')}}" class="btn btn-primary btn-sm me-3"> <i class="fas fa-arrow-left"></i></a>
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
											<span class="custom-label">Project Name :</span>
											<span class="font-w400">
												{{$project['name'] ?? ''}}
											</span>
										</p>

										<p class="font-w600 mb-3" style="float: left;">
											<span class="custom-label">Description :</span>
											<span class="font-w400">
												{!! $project['description'] ?? '' !!}
											</span>
										</p>

										<p class="font-w600 mb-3">
											<span class="custom-label">Users :</span>
											<span class="font-w400">
												{{ $multiple_users ?? '' }}
											</span>
										</p>

										<p class="font-w600 mb-3">
											<span class="custom-label">Created Date :</span>
											<span class="font-w400">
												{{date("m/d/Y H:i A", strtotime($project->created_at)) ?? ''}}
											</span>
										</p>

										<p class="font-w600 mb-3">
											<span class="custom-label">Status:</span>
											<span class="font-w400 @if($project['status'] == 1) {{'badge badge-success'}} @else {{'badge badge-danger'}}@endif">
												@if($project['status'] == 1) {{'Active'}} @else {{'InActive'}}@endif
											</span>
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer text-end">
							<div>
								<a href="{{route('admin.projects.index')}}" type="submit" class="btn btn-secondary">Close</a>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
@endsection