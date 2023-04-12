<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Timesheet;
use App\Models\Project;
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
            }else{
                $totalData = Timesheet::whereNull('deleted_at')->where('user_id',$user)->count();
            }
            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            if(isset($roleName) && !empty($roleName == 'admin')){
                $query = Timesheet::whereNull('deleted_at')->offset($start)
                    ->limit($limit)
                    ->orderby('id','desc');

                $totalFiltered = Timesheet::whereNull('deleted_at')->count();
            }else{
                $query = Timesheet::whereNull('deleted_at')->where('user_id',$user)->offset($start)
                    ->limit($limit)
                    ->orderby('id','desc');

                $totalFiltered = Timesheet::whereNull('deleted_at')->where('user_id',$user)->count();
            }


            if($request->user != null){
                $query->where('user_id',$request->user);
                $totalFiltered = Timesheet::whereNull('deleted_at')->whereYear('user_id',$request->user)->count();
            }if($request->month != null){
                $query->whereMonth('submitted_date',$request->month);
                $totalFiltered = Timesheet::whereNull('deleted_at')->where('user_id',$user)->whereMonth('submitted_date',$request->month)->count();
            }if($request->year != null){
                $query->whereYear('submitted_date',$request->year);
                $totalFiltered = Timesheet::whereNull('deleted_at')->where('user_id',$user)->whereYear('submitted_date',$request->year)->count();
            }
        
            $records = $query->get();
            $data_arr = array();


            if(!empty($records)) {
                foreach ($records as $record) {
                    $id = $record->id;
                    $timesheet = Timesheet::with('employee')->find($record->id);
                    $userName = $timesheet->employee->name;
                    $val = json_decode($record->task_details,true);
                    $project_name = [];
                    foreach($val['project_id'] as $v){
                        if(!empty($v)){
                            $project = Project::where('id',$v)->first();
                            $project_name[] = $project->name;
                        }
                    }
                    $projectName = implode(' , ' ,$project_name);
                    $hours = $val['total_hours'];
                    $submitted_date = $record->submitted_date;
                    
                    $submitted_date = date("m/d/Y", strtotime($record->submitted_date)) ?? '';
                    $data_arr[] = array(
                        "id" => $id,
                        "user_id" => $userName,
                        "project_id" => $projectName,
                        "hours" => $hours,
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
        $employees = User::with('roles')->whereNotIn('name',['admin'])->get();
        $user_id = auth()->user()->id;
        $d = DB::table('user_project_managers')->where('user_id',$user_id)->pluck('project_manager_id');
        $user_project_managers = json_decode(json_encode($d), true);

        $m =DB::table('projectmanagers')->whereIn('id',$user_project_managers)->get()->toArray();
        $project_managers = json_decode(json_encode($m), true);

        return view('backend.timesheet.create',compact('projects','employees','inner_page_module_name','list_page','project_managers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
        $role = auth()->user()->roles->pluck('name');
        $data = array(
            'project_id' => $request->project_id,
            'task_details' => $request->task_details,
            'status' => $request->status,
            'hours' => $request->hours,
            'total_hours' => $request->txttotal,
            'project_manager' => $request->project_manager
        );
        if(isset($request->submitted_date) && !empty($request->submitted_date)){
            $date = date("Y-m-d", strtotime($request->submitted_date));
        }
        $submitted_date = $date ?? date('Y-m-d');

        $timesheet = new Timesheet;
        $timesheet->user_id =  $user_id;
        $timesheet->submitted_date =  $submitted_date;
        $timesheet->task_details = json_encode($data);
        $timesheet->save();

        if(isset($request->project_manager) && !empty($request->project_manager)){
            $auth_user_mail = auth()->user()->email;
            $project_managers = array_merge($request->project_manager,array($auth_user_mail));
        }

        if(isset($request->cc_user) && !empty($request->cc_user)){
            $cc_user_mail = User::whereIn('id',$request->cc_user)->pluck('email')->toArray();
        }else{
            $cc_user_mail = [];
        }

        $userDetails = User::whereIn('email',$request->project_manager)->get();
        $projectName = Project::whereIn('id',$request->project_id)->pluck('name')->toArray();

        foreach($userDetails as $k => $d){
            $managerName[$k] = array(
                'managerName' => $d['name']
            );
        }
        $userDetails = array(
            'submitted_date' =>  $submitted_date,
            'employeeName' => auth()->user()->name,
            'employeeEmail' => auth()->user()->email,
            'total_hours' => $request->txttotal,
        );
        
        $array = array();
        foreach($projectName as $k => $name){
            $array[$k] = array(
                'projectName' => $name,
            );
        }
        $array1 = $array;
        foreach($request->task_details as $k => $d){
            $array[$k] = array(
                'taskDetails' => $d,
            );
        }
        $array2 = $array;
        foreach($request->status as $k => $s){
            $array[$k] = array(
                'status' => $s,
            );
        }
        $array3 = $array;
        foreach($request->hours as $k => $h){
            $array[$k] = array(
                'hour' => $h,
            );
        }
        $array4 = $array;

        $mainArray = array_replace_recursive($array1,$array2,$array3,$array4,$managerName);

        Mail::to($project_managers)->cc($cc_user_mail)->send(new UserEmail($mainArray,$userDetails));

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
        $val[] = json_decode($timesheet['task_details'],true);

        $offerArray = array();
        $mainArray = array();
        foreach($val as $v){
            $offerArray1 = array();
            foreach($v['hours'] as $k => $h){
                $offerArray[$k] = array(
                    'hours' => $h,
                );
            }
            $offerArray1 = $offerArray;
            
            foreach($v['project_id'] as $k => $p){
                $offerArray[$k] = array(
                    'project_id' => $p,
                );
            }
            $offerArray2 = $offerArray;

            foreach($v['task_details'] as $k => $t){
                $offerArray[$k] = array(
                    'task_details' => $t,
                );
            }
            $offerArray3 = $offerArray;

            foreach($v['status'] as $k => $s){
                $offerArray[$k] = array(
                    'status' => $s,
                );
            }
            $offerArray4 = $offerArray;
    
            $mainArray = array_replace_recursive($offerArray1,$offerArray2,$offerArray3,$offerArray4);
        }
        $user_id = auth()->user()->id;
        $d = DB::table('user_project_managers')->where('user_id',$user_id)->pluck('project_manager_id');
        $user_project_managers = json_decode(json_encode($d), true);

        $m =DB::table('projectmanagers')->whereIn('id',$user_project_managers)->get()->toArray();
        $project_managers = json_decode(json_encode($m), true);

        $employees = User::with('roles')->whereNotIn('name',['admin'])->get();
        return view('backend.timesheet.create', compact('val','project_managers','mainArray','employees','projects','timesheet','list_page','inner_page_module_name'));
    }

    
     
    public function update(Request $request, string $id)
    {
        $user_id = auth()->user()->id;
        $role = auth()->user()->roles->pluck('name');

        $data = array(
            'project_id' => $request->project_id,
            'task_details' => $request->task_details,
            'status' => $request->status,
            'hours' => $request->hours,
            'total_hours' => $request->txttotal,
        );

        if(isset($request->submitted_date) && !empty($request->submitted_date)){
            $date = date("Y-m-d", strtotime($request->submitted_date));
        }
        $submitted_date = $date ?? date('Y-m-d');

        $timesheet = Timesheet::find($id);
        $timesheet->user_id =  $user_id;
        $timesheet->submitted_date =  $submitted_date;
        $timesheet->task_details = json_encode($data);
        $timesheet->save();

        if(isset($request->project_manager) && !empty($request->project_manager)){
            $auth_user_mail = auth()->user()->email;
            $project_managers = array_merge($request->project_manager,array($auth_user_mail));
        }

        if(isset($request->cc_user) && !empty($request->cc_user)){
            $cc_user_mail = User::whereIn('id',$request->cc_user)->pluck('email')->toArray();
        }else{
            $cc_user_mail = [];
        }

        $userDetails = User::whereIn('email',$request->project_manager)->get();
        $projectName = Project::whereIn('id',$request->project_id)->pluck('name')->toArray();

        foreach($userDetails as $k => $d){
            $managerName[$k] = array(
                'managerName' => $d['name']
            );
        }
        $userDetails = array(
            'submitted_date' =>  $submitted_date,
            'employeeName' => auth()->user()->name,
            'employeeEmail' => auth()->user()->email,
            'employeePhone' => auth()->user()->phone,
            'total_hours' => $request->txttotal,
        );
        
        $array = array();
        foreach($projectName as $k => $name){
            $array[$k] = array(
                'projectName' => $name,
            );
        }
        $array1 = $array;
        foreach($request->task_details as $k => $d){
            $array[$k] = array(
                'taskDetails' => $d,
            );
        }
        $array2 = $array;
        foreach($request->status as $k => $s){
            $array[$k] = array(
                'status' => $s,
            );
        }
        $array3 = $array;
        foreach($request->hours as $k => $h){
            $array[$k] = array(
                'hour' => $h,
            );
        }
        $array4 = $array;

        $mainArray = array_replace_recursive($array1,$array2,$array3,$array4,$managerName);

        Mail::to($project_managers)->cc($cc_user_mail)->send(new UserEmail($mainArray,$userDetails));
        
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
