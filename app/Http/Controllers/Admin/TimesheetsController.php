<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Timesheet;
use App\Models\UserTimesheet;
use App\Models\Project;
use App\Models\Designation;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Auth;
use DB;
use App\Mail\UserEmail;
use Mail;

class TimesheetsController extends Controller
{
    public $module_name = '';
    public $inner_page_module_name = '';
    public $create_link = '';
    public $list_link = '';
    public $update_link = '';

    public function __construct(){
        $this->module_name = trans('admin/timesheet.module_name');
        $this->inner_page_module_name = trans('admin/timesheet.inner_page_module_name');
        $this->create_link = route('admin.timesheets.create');
        $this->update_link = route('admin.timesheets.update', 'id');
        $this->list_link = route('admin.timesheets.index');
        $this->middleware('permission:timesheets', ['only' => ['index','getTimesheet','create','store','show','edit','update','destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_page = trans('admin/common.list');
        $module_name = $this->module_name;
        $user = auth()->user()->id;
        $role = User::with('roles')->find($user);
        $employees = User::with('roles')->whereNotIn('name',['admin'])->get();

        return view('backend.timesheet.index',compact('role','employees','module_name','list_page'));
    }

    public function getTimesheet(Request $request){
        $user = auth()->user()->id;
        $role = User::with('roles')->find($user);
        if(isset($role) && !empty($role)){
            $roleName = $role->roles[0]['name'];
        }

        $designation_id = Designation::whereIn('name',['project manager','employee','team leader'])->pluck('id');

        $login_user_role = Auth::user()->roles->pluck('name')->first();

        if ($request->ajax()) {
            $columns = array( 
                0 =>'id', 
                1 =>'user_id',
                2 =>'project_id',
                3 =>'hours',
                4 =>'submitted_date',
            );
            if(isset($roleName) && !empty($roleName == 'admin')){
                $totalData = Timesheet::whereNull('deleted_at')->count();
            }elseif(isset($roleName) && !empty($roleName == 'project manager')){
                $totalData = Timesheet::with(['employee' => function($query) {
                            $query->whereIn('designation_id', $designation_id);
                        }])->count();
            }else{
                $totalData = Timesheet::whereNull('deleted_at')->where('user_id',$user)->count();
            }
            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            if(isset($roleName) && $roleName == 'admin'){
                $query = Timesheet::whereNull('deleted_at')->offset($start)
                    ->limit($limit)
                    ->orderby('id','desc');

                $totalFiltered = Timesheet::whereNull('deleted_at')->count();

            }elseif(isset($roleName) && $roleName == 'project manager'){
                $query = Timesheet::with(['employee' => function($q) use($designation_id){
                    $q->whereIn('designation_id', $designation_id);
                }])->offset($start)
                    ->limit($limit)
                    ->orderby('id','desc');
                
                $totalFiltered = Timesheet::with(['employee' => function($q) use($designation_id){
                    $q->whereIn('designation_id', $designation_id);
                }])->offset($start)
                    ->limit($limit)
                    ->orderby('id','desc')
                    ->count();  
            }else{
                $query = Timesheet::whereNull('deleted_at')->where('user_id',$user)->offset($start)
                    ->limit($limit)
                    ->orderby('id','desc');

                $totalFiltered = Timesheet::whereNull('deleted_at')->where('user_id',$user)->count();
            }


            if($request->user != null){
                $query->where('user_id',$request->user);
                if(isset($roleName) && $roleName == 'admin'){
                    $totalFiltered = Timesheet::whereNull('deleted_at')->count();
                }else{
                    $totalFiltered = Timesheet::whereNull('deleted_at')->whereYear('user_id',$request->user)->count();
                }
            }if($request->month != null){
                $query->whereMonth('submitted_date',$request->month);
                if(isset($roleName) && $roleName == 'admin'){
                    $totalFiltered = Timesheet::whereNull('deleted_at')->whereMonth('submitted_date',$request->month)->count();
                }else{
                    $totalFiltered = Timesheet::whereNull('deleted_at')->where('user_id',$user)->whereMonth('submitted_date',$request->month)->count();
                }
            }if($request->year != null){
                $query->whereYear('submitted_date',$request->year);
                if(isset($roleName) && $roleName == 'admin'){
                    $totalFiltered = Timesheet::whereNull('deleted_at')->whereYear('submitted_date',$request->year)->count();
                }else{
                    $totalFiltered = Timesheet::whereNull('deleted_at')->where('user_id',$user)->whereYear('submitted_date',$request->year)->count();
                }
            }
            
            $records = $query->get();
            $data_arr = array();


            if(!empty($records)) {
                foreach ($records as $record) {
                    $id = $record->id;
                    $d = Timesheet::with('user_timesheet')->find($id);
                    $projectName = array();
                    foreach($d['user_timesheet'] as $project){
                        $projectName[] = $project->name;
                    }
                    $multiple_project = implode(', ',$projectName);
                    $timesheet = Timesheet::with('user_timesheet','employee')->find($id);
                    $userName = $timesheet->employee->name ?? '';
                    $projectName = $multiple_project ?? '';
                    $total_hours = $record->hours ?? '';                    
                    $submitted_date = date("m/d/Y", strtotime($record->submitted_date)) ?? '';
                    $data_arr[] = array(
                        "id" => $id,
                        "user_id" => $userName,
                        "project_id" => $projectName,
                        "hours" => $total_hours,
                        "submitted_date" => $submitted_date,
                    );
                }
            }
            $json_data = array(
                "draw"            => intval($request->input('draw')),  
                "recordsTotal"    => intval($totalData),  
                "recordsFiltered" => intval($totalFiltered), 
                "data"            => $data_arr  
                );

            echo json_encode($json_data);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_page = trans('admin/common.add');
        $inner_page_module_name = $this->inner_page_module_name;
        $projects = Project::whereNull('deleted_at')
                        ->where('status',1)
                        ->orderBy('id','desc')
                        ->get();
        $user_id = auth()->user()->id;
        $employees = User::with('roles')->whereNotIn('id',[$user_id])->whereNotIn('name',['admin'])->get();
        
        $d = DB::table('user_project_managers')->where('user_id',$user_id)->pluck('project_manager_id');
        $user_project_managers = json_decode(json_encode($d), true);

        $m =DB::table('projectmanagers')->whereIn('id',$user_project_managers)->get()->toArray();
        $project_managers = json_decode(json_encode($m), true);

        return view('backend.timesheet.create',compact('projects','employees','inner_page_module_name','list_page','project_managers'));
    }

    public function createTimesheet(Request $request){
        $id = $request->id;
        $row_id = $request->row_id;
        $projects = Project::whereNull('deleted_at')
                        ->where('status',1)
                        ->orderBy('id','desc')
                        ->get();
            /*if($id != ''){
                $d = DB::table('user_timesheets')->where('timesheet_id',$id)->get();
                $user_timesheet = json_decode(json_encode($d), true);
                $html = view('backend.timesheet.update-table-row',compact('row_id','user_timesheet','projects'))->render();
            }else{*/
                $html = view('backend.timesheet.create-table-row',compact('row_id','projects'))->render();
            //}
            return response()->json([
                'html' => $html,
            ]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
        $data = array(
            'user_id' => $user_id,
            'hours' => $request->txttotal,
        );
        if(isset($request->submitted_date) && !empty($request->submitted_date)){
            $date = date("Y-m-d", strtotime($request->submitted_date));
        }
        $data['submitted_date'] = $date ?? date('Y-m-d');

        $timesheet = Timesheet::create($data);
        $insertId = $timesheet->id;

        foreach($request->timesheet as $d){
            $project = Project::where('id',$d['project_id'])->first();
            $data1 = array(
               'timesheet_id' => $insertId,
               'project_id' => $d['project_id'],
               'project_type_id' => $project['project_type_id'],
               'task_details' => $d['task_details'],
               'task_status' => $d['status'],
               'task_hours' => $d['hours']
            );
            $userTimesheet = UserTimesheet::create($data1);
        }

        return redirect()->route('admin.timesheets.index')->with('success', 'Timesheet created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $list_page = trans('admin/common.view');
        $inner_page_module_name = $this->inner_page_module_name;
        $timesheet = Timesheet::with('project')->find($id);
        return view('backend.timesheet.view', compact('timesheet','list_page','inner_page_module_name'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $list_page = trans('admin/common.edit');
        $inner_page_module_name = $this->inner_page_module_name;
        $projects = Project::whereNull('deleted_at')
                            ->where('status',1)
                            ->orderBy('id','desc')
                            ->get();
        $timesheet = Timesheet::find($id);
        $d = DB::table('user_timesheets')->where('timesheet_id',$id)->get();
        $user_timesheet = json_decode(json_encode($d), true);
        $user_id = auth()->user()->id;

        $d = DB::table('user_project_managers')->where('user_id',$timesheet['user_id'])->pluck('project_manager_id');
        $user_project_managers = json_decode(json_encode($d), true);

        $m =DB::table('projectmanagers')->whereIn('id',$user_project_managers)->get()->toArray();
        $project_managers = json_decode(json_encode($m), true);

        $employees = User::with('roles')->whereNotIn('id',[$user_id])->whereNotIn('name',['admin'])->get();
        return view('backend.timesheet.create', compact('project_managers','user_timesheet','employees','projects','timesheet','list_page','inner_page_module_name'));
    }

    public function update(Request $request, string $id)
    {
        $user_id = auth()->user()->id;
        $data = array(
            'user_id' => $user_id,
            'hours' => $request->txttotal,
        );
        if(isset($request->submitted_date) && !empty($request->submitted_date)){
            $date = date("Y-m-d", strtotime($request->submitted_date));
        }
        $data['submitted_date'] = $date ?? date('Y-m-d');

        $timesheet = Timesheet::find($id);
        $timesheet->update($data);

        $delete = UserTimesheet::where('timesheet_id',$id)->delete();
        foreach($request->timesheet as $d){
            $data1 = array(
               'timesheet_id' => $id,
               'project_id' => $d['project_id'],
               'task_details' => $d['task_details'],
               'task_status' => $d['status'],
               'task_hours' => $d['hours']
            );
            if($d['project_id'] != ''){
                $project = Project::where('id',$d['project_id'])->first();
                $data1['project_type_id'] = $project['project_type_id'];
            }
            $userTimesheet = UserTimesheet::create($data1);
        }

        return redirect()->route('admin.timesheets.index')->with('success', 'Timesheet updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $timesheet = Timesheet::find($id)->delete();
        if ($timesheet == true) {
            return response()->json([
                'success' => true,
                'message' => 'Timesheet deleted successfully!',
            ]);
        }
        return redirect()->route('admin.timesheets.index')->with('success', 'Timesheet deleted successfully!');
    }
}
