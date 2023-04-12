@extends('backend.layouts.admin')

@section('title')
    {{$module_name}}
@endsection

@section('css')
<link href="{{ asset('admin/bootstrap-datepicker-master/css/bootstrap-datepicker.min.css') }}">
<style>
	.author-profile .upload-link{
		background: #9ea0a5 !important;
	}
</style>
@endsection

@section('content')
	<div class="content-body">
		<div class="container-fluid">
			<div class="d-flex align-items-center mb-4">
				<h4 class="fs-20 font-w600 mb-0 me-auto">{{$module_name}}</h4>
			</div>
			<div class="row">
				<div class="col-xl-6">
					<div class="card">
						@if($admin_user)
							<form method="POST" action="{{ route('admin.users.update',$admin_user->id) }}" enctype="multipart/form-data">

							@csrf
							@method('PATCH')

						@else
							<form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data" >

							@csrf
						@endif
							
							<div class="card-body">
								<div class="row">
									<div class="col-md-12 mb-4">
									  <label class="form-label font-w600">name<span class="text-danger scale5 ms-2">*</span></label>
										<input type="text" class="form-control Name" name="name" placeholder="Enter Name" value="{{ old('name',$admin_user['name'] ?? '') }}">
										@error('name')
    										<div class="error">{{ $message }}</div>
										@enderror
									</div>
									<div class="col-md-12 mb-4">
									  	<label class="form-label font-w600">email<span class="text-danger scale5 ms-2">*</span></label>
										<input type="email" class="form-control Email" name="email" placeholder="Enter Email" value="{{ old('email',$admin_user['email'] ?? '') }}">
										@error('surname')
    										<div class="error">{{ $message }}</div>
										@enderror
									</div>
									<div class="col-md-12 mb-4">
									  	<label class="form-label font-w600">Password<span class="text-danger scale5 ms-2">*</span></label>
										<input type="password" class="form-control password" name="password" placeholder="Enter Password" value="{{ old('password',$admin_user['password'] ?? '') }}">
										@error('surname')
    										<div class="error">{{ $message }}</div>
										@enderror
									</div>
								</div>
							</div>
							<div class="card-footer text-end">
								<div>
									<button type="submit" class="btn btn-primary">UPDATE</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
        </div>
    </div>
@endsection

