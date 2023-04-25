@extends('backend.layouts.admin')

@section('title')
    {{$module_name.' '.$list_page}}
@endsection

@section('content')
	<div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="d-flex align-items-center mb-4 flex-wrap">
					<h4 class="fs-20 font-w600  me-auto">{{$module_name.' '.$list_page}}</h4>
					<div>
						<a href="{{route('admin.roles.create')}}" class="btn btn-primary me-3 btn-sm"><i class="fas fa-plus me-2"></i>Add New Role</a>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-12">
						<div class="table-responsive">
							<table class="table display mb-4 dataTablesCard designation-table table-responsive-xl card-table" id="example5">
								<thead>
									<tr>
										<th>No</th>
										<th>Name</th>
										<th>Created Date</th>
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
	<script src="{{ asset('backend/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('backend/js/plugins-init/sweetalert.init.js') }}"></script>
	<script>
		$(document).ready(function(){
			$("#example5").dataTable().fnDestroy();
			var table = $('#example5').dataTable({
				destroy: true,
	            processing:true,
	            responsive: true,
	            lengthChange: true,
	            pageLength: 10,
				"initComplete": function(settings, json) {
					$("#example5").wrap(
						"<div style='overflow-x:auto; width:100%;position:relative;' class='datatable-main'></div>"
					);
				},
	            columnDefs: [
	            { orderable: false, targets: -1}
	            ],
	            autoWidth: false,
	            ajax: "{{ route('admin.getRole') }}",
	            columns: [
	                {render: function (data, type, row, meta) {
	                    return meta.row + meta.settings._iDisplayStart + 1;
	                }},
	                {data: 'name'},
	                {data: 'created_at'},
	                {"render": function (data, type, row, meta ) {
	                    let id = JSON.stringify(row.id);
	                    var edit_url  = "{{route('admin.roles.edit',':id')}}";
	                    var delete_url  = "{{route('admin.roles.destroy',':id')}}";
	                    edit_url = edit_url.replace(':id', id );
	                    delete_url = delete_url.replace(':id', id );
	                    return "<div class='action-buttons d-flex justify-content-end'><a href="+edit_url+" class='btn btn-secondary light mr-2'><svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='24px' height='24px' viewBox='0 0 24 24' version='1.1' class='svg-main-icon'><g stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'><rect x='0' y='0' width='24' height='24'></rect><path d='M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z' fill='#000000' fill-rule='nonzero' transform='translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409)'></path><rect fill='#000000' opacity='0.3' x='5' y='20' width='15' height='2' rx='1'></rect></g></svg></a><a onclick='deleteRow("+id+");' href='javascript:;' class='btn btn-danger light'><svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='24px' height='24px' viewBox='0 0 24 24' version='1.1' class='svg-main-icon'><g stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'><rect x='0' y='0' width='24' height='24'></rect><path d='M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z' fill='#000000' fill-rule='nonzero'></path><path d='M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z' fill='#000000' opacity='0.3'></path></g></svg></a></div>"
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
			            var url = '{{ route("admin.roles.destroy", ":id") }}';
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