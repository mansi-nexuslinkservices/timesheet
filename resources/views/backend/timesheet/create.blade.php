@extends('backend.layouts.admin')

@section('title')
    {{$list_page.' '.$inner_page_module_name}}
@endsection

@section('css')
<link href="{{ asset('admin/bootstrap-datepicker-master/css/bootstrap-datepicker.min.css') }}">
<link href="{{ asset('admin/clockpicker/css/bootstrap-clockpicker.min.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://www.jqueryscript.net/demo/Minimal-jQuery-Time-Picker-Plugin-with-jQuery-TimePicki/css/timepicki.css">
<style>
	.meridian{
		display: none;
	}
</style>
@endsection

@section('content')
	<div class="content-body">
		<div class="container-fluid">
			<div class="d-flex align-items-center mb-4">
				<h4 class="fs-20 font-w600 mb-0 me-auto">{{$list_page.' '.$inner_page_module_name}}</h4>
			</div>
			<div class="row">
				<div class="col-xl-12">
					<div class="card">
						<div class="row mt-3">
                            <div class="form-group">
                                <div class="col-sm-12 text-center">
                                    <a href="javascript:;" class="pre-day fas fa-arrow-left fa-fw" style="font-size: 30px;"></a>                                    
                                    <span id="current_date" style="margin:0 40px;font-size: 20px;">
                                    @if(isset($timesheet) && !empty($timesheet))
                                    	{{date('d-m-Y',strtotime($timesheet['submitted_date']))}}
                                    @else
                                    	{{date('d-m-Y')}}
                                    @endif
                                   	</span>
                                    <a href="javascript:;" class="next-day fas fa-arrow-right fa-fw" style="font-size: 30px;"></a>
                                </div>
                            </div>
                        </div>
						@if(empty($mainArray))
							<form method="POST" action="{{route('admin.timesheets.store')}}">
								@csrf
						@else
							<form method="POST" action="{{route('admin.timesheets.update',$timesheet['id'])}}">
								@csrf
								@method('PATCH')
						@endif
							<div class="card-body">
								<input type="hidden" name="submitted_date" class="submitDate" value="">
								<table class="timesheet-tbl mb-4" id="row">
									<thead>
										<th class="text-center" width="20%">Projects</th>
										<th class="text-center" width="42%">Task Details</th>
										<th class="text-center" width="20%">Task Status</th>
										<th class="hours" width="17%" colspan="2">Task Hours</th>
									</thead>
									<tbody>
										@if(!empty($mainArray))
										@foreach($mainArray as $k => $v)
											<tr>
												<td>
													<select class="form-control default-select" name="project_id[]">
														<option value="">Select Project</option>
														@foreach($projects as $project)
															<option value="{{$project->id}}" @if($v['project_id'] == $project['id']) {{'selected'}} @endif>{{$project->name}}</option>
														@endforeach
													</select>
												</td>
												<td>
													<textarea class="form-control" name="task_details[]" row="5" >{{$v['task_details']}}</textarea>
												</td>
												<td>
													<select class="form-control default-select" name="status[]">
														<option value="" selected="">Select Task Status</option>
														<option value="1" @if($v['status'] == 1) {{'selected'}} @endif>Completed</option>
														<option value="0" @if($v['status'] == 0) {{'selected'}} @endif>Pending</option>
													</select>
												</td>
												<td>
													<input type="text" class="form-control txthour" name="hours[]" value="{{$v['hours'] ?? ''}}">
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
										@endforeach
										@else

											<tr>
												<td>
													<select class="form-control default-select" name="project_id[]">
														<option value="">Select Project</option>
														@foreach($projects as $project)
															<option value="{{$project->id}}" >{{$project->name}}</option>
														@endforeach
													</select>
												</td>
												<td>
													<textarea class="form-control" name="task_details[]" row="5" ></textarea>
												</td>
												<td>
													<select class="form-control default-select" name="status[]">
														<option value="" selected="">Select Task Status</option>
														<option value="1" >Completed</option>
														<option value="0" >Pending</option>
													</select>
												</td>
												<td>
													{{-- <select class="form-control default-select txthour" name="hours[]">
														<option value="00:00">00:00</option>
														<option value="01:20">1:20</option>
														<option value="02:45">1:45</option>
													</select> --}}
													<input type="text" class="form-control txthour bs-timepicker" name="hours[]" value="">
												</td>
												<td>
													<input type="button" class="btn btn-primary btn-sm tr_clone_add" value="+">
												</td>
											</tr>

											@endif
									</tbody>
								</table>

								<div class="row">
									<div class="col-sm-3 mb-4">
										<label class="form-label font-w600">Email to : </label>
											@if(isset($project_managers) && count($project_managers) > 0)
												@foreach($project_managers as $manager)
													<input type="text" class="txtemail" name="project_manager[]" value="{{$manager['email']}}">
												@endforeach
											@endif
									</div>
									<div class="col-sm-4 mb-4">
										<select class="select2-with-label-multiple js-states d-block"  id="id_label_multiple" multiple="multiple" name="cc_user[]">
											<option value="">Select Users</option>
											@foreach($employees as $employee)
												<option value="{{$employee->id}}">{{$employee->name}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-sm-2 mb-4">
										<label class="form-label font-w600 txthours">Total Hours</label>
									</div>
									<div class="col-sm-2 mb-4">
										<input type="text" class="txttotal" value="{{$val[0]['total_hours'] ?? '0'}}" name="txttotal">
									</div>
								</div>
								<div class="card-footer text-end">
									<div>
										<input type="submit" value="Submit" class="btn btn-primary">
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
<script src="https://www.jqueryscript.net/demo/Minimal-jQuery-Time-Picker-Plugin-with-jQuery-TimePicki/js/timepicki.js" type="text/javascript" charset="utf-8" async defer></script>
<script>
	
	$(document).ready(function(){
		$(".bs-timepicker").timepicki();
		$(".select2-with-label-multiple").select2({
		    placeholder: "Select Users",
		});

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

		totalHours = 0;
		$(".timesheet-tbl").on('input','.txthour', function() {
	    	let value = $(this).val();
	    	if (moment(value, "HH:mm").isValid()) {
			    let start = moment(value, 'HH:mm');
			    let diff = start.diff(start.clone().startOf('day'));
			    totalHours += diff;
			}

		  	let duration = moment.duration(totalHours); //get total
			var total = duration.hours() + ' : ' + duration.minutes();
			$('.txttotal').val(total);
        });

    	$('#datepicker').datepicker({
    		formatDate:'yy-mm-dd'
    	});
        $(document).on('click', '.pre-day', function () {
        	var txtdate = $('#current_date').text();
        	var newdate = moment(txtdate, "DD.MM.YYYY").format("YYYY-MM-DD");
        	var curDay = new Date(newdate);
        	curDay.setDate(curDay.getDate() - 1);
        	var dd = curDay.getDate();
		    var mm = curDay.getMonth() + 1;
		    var yyyy = curDay.getFullYear();
		    var yesterday = dd + '-' + mm + '-' + yyyy;
       		$('#current_date').text(yesterday);
       		$('.submitDate').val(yesterday);
        });

        $(document).on('click', '.next-day', function () {
        	var txtdate = $('#current_date').text();
        	var newdate = moment(txtdate, "DD.MM.YYYY").format("YYYY-MM-DD");
        	var curDay = new Date(newdate);
        	curDay.setDate(curDay.getDate() + 1);
        	var dd = curDay.getDate();
		    var mm = curDay.getMonth() + 1;
		    var yyyy = curDay.getFullYear();
		    var tomorrow = dd + '-' + mm + '-' + yyyy;
       		$('#current_date').text(tomorrow);
       		$('.submitDate').val(tomorrow);
        });
	}); 

 	$(document).on('click', '.tr_clone_add', function () {
        var new_id = Math.random();
        var $tr = $(this).closest('tr');
        var $lastTr = $tr.closest('table').find('tr:last');
        var $clone = $lastTr.clone();
        var btn_delete = "<button class='btn btn-danger btn-sm tr_clone_delete'><i class='fa fa-minus'></i></button>";
        $clone.find(".tr_clone_add").replaceWith(btn_delete);
        $clone.find('td').each(function () {
            var el = $(this).find(':first-child');
            var id = el.attr('data-id') || null;
            var id1 = el.attr('id') || null;
            var el2 = $(this).find(':first-child .custom_date');
            var id2 = el2.attr('data-target') || null;
            var el3 = $(this).find(':first-child .custom_date_div');
            var id3 = el3.attr('data-target') || null;
            if (id) {
                var i = id.substr(id.length - 1);
                var prefix = id.substr(0, (id.length - 1));
                el.attr('data-id', prefix + (+i + 1));
            }
            if (id1) {
                var i = id1.substr(id1.length - 1);
                var prefix = id1.substr(0, (id1.length - 1));
                new_id = prefix + (+i + 1);
                el.attr('id', new_id);                    
            }

            if (id2) {
                var i = id2.substr(id2.length - 1);
                var prefix = id2.substr(0, (id2.length - 1));
                el2.attr('data-target', prefix + (+i + 1));
            }
            if (id3) {
                var i = id3.substr(id3.length - 1);
                var prefix = id3.substr(0, (id3.length - 1));
                el3.attr('data-target', prefix + (+i + 1));
            }
        });
        $clone.find('input:text').val('');
        $tr.closest('tbody').append($clone);

        $('#'+new_id).select("destroy");
        $('#'+new_id).select();
	});

    $(document).on('click', '.tr_clone_delete', function () {
        var parentId = $(this).closest('table').attr('id');
        if ($('#' + parentId + '  tr').length > 2) {
            var $tr = $(this).closest('tr');

            /*totalHours = 0;
	    	let value = $(this).val();
	    	if (moment(value, "HH:mm").isValid()) {
			    let start = moment(value, 'HH:mm');
			    let diff = start.diff(start.clone().startOf('day'));
			    totalHours += diff;
			}

		  	let duration = moment.duration(totalHours); //get total
			var total = duration.hours() + ' : ' + duration.minutes();
			$('.txttotal').val(total);*/

        	$tr.remove();
        }
        return false;
    });
</script>
@endsection
