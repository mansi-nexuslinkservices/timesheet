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
					<a href="{{route('admin.project-type.index')}}" class="btn btn-primary btn-sm me-3"> <i class="fas fa-arrow-left"></i></a>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-6">
					<div class="card">
						@if(!empty($projectType))
							<form method="POST" action="{{route('admin.project-type.update',$projectType['id'])}}" id="projectType">
							@csrf
							@method('PATCH')
						@else
							<form method="POST" action="{{route('admin.project-type.store')}}" id="projectType">
							@csrf
						@endif
							
							<div class="card-body">
								<div class="row">
									<div class="col-xl-12  col-md-6 mb-4">
									  <label  class="form-label font-w600">Name<span class="text-danger scale5 ms-2">*</span></label>
										<input type="text" class="form-control projectTypeName" name="name" placeholder="Enter name" aria-label="name" value="{{old('name', $projectType['name'] ?? '')}}">
										@error('name')
											<div class="error">{{ $message }}</div>
										@enderror
									</div>
								</div>
								<div>
									<span>Status:<label class="radio-inline mx-3"><input type="radio" name="status" class="form-check-input" value="1" @if(isset($projectType['status']) && $projectType['status'] == 1) {{'checked'}} @endif checked=""> Active</label></span>
									<span><label class="radio-inline me-3"><input type="radio" name="status" class="form-check-input" value="0" @if(isset($projectType['status']) && $projectType['status'] == 0) {{'checked'}} @endif> In Active</label></span>
									@error('status')
										<div class="error">{{ $message }}</div>
									@enderror
								</div>
							</div>
							<div class="card-footer text-end">
								<div>
									<input type="submit" value="Submit" class="btn btn-primary me-3">
									<a href="{{route('admin.project-type.index')}}" type="submit" class="btn btn-secondary">Close</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
        </div>
    </div>
@endsection