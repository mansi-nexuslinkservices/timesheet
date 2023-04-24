<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectType;
use App\Models\Timesheet;
use App\Models\Project;
use App\Models\User;
use App\Models\UserType;
use App\Models\UserTimesheet;
use App\Models\RateCard;
use DB;

class ReportController extends Controller
{
    public $module_name = '';
    public $inner_page_module_name = '';
    public $create_link = '';
    public $list_link = '';
    public $update_link = '';

    public function __construct(){
        $this->module_name = trans('admin/report.module_name');
        $this->inner_page_module_name = trans('admin/report.inner_page_module_name');
        $this->create_link = route('admin.report.create');
        $this->update_link = route('admin.report.update', 'id');
        $this->list_link = route('admin.report.index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_page = trans('admin/common.list');
        $module_name = $this->module_name;
        $projectTypes = ProjectType::where('status',1)->get();
        return view('backend.report.index1',compact('list_page','module_name','projectTypes'));
    }


    public function getReport(Request $request){
        if ($request->ajax()) {

            $projects = Project::whereNull('deleted_at')->get();
            $project_hours = array();

            $from = date('Y-m-d',strtotime($request->from_date));
            $to = date('Y-m-d',strtotime($request->to_date));

            $date_filter = Timesheet::whereBetween('submitted_date', [$from, $to])->pluck('id')->toArray();

            /*  Project Hours  */            
            foreach($projects as $k => $p){
                if($request->from_date == null && $request->to_date == null){
                    $project_hours[$p['id']] = UserTimesheet::where('project_id',$p['id'])->pluck('task_hours')->toArray();
                }else{
                    $project_hours[$p['id']] = UserTimesheet::where('project_id',$p['id'])->whereIn('timesheet_id',$date_filter)->pluck('task_hours')->toArray();
                }
            }

            $total_project_hours = array();
            foreach($project_hours as $k => $h){
                $sum_minutes = 0;
                foreach($h as $d){
                    $explodedTime = array_map('intval', explode(':', $d));
                    $sum_minutes += $explodedTime[0]*60+$explodedTime[1];
                }
                 $sumTime[$k] = floor($sum_minutes/60).':'.floor($sum_minutes % 60);
            }
            $total_project_hours = $sumTime;
            /* end */

            /* Project User*/
            $query = RateCard::select('rate_cards.*','projects.id as p_id','projects.name as project_name','project_types.name as project_type_name','users.name','users.id as user_id','users.user_type_id','user_types.name as user_type_name')
                    ->leftjoin('projects','projects.project_type_id','rate_cards.project_type_id')
                    ->leftjoin('project_types','project_types.id','projects.project_type_id')
                    ->leftjoin('project_users','project_users.project_id','projects.id')
                    ->leftjoin('users','users.id','project_users.user_id')
                    ->leftjoin('user_types','user_types.id','users.user_type_id')
                    ->whereNull('projects.deleted_at')
                    ->whereNull('user_types.deleted_at');

                /*if($request->from_date != null && $request->to_date != null){
                    dd("jkh");*/
                    /*$query = $query->leftJoin('timesheets', function($join) use($request){
                        $join->on('timesheets.user_id', '=', 'users.id');
                        $join->select('timesheets.submitted_date');
                    });*/
                //}

            $rate = $query->get();
            //dd($rate);


            if(!empty($projects)) {
                $project_hours = array();
                $sum_minutes = 0;
                foreach ($rate as $k => $record) {
                    $id = $record->p_id;
                    $d = array();
                    foreach($rate as $k => $r1){
                        if($r1['p_id'] == $record->p_id){
                            $str = strtolower($r1['user_type_name']);
                            $cal = $r1[$str];
                        }
                    }

                    foreach($total_project_hours as $k => $r){
                        if($k == $record->p_id){
                            $h = $r;
                        }
                    }
                    $f = explode(':', $h);
                    $hours = sprintf("%02d", $f[0]).':'.$f[1]; 

                    $time = explode(':', $hours);
                    if(count($time) != 2)
                        throw new Exception("Invalid value!");
                    $hr = $time[0] + ($time[1] / 60);

                    $price=$cal;
                    $amount=$hr*$price; 

                    if($request->project){
                        $project_name = $record->project_name;
                    }else if($request->categories){
                        $project_name = $record->project_type_name;
                    }

                    $data_arr[] = array(
                        "id" => $id,
                        "project_name" => $project_name,
                        "hours" => $hours,
                        /*"ex_level" =>$cal,*/
                        "amount" => $amount,
                    );
                }
            }
            $json_data = array(
                "data"            => $data_arr  
                );

            echo json_encode($json_data);
        }
    }

    public function getReportTeam(Request $request){
        if ($request->ajax()) {
            $query = UserTimesheet::select('user_timesheets.project_id','timesheets.user_id','users.name','projects.name as project_name')
            ->leftjoin('timesheets','timesheets.id','user_timesheets.timesheet_id')
            ->leftjoin('users','users.id','timesheets.user_id')
            ->leftjoin('projects','projects.id','user_timesheets.project_id')
            ->groupBy('timesheets.user_id')
            ->groupBy('user_timesheets.project_id')
            ->get();

            $projects = Project::whereNull('deleted_at')->pluck('id')->toArray();

            $unique_project_users = UserTimesheet::select('user_timesheets.project_id','timesheets.user_id')
            ->leftjoin('timesheets','timesheets.id','user_timesheets.timesheet_id')
            ->whereIn('user_timesheets.project_id',$projects)
            ->distinct()->get()->toArray();

            $hr = array();
            foreach($unique_project_users as $k => $u){
                $timesheet = Timesheet::where('user_id',$u['user_id'])->pluck('id')->toArray();
                $user_timesheet[$k][$u['user_id']] = UserTimesheet::whereIn('timesheet_id',$timesheet)->where('project_id',$u['project_id'])->pluck('task_hours')->toArray();
            }
            $hours = $user_timesheet;

            $total_project_hours = array();
            foreach($hours as $k => $h){
                foreach($hours[$k] as $key => $v){
                    $sum_minutes = 0;
                    foreach($v as $d){
                        $explodedTime = array_map('intval', explode(':', $d));
                        $sum_minutes += $explodedTime[0]*60+$explodedTime[1];
                    }
                }
                $sumTime[][$key] = floor($sum_minutes/60).':'.floor($sum_minutes % 60);
            }
            $total_project_hours = $sumTime;

            foreach ($query as $k => $record) {
                $id = $record->p_id;

                foreach($total_project_hours as $k => $r){
                    foreach($r as $k => $r1){
                        if($record->user_id == $k){
                            $t = $r1;
                        }
                    }
                }

                $data_arr[] = array(
                    "id" => $id,
                    "employee_name" => $record->name,
                    "project_name" => $record->project_name,
                    "hours" => $t,
                );
            }
            $json_data = array(
                "data" => $data_arr  
            );
            echo json_encode($json_data);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
