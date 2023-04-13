@extends('backend.layouts.admin')

@section('title')
    {{$module_name}}
@endsection

@section('css')
<link href="{{ asset('admin/bootstrap-datepicker-master/css/bootstrap-datepicker.min.css') }}">
<style>
	.author-profile .upload-link{
		background: #9ea0a5 !important;
	}
</style>
@endsection

@section('content')
	<div class="content-body">
		<div class="container-fluid">
			<div class="d-flex align-items-center mb-4">
				<h4 class="fs-20 font-w600 mb-0 me-auto">{{$module_name}}</h4>
				<div>
					<a href="{{route('admin.home')}}" class="btn btn-primary btn-sm me-3"> <i class="fas fa-arrow-left"></i></a>
				</div>
			</div>

			<div class="row">
				<div class="col-xl-12">

					<div class="card">
						<form method="POST" action="{{ route('admin.profile.update',$user->id) }}" enctype="multipart/form-data" id="userProfile">

							@csrf
							@method('PATCH')

							@php $date = \Carbon\Carbon::parse($user->birth_date)->format('m/d/Y') @endphp
							
							<div class="card-body">
								<div class="row">
									<div class="col-md-2 mb-4">
										<div class="author-profile">
											<div class="author-media">
												<img src="@if(isset($user['profile']) && $user['profile'] != '') {{asset('storage/user-profile/thumb-images/'.$user['profile']) }} @else {{asset('backend/images/profile/userimg.png') }} @endif"
												alt="" id="previewImg">
												<div class="upload-link" title="" data-bs-toggle="tooltip" data-placement="right" data-original-title="update">
													<input type="file" class="update-flie"
														onchange="loadPreview(this);"  name="profile">
													<i class="fa fa-camera"></i>
												</div>
											</div>
											<div class="author-info">
												<h6 class="title">{{$user['name'].' ' ?? ''}}{{$user['surname'] ?? ''}}</h6>
												<span>{{$user['specialty'] ?? ''}}</span>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 mb-4">
									  <label class="form-label font-w600">First Name<span class="text-danger scale5 ms-2">*</span></label>
										<input type="text" class="form-control firstName" name="name" placeholder="Enter first name" value="{{ old('name',$user['name'] ?? '') }}">
										@error('name')
    										<div class="error">{{ $message }}</div>
										@enderror
									</div>
									<div class="col-md-4 mb-4">
									  	<label class="form-label font-w600">Last Name<span class="text-danger scale5 ms-2">*</span></label>
										<input type="text" class="form-control lastName" name="surname" placeholder="Enter last name" value="{{ old('surname',$user['surname'] ?? '') }}">
										@error('surname')
    										<div class="error">{{ $message }}</div>
										@enderror
									</div>
									<div class="col-md-4 mb-4">
										<label class="form-label font-w600">Email Address<span class="text-danger scale5 ms-2">*</span></label>
										<input type="text" class="form-control Email" name="email" placeholder="Enter email" value="{{ old('email',$user['email'] ?? '') }}">
										@error('email')
    										<div class="error">{{ $message }}</div>
										@enderror
									</div>
									
								</div>
								<div class="row">
									<div class="col-md-4 mb-4">
										<label class="form-label font-w600">Gender<span class="text-danger scale5 ms-2">*</span></label>
										<select class="default-select form-control" name="gender">
											<option>Select Gender</option>
											<option value="1" @if(isset($user->gender) && $user->gender == 1) {{'selected'}} @endif>Male</option>
											<option value="2" @if(isset($user->gender) && $user->gender == 2) {{'selected'}} @endif>Female</option>
										</select>
										<div class="genderId"></div>
									</div>
									<div class="col-md-4 mb-4">
										<label class="form-label font-w600">Birth Date<span class="text-danger scale5 ms-2">*</span></label>
										<input id="datepicker" class="{{-- datepicker-default  --}}form-control birthDate" type="text" id="datepicker" name="birth_date" placeholder="Enter birth date" value="{{$date ?? ''}}" autocomplete="off">
									</div>
									<div class="col-md-4 mb-4">
										<label class="form-label font-w600">Phone<span class="text-danger scale5 ms-2">*</span></label>
										<input type="text" class="form-control phone" placeholder="Enter phone number" name="phone" value="{{ old('phone',$user['phone'] ?? '') }}">
										@error('phone')
    										<div class="error">{{ $message }}</div>
										@enderror
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 mb-4">
										<label class="form-label font-w600">Specialty</label>
										<input type="text" class="form-control userSpeciality" name="specialty" placeholder="Enter specialty" value="{{ old('specialty',$user['specialty'] ?? '') }}">
										@error('specialty')
    										<div class="error">{{ $message }}</div>
										@enderror
									</div>
									<div class="col-md-4 mb-4">
										<label class="form-label font-w600">Skills</label>
										<input type="text" class="form-control userSkill" name="skills" placeholder="Enter skills" value="{{ old('skills',$user['skills'] ?? '') }}">
										@error('skills')
    										<div class="error">{{ $message }}</div>
										@enderror
									</div>
								</div>
							</div>
							<div class="card-footer text-end">
								<div>
									<button type="submit" class="btn btn-primary">UPDATE</button>
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
	@include('backend.toastr-message.alert')
	<script>
		$(document).ready(function(){
			$(".multi-select").select2({
			    placeholder: "Select Project Type",
			});
			var url = "{{ url()->current() }}";
			var route = "{{route('admin.profile.create')}}";
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
		function loadPreview(input, id) {
        id = id || '#previewImg';
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                //$(id).attr('src', e.target.result).width(200).height(150);
                $(id).attr('src', e.target.result).attr("style", "display:block");
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
	</script>
@endsection
