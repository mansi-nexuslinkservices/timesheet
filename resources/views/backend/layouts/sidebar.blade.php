<div class="dlabnav">
            <div class="dlabnav-scroll">
				<div class="dropdown header-profile2 ">
					<a class="nav-link " href="javascript:void(0);"  role="button" data-bs-toggle="dropdown">
						<div class="header-info2 d-flex align-items-center">
							<img src="@if(isset($user['profile']) && $user['profile'] != '') {{asset('storage/user-profile/thumb-images/'.$user['profile']) }} @else {{asset('backend/images/profile/userimg.png')}} @endif" alt="{{$user['name'] ?? ''}}">
							<div class="d-flex align-items-center sidebar-info">
								<div>
									<span class="font-w400 d-block">{{$user['name'].' ' ?? ''}}{{ $user['surname'] ?? ''}}</span>
									<small class="text-end font-w400">{{$user_designation->designation->name ?? ''}}</small>
								</div>	
								<i class="fas fa-chevron-down"></i>
							</div>
							
						</div>
					</a>
					<div class="dropdown-menu dropdown-menu-end">
						<a href="{{route('admin.profile.index')}}" class="dropdown-item ai-icon ">
							<svg  xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
							<span class="ms-2">Profile </span>
						</a>
						<a href="email-inbox.html" class="dropdown-item ai-icon">
							<svg  xmlns="http://www.w3.org/2000/svg" class="text-success" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
							<span class="ms-2">Inbox </span>
						</a>
						<a href="{{ route('logout') }}" class="dropdown-item ai-icon" onclick="event.preventDefault();
                        	document.getElementById('logout-form').submit();">
							<svg  xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
							<span class="ms-2">Logout </span>
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        	@csrf
                    	</form>
					</div>
				</div>
				<ul class="metismenu" id="menu">
					<li><a href="{{route('admin.home')}}" class="" aria-expanded="false">
							<i class="flaticon-025-dashboard"></i>
							<span class="nav-text">Dashboard</span>
						</a>
					</li>
                    <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
						<i class="flaticon-013-checkmark"></i><span class="nav-text">User Management</span>
						</a>
                        <ul aria-expanded="false">
                        	@if(isset($user) && !empty($user) && $user->super_admin == 1)
                        		<li class="{{ request()->routeIs('admin.users*') ? 'mm-active' : ''}}"><a class="{{ request()->routeIs('admin.users*') ? 'mm-active' : ''}}" href="{{route('admin.users.index')}}">Admin Users</a></li>
                        	@endif

							<li class="{{ request()->routeIs('admin.employees*') ? 'mm-active' : ''}}"><a class="{{ request()->routeIs('admin.employees*') ? 'mm-active' : ''}}" href="{{route('admin.employees.index')}}">Employees</a></li>
							<li class="{{ request()->routeIs('admin.employee-types*') ? 'mm-active' : ''}}"><a class="{{ request()->routeIs('admin.employee-types*') ? 'mm-active' : ''}}" href="{{route('admin.employee-types.index')}}">Employee Types</a></li>
							<li class="{{ request()->routeIs('admin.designation*') ? 'mm-active' : ''}}"><a class="{{ request()->routeIs('admin.designation*') ? 'mm-active' : ''}}" href="{{route('admin.designation.index')}}">Designations</a></li>	
						</ul>
					</li>
                  
					<li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
							<i class="flaticon-093-waving"></i>
							<span class="nav-text">Projects</span>
						</a>
                        <ul aria-expanded="false">
                            <li class="@if(request()->routeIs('admin.projects*') || request()->routeIs('admin.project-type*')) {{'mm-active'}} @endif"><a class="{{ request()->routeIs('admin.projects*') ? 'mm-active' : ''}}" href="{{route('admin.projects.index')}}">Projects</a></li>
                            <li><a class="{{ request()->routeIs('admin.project-type*') ? 'mm-active' : ''}}" href="{{route('admin.project-type.index')}}">Project Types</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
						<i class="flaticon-050-info"></i>
							<span class="nav-text">Timesheets</span>
						</a>
                        <ul aria-expanded="false">
                            <li class="@if(request()->routeIs('admin.timesheets*') || request()->routeIs('admin.timesheets*')) {{'mm-active'}} @endif"><a class="{{ request()->routeIs('admin.timesheets*') ? 'mm-active' : ''}}" href="{{route('admin.timesheets.index')}}">Timesheets</a></li>
						</ul>
                    </li>

                    <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
					<i class="fas fa-star"></i>
							<span class="nav-text">Rate Card</span>
						</a>
                        <ul aria-expanded="false">
                            <li class="@if(request()->routeIs('admin.rates*') || request()->routeIs('admin.rates*')) {{'mm-active'}} @endif"><a class="{{ request()->routeIs('admin.rates*') ? 'mm-active' : ''}}" href="{{route('admin.rates.index')}}">Rates</a></li>
                        </ul>
                    </li>
                    <li><a href="{{route('admin.report.index')}}" class="" aria-expanded="false">
							<i class="fa fa-file"></i>
							<span class="nav-text">Report</span>
						</a>
					</li>
                </ul>
				
			</div>
			<div class="copyright">
					<p><strong class="text-center">NowOnline</strong></p>
				</div>
        </div>