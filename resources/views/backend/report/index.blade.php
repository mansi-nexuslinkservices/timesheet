@extends('backend.layouts.admin')

@section('title')
    {{$module_name.' '.$list_page}}
@endsection

@section('css')
<link href="{{ asset('admin/bootstrap-datepicker-master/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')
	<div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="d-flex align-items-center mb-4 flex-wrap">
					<h4 class="fs-20 font-w600  me-auto">{{$module_name}}</h4>
				</div>
				<div class="row">
					<div class="col-xl-4 mb-4">
						<label class="form-label font-w600">From Date</label>
						<input type="text" name="from_date" class="form-control from_date datepicker" placeholder="Select from date" value="" autocomplete="off">
					</div>
					<div class="col-xl-4 mb-4">
						<label class="form-label font-w600">To Date</label>
						<input type="text" name="to_date" class="form-control to_date datepicker" placeholder="Select to date" value="" autocomplete="off">
					</div>
					{{-- <div class="col-xl-4 mb-4">
						<label  class="form-label font-w600">Select Project Type</label>
						<select class="default-select form-control" name="project_type_id">
							<option value="">Select Project Type</option>
							@foreach($projectTypes as $projectType)
								<option value="{{$projectType->id}}" @if(isset($project->project_type_id) && $project->project_type_id == $projectType->id) {{'selected'}} @endif>{{$projectType->name}}</option>
							@endforeach
						</select>
					</div> --}}
				</div>
				<div class="row">
					<div class="col-xl-12">
						<div class="table-responsive">
							<table class="table display mb-4 dataTablesCard designation-table table-responsive-xl card-table" id="example5">
								<thead>
									<tr>
										<th>No</th>
										<th>Project Name</th>
										<th>Hours</th>
										{{-- <th>Experience Level</th> --}}
										<th>Amount</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
            </div>
        </div>
@endsection
@section('js')
@include('backend.toastr-message.alert')
<script src="{{ asset('admin/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('backend/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
<script src="{{ asset('backend/js/plugins-init/sweetalert.init.js') }}"></script>
	<script>
		$(document).ready(function(){
			var from_date = $('.from_date').val();
			var to_date = $('.to_date').val();

			$('.datepicker').datepicker({
    			formatDate:'yy-mm-dd'
			});

			$("#example5").dataTable().fnDestroy();
			var table = $('#example5').dataTable({
				destroy: true,
	            processing:true,
	            responsive: true,
	            lengthChange: true,
	            pageLength: 10,
	            columnDefs: [
	            { orderable: false, targets: -1}
	            ],
	            autoWidth: false,
	            ajax: {
	            	'url': "{{ route('admin.getReport') }}",
	            	'data' : function(data){
	            		data.from_date = $('.from_date').val();
						data.to_date = $('.to_date').val();	
					}
				},
	            columns: [
	                {render: function (data, type, row, meta) {
	                    return meta.row + meta.settings._iDisplayStart + 1;
	                }},
	               	{data: 'project_name'},
					{data: 'hours'},
					/*{data: 'ex_level'},*/
	                {data: 'amount'},
	            ],
	        });
	    });

	    $(document).on("change",".from_date" ,function()
		{
			$('#example5').DataTable().ajax.reload();
		});
		$(document).on("change",".to_date" ,function()
		{
			$('#example5').DataTable().ajax.reload();
		});
  	</script>
@endsection