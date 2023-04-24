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
					<a href="{{route('admin.clients.index')}}" class="btn btn-primary btn-sm me-3"> <i class="fas fa-arrow-left"></i></a>
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
											<span class="custom-label">Name :</span>
											<span class="font-w400">
												{{$client['name'] ?? ''}}
											</span>
										</p>

										<p class="font-w600 mb-3">
											<span class="custom-label">Email :</span>
											<span class="font-w400">
												{{$client['email'] ?? ''}}
											</span>
										</p>
										<p class="font-w600 mb-3">
											<span class="custom-label">Phone :</span>
											<span class="font-w400">
												{{$client['phone'] ?? '-'}}
											</span>
										</p>
										<p class="font-w600 mb-3">
											<span class="custom-label">Country :</span>
											<span class="font-w400">
												{{$client['country'] ?? '-'}}
											</span>
										</p>
										<p class="font-w600 mb-3">
											<span class="custom-label">State :</span>
											<span class="font-w400">
												{{$client['state'] ?? '-'}}
											</span>
										</p>

										<p class="font-w600 mb-3">
											<span class="custom-label">Created Date :</span>
											<span class="font-w400">
												{{date("m/d/Y H:i A", strtotime($client->created_at)) ?? ''}}
											</span>
										</p>

										<p class="font-w600 mb-3">
											<span class="custom-label">Status:</span>
											<span class="font-w400 @if($client['status'] == 1) {{'badge badge-success'}} @else {{'badge badge-danger'}}@endif">
												@if($client['status'] == 1) {{'Active'}} @else {{'InActive'}}@endif
											</span>
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer text-end">
							<div>
								<a href="{{route('admin.clients.index')}}" type="submit" class="btn btn-secondary">Close</a>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
@endsection