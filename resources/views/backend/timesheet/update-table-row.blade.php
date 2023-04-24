@php $row_id = $k + 1; @endphp
<tr>
	<td>
		<select class="form-control default-select" name="timesheet[{{$row_id}}][project_id]">
			<option value="">Select Project</option>
			@foreach($projects as $project)
				<option value="{{$project->id}}" @if($v['project_id'] == $project['id']) {{'selected'}} @endif>{{$project->name}}</option>
			@endforeach
		</select>
	</td>
	<td>
		<textarea class="form-control" name="timesheet[{{$row_id}}][task_details]" row="5" >{{$v['task_details']}}</textarea>
	</td>
	<td>
		<select class="form-control default-select" name="timesheet[{{$row_id}}][status]">
			<option value="" selected="">Select Task Status</option>
			<option value="1" @if($v['task_status'] == 1) {{'selected'}} @endif>Completed</option>
			<option value="0" @if($v['task_status'] == 0) {{'selected'}} @endif>Pending</option>
		</select>
	</td>
	<td>
		<div class="bootstrap-timepicker">
			<input type="text" class="form-control txthour" name="timesheet[{{$row_id}}][hours]" value="{{$v['task_hours'] ?? ''}}" autocomplete="off">
		</div>
	</td>
	@if($k == 0)
		<td>
			<input type="button" class="btn btn-primary btn-sm tr_clone_add" value="+">
		</td>
	@else
		<td>
			<button class='btn btn-danger btn-sm tr_clone_delete'><i class='fa fa-minus'></i></button>
		</td>
	@endif
</tr>