@extends('backend.layouts.admin')

@section('title')
    {{$list_page.' '.$inner_page_module_name}}
@endsection

@section('css')
<link href="{{ asset('admin/bootstrap-datepicker-master/css/bootstrap-datepicker.min.css') }}">
<link href="{{ asset('admin/clockpicker/css/bootstrap-clockpicker.min.css') }}" rel="stylesheet">
@endsection

@section('content')
	<div class="content-body">
		<div class="container-fluid">
			<div class="d-flex align-items-center mb-4">
				<h4 class="fs-20 font-w600 mb-0 me-auto">{{$list_page.' '.$inner_page_module_name}}</h4>
				<div>
					<a href="{{route('admin.timesheets.index')}}" class="btn btn-primary btn-sm me-3"> <i class="fas fa-arrow-left"></i></a>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-12">
					<div class="card">
						@if(!empty($timesheet))
							<form method="POST" action="{{route('admin.timesheets.update',$timesheet['id'])}}" id="timesheet">
							@csrf
							@method('PATCH')

							@php $date = \Carbon\Carbon::parse($timesheet->submitted_date)->format('m/d/Y') @endphp
						@else
							<form method="POST" action="{{route('admin.timesheets.store')}}" id="timesheet">
							@csrf
						@endif
							
							<div class="card-body">
								<div class="row">
									<div class="col-xl-4 mb-4">
									  	<label  class="form-label font-w600">Select Project<span class="text-danger scale5 ms-2">*</span></label>
										<select class="form-control default-select" name="project_id">
											@foreach($projects as $project)
												<option value="{{$project->id}}" @if(isset($timesheet->project_id) && $timesheet->project_id == $project->id) {{'selected'}} @endif>{{$project->name}}</option>
											@endforeach
										</select>
										@error('project_id')
											<div class="error">{{ $message }}</div>
										@enderror
									</div>
									<div class="col-xl-4 mb-4">
										<label  class="form-label font-w600">Hours<span class="text-danger scale5 ms-2">*</span></label>
										<div class="input-group clockpicker">
                                            <input type="text" class="form-control" name="hours" placeholder="Enter hours" value="{{old('hours', $timesheet['hours'] ?? '')}}"><span class="input-group-text">
											<i class="far fa-clock"></i></span>
                                        </div>
									</div>
									<div class="col-xl-4 mb-4">
										<label  class="form-label font-w600">Submitted Date<span class="text-danger scale5 ms-2">*</span></label>
										<input type="text" name="submitted_date" class=" form-control submittedDate" id="datepicker" placeholder="Select date" value="{{$date ?? ''}}" autocomplete="off">
									</div>
								</div>

								<div class="row">
									<div class="col-xl-12  col-md-6 mb-4">
									  	<label  class="form-label font-w600">Task Details<span class="text-danger scale5 ms-2">*</span></label>
									  	<textarea class="form-control" id="ckeditor" name="task_details">{{ old('task_details', $timesheet->task_details ?? '') }}</textarea>
									  	<div class="taskDetails" row="5"></div>
									</div>
								</div>

								<div class="mb-4">
									<span>Status:<label class="radio-inline mx-3"><input type="radio" name="status" class="form-check-input" value="1" @if(isset($timesheet['status']) && $timesheet['status'] == 1) {{'checked'}} @endif checked=""> Completed </label></span>
									<span><label class="radio-inline me-3"><input type="radio" name="status" class="form-check-input" value="0" @if(isset($timesheet['status']) && $timesheet['status'] == 0) {{'checked'}} @endif> Pending</label></span>
									@error('status')
										<div class="error">{{ $message }}</div>
									@enderror
								</div>

								<div class="card-footer text-end">
									<div>
										<input type="submit" value="Submit" class="btn btn-primary me-3">
										<a href="{{route('admin.timesheets.index')}}" type="submit" class="btn btn-secondary">Close</a>
									</div>
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
<script src="{{ asset('admin/clockpicker/js/bootstrap-clockpicker.min.js')}}"></script>
<script src="{{ asset('admin/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('admin/plugins-init/clock-picker-init.js')}}"></script>
<script src="{{ asset('admin/ckeditor/ckeditor.js')}}"></script>

<script>
	$(document).ready(function(){
		var url = "{{ url()->current() }}";
		var route = "{{route('admin.timesheets.create')}}";
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
 	});
</script>
@endsection
