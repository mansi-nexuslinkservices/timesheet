@extends('backend.layouts.admin')

@section('title')
    {{$list_page.' '.$inner_page_module_name}}
@endsection

@section('css')
<link href="{{ asset('admin/bootstrap-datepicker-master/css/bootstrap-datepicker.min.css') }}">

{{-- <link rel="stylesheet" href="{{ asset('admin/pickadate/themes/default.css') }}">
<link rel="stylesheet" href="{{ asset('admin/pickadate/themes/default.date.css') }}"> --}}
<style>
	.status{
		margin-top: 35px;
	}
</style>
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
				<div class="col-xl-12">
					<div class="card">
						@if(!empty($employee))
							<form method="POST" action="{{route('admin.employees.update',$employee['id'])}}" id="userForm">
							@csrf
							@method('PATCH')
							@php $date = \Carbon\Carbon::parse($employee->joining_date)->format('m/d/Y') @endphp
						@else
							<form method="POST" action="{{route('admin.employees.store')}}" id="userForm">
							@csrf
						@endif
							
							<div class="card-body">
								<div class="row">
									<div class="col-xl-4 mb-4">
									  <label  class="form-label font-w600">Username<span class="text-danger scale5 ms-2">*</span></label>
										<input type="text" class="form-control userName" name="username" placeholder="Enter username"  value="{{old('username', $employee['username'] ?? '')}}">
										@error('username')
											<div class="error">{{ $message }}</div>
										@enderror
									</div>

									<div class="col-xl-4 mb-4">
									  <label  class="form-label font-w600">Email<span class="text-danger scale5 ms-2">*</span></label>
										<input type="email" class="form-control userEmail" name="email" placeholder="Enter email" aria-label="email" value="{{old('email', $employee['email'] ?? '')}}">
										@error('email')
											<div class="error">{{ $message }}</div>
										@enderror
									</div>

									<div class="col-xl-4 mb-4">
									  	<label  class="form-label font-w600">Password<span class="text-danger scale5 ms-2">*</span></label>
										<input type="password" class="form-control userPassword" name="password" placeholder="Enter password" aria-label="password" value="{{old('password', $employee['password'] ?? '')}}">
										@error('password')
											<div class="error">{{ $message }}</div>
										@enderror
									</div>

								<div class="col-xl-4 mb-4">
								  	<label  class="form-label font-w600">Select Experience Level<span class="text-danger scale5 ms-2">*</span></label>
									<select class="form-control default-select"  name="user_type_id">
										<option value="">Select Experience Level</option>
										@foreach($employeeTypes as $employeeType)
											<option value="{{$employeeType->id}}" @if(isset($employee->user_type_id) && $employee->user_type_id == $employeeType->id) {{'selected'}} @endif>{{$employeeType->name}}</option>
										@endforeach
									</select>
									<div class="userTypeId"></div>
								</div>

								<div class="col-xl-4 mb-4">
								  	<label  class="form-label font-w600">Select Designation <span class="text-danger scale5 ms-2">*</span></label>
									<select class="form-control default-select designation" name="designation_id">
										<option value="">Select Designation</option>
										@foreach($designations as $designation)
											<option value="{{$designation->id}}" @if(isset($employee->designation_id) && $employee->designation_id == $designation->id) {{'selected'}} @endif>{{$designation->name}}</option>
										@endforeach
									</select>
									<div class="designationId"></div>
								</div>

								<div class="col-xl-4 mb-4 projectManager">
									<label  class="form-label font-w600">Select Project Manager {{-- <span class="text-danger scale5 ms-2">*</span> --}}</label>
									<select class="multi-select form-control" name="project_manager_id[]" multiple="multiple">
										<option>Select Project Manager</option>
										@foreach($projectManagers as $manager)
											<option value="{{$manager['id']}}" @if(isset($userProjectManagers) && !empty($userProjectManagers)) @if(in_array($manager['id'], $userProjectManagers)) {{ 'selected' }} @endif @endif>{{$manager['name']}}</option>
										@endforeach
									</select>
									@error('project_manager_id')
										<div class="error">{{ $message }}</div>
									@enderror
								</div>

								<div class="col-xl-4 mb-4 teamLeader">
								  	<label  class="form-label font-w600">Select Team Leader{{-- <span class="text-danger scale5 ms-2">*</span> --}}</label>
									<select class="form-control default-select" name="team_leader_id">
										<option value="">Select Team Leader</option>
										@foreach($teamLeaders as $teamleader)
											<option value="{{$teamleader->id}}" @if(isset($employee->team_leader_id) && $employee->team_leader_id == $teamleader->id) {{'selected'}} @endif>{{$teamleader->name}}</option>
										@endforeach
									</select>
								</div>

								{{-- <div class="col-xl-4 mb-4">
								  	<label  class="form-label font-w600">Select Project<span class="text-danger scale5 ms-2">*</span></label>
									<select class="multi-select form-control" name="project_id[]" multiple="multiple">
										@foreach($projects as $project)
											<option value="{{$project['id']}}" @if(isset($userProjects) && !empty($userProjects)) @if(in_array($project['id'], $userProjects)) {{ 'selected' }} @endif @endif>{{$project['name']}}</option>
										@endforeach
									</select>
									<div class="userProjectType"></div>
									@error('project_id')
										<div class="error">{{ $message }}</div>
									@enderror
								</div> --}}

								<div class="col-xl-4 mb-4">
									<label  class="form-label font-w600">Employee Code<span class="text-danger scale5 ms-2">*</span></label>
									<input type="text" name="employee_code" class=" form-control empCode" placeholder="Enter Employee Code" value="{{$employee->employee_code ?? ''}}" autocomplete="off">
									@error('employee_code')
										<div class="error">{{ $message }}</div>
									@enderror
								</div>

								<div class="col-xl-4 mb-4">
									<label  class="form-label font-w600">Joining Date<span class="text-danger scale5 ms-2">*</span></label>
									<input type="text" name="joining_date" class="{{-- datepicker-default --}} form-control joiningDate" id="datepicker" placeholder="Select date" value="{{$date ?? ''}}" autocomplete="off">
									@error('joining_date')
										<div class="error">{{ $message }}</div>
									@enderror
								</div>
								
								<div class="col-xl-4 status">
									<span>Status:<label class="radio-inline mx-3"><input type="radio" name="status" class="form-check-input" value="1" @if(isset($employee['status']) && $employee['status'] == 1) {{'checked'}} @endif checked=""> Active</label></span>
									<span><label class="radio-inline me-3"><input type="radio" name="status" class="form-check-input" value="0" @if(isset($employee['status']) && $employee['status'] == 0) {{'checked'}} @endif> In Active</label></span>
									@error('status')
										<div class="error">{{ $message }}</div>
									@enderror
								</div>
							</div>

							<div class="card-footer text-end mt-4">
								<div>
									<input type="submit" value="Submit" class="btn btn-primary me-3">
									<a href="{{route('admin.employees.index')}}" type="submit" class="btn btn-secondary">Close</a>
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
<script src="{{ asset('admin/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js') }}"></script>
<script>
	$(document).ready(function(){
		$(".multi-select").select2({
		    placeholder: "Select Project",
		});
		var url = "{{ url()->current() }}";
		var route = "{{route('admin.employees.create')}}";
		if(url == route){
			$("#datepicker").datepicker({
				autoclose: true,
				immediateUpdates: true,
			    todayHighlight: true,
			    defaultDate: new Date(),
			}).on('changeDate',function(obj){
				if(obj.date != 'undefine'){
					$('.datepicker td.day').removeClass('today');
				}
	        });
		}else{
			$("#datepicker").datepicker({
				autoclose: true,
				immediateUpdates: true,
			    todayHighlight: false,
			    defaultDate: new Date(),
			}).on('changeDate',function(obj){
				if(obj.date != 'undefine'){
					$('.datepicker td.day').removeClass('today');
				}
	        });
		}

		var selected = $('.designation').find(":selected").val();
		if(selected == 3){
			$('.projectManager').hide();
			$('.teamLeader').hide();
		}
		if(selected == 2){
			$('.projectManager').show();
			$('.teamLeader').hide();
		}
		if(selected == 1){
			$('.projectManager').show();
			$('.teamLeader').show();
		}

		$(".designation").on("change",function(selected){
			if($(this).val() == 3){
				$('.projectManager').hide();
				$('.teamLeader').hide();
			}
			if($(this).val() == 2){
				$('.projectManager').show();
				$('.teamLeader').hide();
			}
			if($(this).val() == 1){
				$('.projectManager').show();
				$('.teamLeader').show();
			}
		});
	});
</script>
@endsection
