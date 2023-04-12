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
				<div class="col-xl-12">
					<div class="card">
						@if(!empty($project))
							<form method="POST" action="{{route('admin.projects.update',$project['id'])}}" id="project">
							@csrf
							@method('PATCH')
						@else
							<form method="POST" action="{{route('admin.projects.store')}}" id="project">
							@csrf
						@endif
							
							<div class="card-body">
								<div class="row">
									<div class="col-xl-6 mb-4">
									  <label  class="form-label font-w600">Name<span class="text-danger scale5 ms-2">*</span></label>
										<input type="text" class="form-control projectName" name="name" placeholder="Enter name" aria-label="name" value="{{old('name', $project['name'] ?? '')}}">
										@error('name')
											<div class="error">{{ $message }}</div>
										@enderror
									</div>
									<div class="col-xl-6 mb-4">
									  	<label  class="form-label font-w600">Select Project Type<span class="text-danger scale5 ms-2">*</span></label>
										<select class="default-select form-control projectTypeId" name="project_type_id">
											<option>Select Project Type</option>
											@foreach($projectTypes as $projectType)
												<option value="{{$projectType->id}}" @if(isset($project->project_type_id) && $project->project_type_id == $projectType->id) {{'selected'}} @endif>{{$projectType->name}}</option>
											@endforeach
										</select>
										@error('project_type_id')
											<div class="error">{{ $message }}</div>
										@enderror
									</div>
								</div>

								<div class="row">
									<div class="col-xl-12  col-md-6 mb-4">
									  <label  class="form-label font-w600">Description</label>
									  	<textarea class="form-control" id="ckeditor" name="description">{{ old('description', $project->description ?? '') }}</textarea>
									</div>
								</div>	

								<div class="row mb-4">
									@foreach($employees as $e)
										<div class="col-xl-2">
											<div class="form-check custom-checkbox mb-3">
												<input type="checkbox" class="form-check-input" id="customCheckBox{{$e['id']}}" name="user_id[]" required="" value="{{$e['id']}}" @if(isset($multiple_users) && !empty($multiple_users))
												{{in_array($e['id'],$multiple_users) ? "checked" : ''}} @endif>
												<label class="form-check-label" for="customCheckBox{{$e['id']}}">{{$e['name']}}</label>
											</div>
										</div>
									@endforeach							
								</div>	

								<div>
									<span>Status:<label class="radio-inline mx-3"><input type="radio" name="status" class="form-check-input" value="1" @if(isset($project['status']) && $project['status'] == 1) {{'checked'}} @endif checked=""> Active</label></span>
									<span><label class="radio-inline me-3"><input type="radio" name="status" class="form-check-input" value="0" @if(isset($project['status']) && $project['status'] == 0) {{'checked'}} @endif> In Active</label></span>
									@error('status')
										<div class="error">{{ $message }}</div>
									@enderror
								</div>
							</div>
							<div class="card-footer text-end">
								<div>
									<input type="submit" value="Submit" class="btn btn-primary me-3">
									<a href="{{route('admin.projects.index')}}" type="submit" class="btn btn-secondary">Close</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
        </div>
    </div>
@endsection
@section('js')
<script src="{{ asset('admin/ckeditor/ckeditor.js')}}"></script>
@endsection