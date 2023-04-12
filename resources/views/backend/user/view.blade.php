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
					<a href="{{route('admin.users.index')}}" class="btn btn-primary btn-sm me-3"> <i class="fas fa-arrow-left"></i></a>
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
												{{$user['name'] ?? ''}}
											</span>
										</p>

										<p class="font-w600 mb-3">
											<span class="custom-label">Email :</span>
											<span class="font-w400">
												{{$user['email'] ?? ''}}
											</span>
										</p>

										<p class="font-w600 mb-3">
											<span class="custom-label">Created Date :</span>
											<span class="font-w400">
												{{date("m/d/Y H:i A", strtotime($admin_user->created_at)) ?? ''}}
											</span>
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="card-footer text-end">
							<div>
								<a href="{{route('admin.users.index')}}" type="submit" class="btn btn-secondary">Close</a>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
@endsection