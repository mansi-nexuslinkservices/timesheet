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
				<div class="col-xl-12">
					<div class="card">
						@if(!empty($client))
							<form method="POST" action="{{route('admin.clients.update',$client['id'])}}" id="client">
							@csrf
							@method('PATCH')
						@else
							<form method="POST" action="{{route('admin.clients.store')}}" id="client">
							@csrf
						@endif
							
							<div class="card-body">
								<div class="row">
									<div class="col-xl-6 mb-4">
									   <label  class="form-label font-w600">Name<span class="text-danger scale5 ms-2">*</span></label>
										<input type="text" class="form-control" name="name" placeholder="Enter name" aria-label="name" value="{{old('name', $client['name'] ?? '')}}">
										@error('name')
											<div class="error">{{ $message }}</div>
										@enderror
									</div>
									<div class="col-xl-6 mb-4">
									   <label  class="form-label font-w600">Email<span class="text-danger scale5 ms-2">*</span></label>
										<input type="text" class="form-control" name="email" placeholder="Enter email" aria-label="email" value="{{old('email', $client['email'] ?? '')}}">
										@error('email')
											<div class="error">{{ $message }}</div>
										@enderror
									</div>
								</div>
								<div class="row">
									<div class="col-xl-4 mb-4">
									   <label  class="form-label font-w600">Phone</label>
										<input type="text" class="form-control" name="phone" placeholder="Enter phone" aria-label="phone" value="{{old('phone', $client['phone'] ?? '')}}">
									</div>
									<div class="col-xl-4 mb-4">
									   <label  class="form-label font-w600">Country</label>
										<input type="text" class="form-control" name="country" placeholder="Enter country" aria-label="country" value="{{old('country', $client['country'] ?? '')}}">
									</div>
									<div class="col-xl-4 mb-4">
									   <label  class="form-label font-w600">State</label>
										<input type="text" class="form-control" name="state" placeholder="Enter state" aria-label="state" value="{{old('state', $client['state'] ?? '')}}">
									</div>
								</div>
								<div>
									<span>Status:<label class="radio-inline mx-3"><input type="radio" name="status" class="form-check-input" value="1" @if(isset($client['status']) && $client['status'] == 1) {{'checked'}} @endif checked=""> Active</label></span>
									<span><label class="radio-inline me-3"><input type="radio" name="status" class="form-check-input" value="0" @if(isset($client['status']) && $client['status'] == 0) {{'checked'}} @endif> In Active</label></span>
									@error('status')
										<div class="error">{{ $message }}</div>
									@enderror
								</div>
							</div>
							<div class="card-footer text-end">
								<div>
									<input type="submit" value="Submit" class="btn btn-primary me-3">
									<a href="{{route('admin.clients.index')}}" type="submit" class="btn btn-secondary">Close</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
        </div>
    </div>
@endsection