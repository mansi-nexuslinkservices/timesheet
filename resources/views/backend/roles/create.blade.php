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
					<a href="{{route('admin.roles.index')}}" class="btn btn-primary btn-sm me-3"> <i class="fas fa-arrow-left"></i></a>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-12">
					<div class="card">
						@if(!empty($role))
							<form method="POST" action="{{route('admin.roles.update',$role['id'])}}" id="roleForm">
							@csrf
							@method('PATCH')
						@else
							<form method="POST" action="{{route('admin.roles.store')}}" id="roleForm">
							@csrf
						@endif
							
							<div class="card-body">
								<div class="row">
									<div class="col-xl-12  col-md-6 mb-4">
									  <label  class="form-label font-w600">Name<span class="text-danger scale5 ms-2">*</span></label>
										<input type="text" class="form-control designationName" name="name" placeholder="Enter name" aria-label="name" value="{{old('name', $role['name'] ?? '')}}">
										@error('name')
											<div class="error">{{ $message }}</div>
										@enderror
									</div>
								</div>
								<div class="form-group">
                    				<label  class="form-label font-w600 mb-4">Permissions<span class="text-danger scale5 ms-2">*</span></label>
                				</div>

                <div class="row validate_permission">
                    @php
                        $all_modules = array(
                            'admin-users',
                            'employees',
                            'employee-types',
                            'designations',
                            'projects',
                            'project-types',
                            'timesheets',
                            'rates',
                            'clients',
                            'role'
                        );

                        $db_permission_final = array();
                        foreach ($db_permission as $key => $value) {
                            $db_permission_final[$value->name] = $value->id;
                        }
                    @endphp

                    @foreach ($all_modules as $value1)
                        <div class="col-12 col-md-3 mb-3">
                        	<div class="form-check custom-checkbox mb-3">
								<input type="checkbox" class="form-check-input" id="customCheckBox{{ $value1 }}" name="permission[]"  value="{{ $db_permission_final[$value1] }}" @if(!empty($rolePermissions))@if(in_array($db_permission_final[$value1], $rolePermissions))  checked="true" @endif @endif>
								<label class="form-check-label font-weight-bold" for="customCheckBox{{$value1 }}">{{$value1}}</label>
							</div>
 						</div>
                	@endforeach
				</div>
            </div>	
		</div>
		<div class="card-footer text-end">
			<div>
				<input type="submit" value="Submit" class="btn btn-primary me-3">
				<a href="{{route('admin.roles.index')}}" type="submit" class="btn btn-secondary">Close</a>
			</div>
		</div>
						</form>
					</div>
				</div>
			</div>
        </div>
    </div>
@endsection