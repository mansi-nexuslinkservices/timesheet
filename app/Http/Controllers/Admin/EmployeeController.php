<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\UserType;
use App\Models\Designation;
use App\Models\ProjectType;
use App\Models\UserProject;
use Illuminate\Support\Facades\Hash;
use DB;
use Spatie\Permission\Models\Role;


class EmployeeController extends Controller
{
    public $module_name = '';
    public $inner_page_module_name = '';
    public $create_link = '';
    public $list_link = '';
    public $update_link = '';

    public function __construct(){
        $this->module_name = trans('admin/employee.module_name');
        $this->inner_page_module_name = trans('admin/employee.inner_page_module_name');
        $this->create_link = route('admin.employees.create');
        $this->update_link = route('admin.employees.update', 'id');
        $this->list_link = route('admin.employees.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_page = trans('admin/common.list');
        $module_name = $this->module_name;
        return view('backend.employee.index',compact('list_page','module_name'));
    }

    public function getEmployee(Request $request){
        if ($request->ajax()) {
            $records = User::whereNull('deleted_at')->where('id','!=',1)->orderby('id','desc')->get();
            $userProjects = UserProject::all();
            $data_arr = array();
            foreach ($records as $record) {
                $id = $record->id;
                if(!empty($record->id)){
                    $userProjects = UserProject::where('user_id',$record->id)->get();
                    $multiple_project = [];
                    foreach($userProjects as $userProject){
                        $d = Project::whereNull('deleted_at')->where('id',$userProject->project_id)->first();
                        $multiple_project[] = $d->name; 
                    }
                }
                $username = $record->username ?? '-';
                $employee = User::with('employee_type','project','designation')->find($id);
                $employeeType = $employee->employee_type->name ?? '-';
                $projectType = $employee->project->name ?? '-';
                $designation = $employee->designation->name ?? '-';
                

                
                $joining_date = $record->joining_date;
                $status = $record->status;

                if ($record->status == 1) {
                    $status = "<span class='badge badge-success badge-lg light'>Active</span>";
                }
                if ($record->status == 0) {
                    $status = "<span class='badge badge-danger badge-lg light'>In Active</span>";
                }
                if(!empty($record->joining_date)){
                    $joining_date = date("m/d/Y", strtotime($record->joining_date));
                }else{
                    $joining_date = '-';
                }
                // end
                $data_arr[] = array(
                    "id" => $id,
                    "username" => $username,
                    "user_type_id" => $employeeType,
                    "designation_id" => $designation,
                    /*"project_id" => implode(', ',$multiple_project),*/
                    "joining_date" => $joining_date,
                    "status" => $status,
                );
            }
            $response = array(
                "aaData" => $data_arr,
            );
            return response()->json($response);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_page = trans('admin/common.add');
        $inner_page_module_name = $this->inner_page_module_name;

        $employeeTypes = UserType::whereNull('deleted_at')->orderby('id','desc')->get();
        $designations = Designation::whereNull('deleted_at')->orderby('id','desc')->get();
        $projectTypes = ProjectType::whereNull('deleted_at')->orderby('id','desc')->get();
        $projects = Project::whereNull('deleted_at')->orderby('id','desc')->get();
        $managers = DB::table('projectmanagers')->whereNull('deleted_at')->get()->toArray();
        $projectManagers = json_decode(json_encode($managers), true);
        $teamLeaders = DB::table('teamleaders')->whereNull('deleted_at')->get();

        return view('backend.employee.create',compact('employeeTypes','designations','projectTypes','projects','list_page','projectManagers','teamLeaders','inner_page_module_name'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        $date = \Carbon\Carbon::parse($request->joining_date)->format('Y-m-d');
        $request->validate([
            'username' => 'required|unique:users,username,NULL,id,deleted_at,NULL',
            'user_type_id' => 'required',
            'password' => 'required',
            //'project_id' => 'required',
            'designation_id' => 'required',
            'joining_date' => 'required',
            'email' => 'required|unique:users,email,NULL,id,deleted_at,NULL',
            'employee_code' => 'required|unique:users,employee_code,NULL,id,deleted_at,NULL',
        ]);

        $data = array(
            'name' => $request['username'],
            'email' => $request['email'],
            'username' => $request['username'],
            'user_type_id' => $request['user_type_id'],
            'designation_id' => $request['designation_id'],
            'joining_date' => $date,
            'password' => Hash::make($request['password']),
            'employee_code' => $request['employee_code'],
            'team_leader_id' => $request['team_leader_id'],
            'status' => $request['status'],
        ); 

        $users = User::create($data);
        $designation = Designation::where('id',$request->designation_id)->first();
        $role = Role::where('name',$designation->name)->first();
        $users->assignRole($role->id);
        $insertId = $users->id;

        if(!empty($request->project_id) && count($request->project_id) > 0){
            foreach($request->project_id as $projectId){
                $data1 = array(
                    'user_id' => $insertId,
                    'project_id' => $projectId
                );
                $userProject = UserProject::create($data1);
            }
        }

        if(!empty($request->project_manager_id) && count($request->project_manager_id) > 0){
            foreach($request->project_manager_id as $project_manager_Id){
                $data2 = array(
                    'user_id' => $insertId,
                    'project_manager_id' => $project_manager_Id
                );
                $userProject = DB::table('user_project_managers')->insert($data2);
            }
        }
        
        return redirect()->route('admin.employees.index')->with('success', 'Employee created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $list_page = trans('admin/common.view');
        $inner_page_module_name = $this->inner_page_module_name;

        $employee = User::find($id);
        $employeeTypes = UserType::whereNull('deleted_at')->where('id',$employee->user_type_id)->orderby('id','desc')->first();
        $designations = Designation::whereNull('deleted_at')->where('id',$employee->designation_id)->orderby('id','desc')->first();
        $projectTypes = ProjectType::whereNull('deleted_at')->where('id',$employee->project_id)->orderby('id','desc')->first();
        $projects = Project::whereNull('deleted_at')->where('id',$employee->project_id)->orderby('id','desc')->first();

        $userProjects = UserProject::where('user_id',$id)->get();
        $multiple_project = [];
        foreach($userProjects as $project){
            $d = Project::where('id',$project->project_id)->first();
            $multiple_project[] = $d->name;
        }
        $mprojects = implode(', ',$multiple_project);
        return view('backend.employee.view',compact('employee','employeeTypes','designations','projectTypes','mprojects','list_page','inner_page_module_name'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $list_page = trans('admin/common.edit');
        $inner_page_module_name = $this->inner_page_module_name;

        $employee = User::find($id);
        $employeeTypes = UserType::whereNull('deleted_at')->orderby('id','desc')->get();
        $projectTypes = ProjectType::whereNull('deleted_at')->orderby('id','desc')->get();
        $designations = Designation::whereNull('deleted_at')->orderby('id','desc')->get();
        $projects = Project::whereNull('deleted_at')->orderby('id','desc')->get();
        $userProjects = UserProject::where('user_id',$id)->pluck('project_id')->toArray();

        $managers = DB::table('projectmanagers')->whereNull('deleted_at')->get()->toArray();

        $projectManagers = json_decode(json_encode($managers), true);

        $teamLeaders = DB::table('teamleaders')->whereNull('deleted_at')->get();

        $userProjectManagers = DB::table('user_project_managers')->where('user_id',$id)->pluck('project_manager_id')->toArray();

        return view('backend.employee.create',compact('employee','employeeTypes','designations','projectTypes','projects','userProjects','projectManagers','userProjectManagers','teamLeaders','list_page','inner_page_module_name'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $date = \Carbon\Carbon::parse($request->joining_date)->format('Y-m-d');
        $request->validate([
            'username' => 'required|unique:users,username,' . $id . ',id,deleted_at,NULL',
            'user_type_id' => 'required',
            //'project_id' => 'required',
            'designation_id' => 'required',
            'joining_date' => 'required',
            'email' => 'required|unique:users,email,'.$id.',id,deleted_at,NULL',
            'employee_code' => 'required|unique:users,employee_code,'.$id.',id,deleted_at,NULL',
        ]);

        $data = array(
            'name' => $request['username'],
            'email' => $request['email'],
            'username' => $request['username'],
            'user_type_id' => $request['user_type_id'],
            'designation_id' => $request['designation_id'],
            'employee_code' => $request['employee_code'],
            'team_leader_id' => $request['team_leader_id'],
            'joining_date' => $date,
            'status' => $request['status'],
        ); 

        if(isset($request->password) && !empty($request->password)){
            $data['password'] = Hash::make($request['password']);
        }

        $users = User::find($id);
        $users->update($data);
        $designation = Designation::where('id',$request->designation_id)->first();
        $role = Role::where('name',$designation->name)->first();
        $users->syncRoles($role->id);

        if(!empty($request->project_id) && count($request->project_id) > 0){
            UserProject::where('user_id',$id)->delete();
            foreach($request->project_id as $projectId){
                $data1 = array(
                    'user_id' => $id,
                    'project_id' => $projectId
                );
                $userProject = UserProject::create($data1);
            }
        }

        if(!empty($request->project_manager_id) && count($request->project_manager_id) > 0){
            DB::table('user_project_managers')->where('user_id',$id)->delete();
            foreach($request->project_manager_id as $project_manager_Id){
                $data2 = array(
                    'user_id' => $id,
                    'project_manager_id' => $project_manager_Id
                );
                $userProjectManagers = DB::table('user_project_managers')->insert($data2);
            }
        }
        return redirect()->route('admin.employees.index')->with('success', 'Employee updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = User::find($id)->delete();
        if ($employee == true) {
            return response()->json([
                'success' => true,
                'message' => 'Employee deleted successfully!',
            ]);
        }
        return redirect()->route('admin.employees.index')->with('success', 'Employee deleted successfully!');
    }
}
