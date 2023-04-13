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
					<a href="{{route('admin.rates.index')}}" class="btn btn-primary btn-sm me-3"> <i class="fas fa-arrow-left"></i></a>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-6">
					<div class="card">
						@if(!empty($rateCard))
							<form method="POST" action="{{route('admin.rates.update',$rateCard['id'])}}" id="rateCard">
							@csrf
							@method('PATCH')
						@else
							<form method="POST" action="{{route('admin.rates.store')}}" id="rateCard">
							@csrf
						@endif
							<div class="card-body">
								<div class="row">
									<div class="col-xl-12 mb-4">
									  	<label  class="form-label font-w600">Select Project Type<span class="text-danger scale5 ms-2">*</span></label>
										<select class="default-select form-control" name="project_type_id">
											<option value="">Select Project Type</option>
											@foreach($projectTypes as $projectType)
												<option value="{{$projectType->id}}" @if(isset($rateCard->project_type_id) && $rateCard->project_type_id == $projectType->id) {{'selected'}} @endif>{{$projectType->name}}</option>
											@endforeach
										</select>
										<div class="projectType"></div>
										@error('project_type_id')
											<div class="error">{{ $message }}</div>
										@enderror
									</div>
								</div>
								<div class="row">
									<div class="col-lg-5">
										<label class="form-label font-w600 mb-4">Rates :</label>
									</div>
									<div class="col-lg-7 col-md-7">
										<div class="col-xl-12 mb-4">
										  	<label  class="form-label font-w600">Junior  €</label>
											<input type="text" name="junior" class="form-control w-auto d-inline-block" value="{{$rateCard->junior ?? ''}}">
										</div>
										<div class="col-xl-12 mb-4">
										  	<label  class="form-label font-w600">Medior  €</label>
											<input type="text" name="medior" class="form-control w-auto d-inline-block" value="{{$rateCard->medior ?? ''}}">
										</div>
										<div class="col-xl-12 mb-4">
										  	<label  class="form-label font-w600">Senior  €</label>
											<input type="text" name="senior" class="form-control w-auto d-inline-block" value="{{$rateCard->senior ?? ''}}">
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer text-end">
								<div>
									<input type="submit" value="Submit" class="btn btn-primary me-3">
									<a href="{{route('admin.rates.index')}}" type="submit" class="btn btn-secondary">Close</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
        </div>
    </div>
@endsection
