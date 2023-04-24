@extends('backend.layouts.admin')

@section('title')
    {{$list_page.' '.$inner_page_module_name}}
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('admin/timepicker/bootstrap-timepicker.min.css')}}">
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
						@if(empty($timesheet))
							<form method="POST" action="{{route('admin.timesheets.store')}}">
								@csrf
						@else
							<form method="POST" action="{{route('admin.timesheets.update',$timesheet['id'])}}">
								@csrf
								@method('PATCH')
								<input type="hidden" class="timesheetId" value="{{$timesheet->id}}">
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
										@if(!empty($user_timesheet))
											@php $lastKey = array_key_last($user_timesheet) @endphp
									        <input type="hidden" class="last_array_key" value="{{$lastKey}}" >
											@foreach($user_timesheet as $k => $v)
												@include('backend.timesheet.update-table-row')
											@endforeach
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
										<input type="text" class="txttotal" value="{{$timesheet['hours'] ?? '0'}}" name="txttotal">
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
<script src="{{asset('admin/timepicker/bootstrap-timepicker.min.js')}}"></script>
<script src="{{asset('admin/timepicker/calculate.js')}}"></script>
<script>
	var pathArray = window.location.pathname.split( '/' );
    var urlSegment = pathArray[pathArray.length-1];
	var Key = parseInt($('.last_array_key').val())+parseInt(1);
	var lastKey = parseInt(lastKey)+parseInt(1);
	var id = $('.timesheetId').val();

	$(document).ready(function(){
		$(function () {
		    $('.txthour').timepicker({
		        showMeridian: false,
		        defaultTime: false,
		         icons:
                {
                	up: 'fa fa-angle-up',
                    down: 'fa fa-angle-down'
                },
		    }).on('change', function () {
		         gettime();
		    });
		});
		$(".select2-with-label-multiple").select2({
		    placeholder: "Select Users",
		});
		$('.txthour').blur(function () {
	        gettime();
		});
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

	$(document).on('click', '.tr_clone_add', function () {
		if(urlSegment == 'create'){
			timesheetShow(2);
		}else{
			timesheetShow(lastKey);
		}
        /*var new_id = Math.random();
        var $tr = $(this).closest('tr');
        var $lastTr = $tr.closest('table').find('tr:last');
        var $clone = $lastTr.clone();
        var btn_delete = "<button class='btn btn-danger btn-sm tr_clone_delete'><i class='fa fa-minus'></i></button>";
        $clone.find(".tr_clone_add").replaceWith(btn_delete);
        
        $clone.find('input:text').val('');
        $tr.closest('tbody').append($clone);

        $('#txt_hours'+new_id).timepicker("destroy");
        $('#txt_hours'+new_id).timepicker();*/
	});
	if(urlSegment == 'create'){
		timesheetShow(1);
	}
	function timesheetShow(rowId) {
		$.ajax({
            type:"POST",
            url: "{{route('admin.createTimesheet')}}",
            data: {
              "_method" : 'POST',
              "row_id": rowId,
              "_token": "{{ csrf_token() }}",
              "id": id
            },
            dataType: 'json',
            success: function(res){
            	$('tbody').append(res.html);
            }
        });
	}
	$('table').on('focus', 'input.txthour:not(.hastimepicker)', function () {
    	$('.txthour').timepicker({
	             showMeridian: false,
	             defaultTime: false,
	              icons:
                {
                    up: 'fa fa-angle-up',
                    down: 'fa fa-angle-down'
                },
	        }).on('change', function () {
	             gettime();
	        });
	});

    $(document).on('click', '.tr_clone_delete', function () {
        var parentId = $(this).closest('table').attr('id');
        if ($('#' + parentId + '  tr').length > 2) {
            var $tr = $(this).closest('tr');
        	$tr.remove();
        	gettime();
        }
        return false;
	});
</script>
@endsection
