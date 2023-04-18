@extends('backend.layouts.admin')

@section('title')
    {{$module_name.' '.$list_page}}
@endsection

@section('css')
	<style>
		.dataTables_filter{
			display: none;
		}
	</style>
@endsection

@section('content')
	<div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="d-flex align-items-center mb-4 flex-wrap">
					<h4 class="fs-20 font-w600  me-auto">{{$module_name.' '.$list_page}}</h4>
					<div>
						<a href="{{route('admin.timesheets.create')}}" class="btn btn-primary me-3 btn-sm"><i class="fas fa-plus me-2"></i>Add New Timesheet</a>
					</div>
				</div>

				<div class="row">
					@if(isset($role->roles[0]['name']) && $role->roles[0]['name'] == 'admin')
						<div class="col-xl-3 mb-4">
							<select class="form-control default-select" name="user" id="user">
								<option value="">Select Employee</option>
								@foreach($employees as $employee)
									<option value="{{$employee->id}}">{{$employee->name}}</option>
								@endforeach
							</select>
						</div>
					@endif
					<div class="col-xl-3 mb-4">
						<select class="form-control default-select" name="month" id="month">
							@php $selected_month = date('m'); //current month @endphp
							@for ($i_month = 1; $i_month <= 12; $i_month++)
							    @php $selected = $selected_month == $i_month ? ' selected' : '';@endphp
							    <option value={{$i_month.' '.$selected}}>{{ date('F', mktime(0,0,0,$i_month)) }}</option>
							@endfor
						</select>
					</div>
					<div class="col-xl-3 mb-4">
						<select class="form-control default-select" name="year" id="year">
							@php $curYear = date('Y'); // current year @endphp
							@foreach(range($curYear - 5, $curYear) as $year) {
    							<option value={{$year}} @if($year == $curYear) {{'selected'}} @endif>{{$year}}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="row">
					<div class="col-xl-12">
						<div class="table-responsive">
							<table class="table display mb-4 dataTablesCard timesheet-table table-responsive-xl card-table" id="example5">
								<thead>
									<tr>
										<th>No</th>
										<th>Employee Name</th>
										<th>Project Name</th>
										<th>Hours</th>
										<th>Submitted Date</th>
										{{-- <th>Status</th> --}}
										<th>Actions</th>
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
	<script>
		$(document).ready(function(){
			$("#example5").dataTable().fnDestroy();
			var table = $('#example5').dataTable({
				destroy: true,
	            processing:true,
	            serverSide: true,
				scrollX:true,
	            responsive: true,
	            lengthChange: true,
	            pageLength: 10,
	            columnDefs: [
	            { orderable: false, targets: -1}
	            ],
	            autoWidth: false,
	            ajax: { 
	            	'url': "{{ route('admin.getTimesheet') }}",
	            	'data' : function(data){
	            		data.user = $('#user').val();
						data.month = $('#month').val();
						data.year = $('#year').val();
						data.searchVal = $('.dataTables_filter input').val();	
					}
	            },
	            columns: [
	                {render: function (data, type, row, meta) {
	                    return meta.row + meta.settings._iDisplayStart + 1;
	                }},
	                {data: 'user_id'},
	                {data: 'project_id'},
	                {data: 'hours'},
	                {data: 'submitted_date'},
	                /*{data: 'status'},*/
	                {"render": function (data, type, row, meta ) {
	                    let id = JSON.stringify(row.id);
	                    var view_url  = "{{route('admin.timesheets.edit',':id')}}";
	                    var delete_url  = "{{route('admin.timesheets.destroy',':id')}}";
	                   
	                    view_url = view_url.replace(':id', id );
	                    delete_url = delete_url.replace(':id', id );
	                    return "<div class='action-buttons d-flex justify-content-end'><a href="+view_url+" class='btn btn-success light mr-2'><svg xmlns='http://www.w3.org/2000/svg' class='svg-main-icon' width='24px' height='24px' viewBox='0 0 32 32' x='0px' y='0px'><g data-name='Layer 21'><path d='M29,14.47A15,15,0,0,0,3,14.47a3.07,3.07,0,0,0,0,3.06,15,15,0,0,0,26,0A3.07,3.07,0,0,0,29,14.47ZM16,21a5,5,0,1,1,5-5A5,5,0,0,1,16,21Z' fill='#000000' fill-rule='nonzero'></path><circle cx='16' cy='16' r='3' fill='#000000' fill-rule='nonzero'></circle></g></svg><a onclick='deleteRow("+id+");' href='javascript:;' class='btn btn-danger light'><svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='24px' height='24px' viewBox='0 0 24 24' version='1.1' class='svg-main-icon'><g stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'><rect x='0' y='0' width='24' height='24'></rect><path d='M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z' fill='#000000' fill-rule='nonzero'></path><path d='M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z' fill='#000000' opacity='0.3'></path></g></svg></a></div>"
                		},
                	Class:'text-center'},
	            ],
	        });
	    });


	    function deleteRow(id) {
	       swal({
	            title : "Are you sure want to delete?",
	            text : "You will not be able to recover this imaginary file !!",
	            showCancelButton: true,  
			  	confirmButtonClass: "btn-danger",  
			  	confirmButtonText: " Yes, delete it!",  
			  	closeOnConfirm: false, 
			}).then(
		        function (isConfirm)  {
		        	if (isConfirm.value){
			            var url = '{{ route("admin.timesheets.destroy", ":id") }}';
			            url = url.replace(':id', id );
			            $.ajax({
			                type:"POST",
			                url: url,
			                data: {
			                  "_method" : 'DELETE',
			                  "id": id,
			                  "_token": "{{ csrf_token() }}",
			                },
			                dataType: 'json',
			                success: function(res){
			                    if(res.success == true){
			                      	swal("Done!", "It was succesfully deleted!", "success");
			                        window.setTimeout(
			                        function(){
			                          $('#example5').DataTable().ajax.reload();
			                        },1500)
			                   	 }
			                }
			            });
			        }else{
			        	e.preventDefault();
			        }
	        	},
        	)
		};
		$('#user').on('change', function() {
            $('#example5').DataTable().ajax.reload();
        });
		$(document).on("change","#month" ,function()
		{
			$('#example5').DataTable().ajax.reload();
		});
		$(document).on("change","#year" ,function()
		{
			$('#example5').DataTable().ajax.reload();
		});

		function deleteRow(id) {
	       swal({
	            title : "Are you sure want to delete?",
	            text : "You will not be able to recover this imaginary file !!",
	            showCancelButton: true,  
			  	confirmButtonClass: "btn-danger",  
			  	confirmButtonText: " Yes, delete it!",  
			  	closeOnConfirm: false, 
			}).then(
		        function (isConfirm)  {
		        	if (isConfirm.value){
			            var url = '{{ route("admin.timesheets.destroy", ":id") }}';
			            url = url.replace(':id', id );
			            $.ajax({
			                type:"POST",
			                url: url,
			                data: {
			                  "_method" : 'DELETE',
			                  "id": id,
			                  "_token": "{{ csrf_token() }}",
			                },
			                dataType: 'json',
			                success: function(res){
			                    if(res.success == true){
			                      	swal("Done!", "It was succesfully deleted!", "success");
			                        window.setTimeout(
			                        function(){
			                          $('#example5').DataTable().ajax.reload();
			                        },1500)
			                   	 }
			                }
			            });
			        }else{
			        	e.preventDefault();
			        }
	        	},
        	)
		};
  	</script>
@endsection