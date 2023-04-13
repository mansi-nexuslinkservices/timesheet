<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectType;
use App\Models\User;
use App\Models\ProjectUser;

class ProjectsController extends Controller
{
    public $module_name = '';
    public $inner_page_module_name = '';
    public $create_link = '';
    public $list_link = '';
    public $update_link = '';

    public function __construct(){
        $this->module_name = trans('admin/project.module_name');
        $this->inner_page_module_name = trans('admin/project.inner_page_module_name');
        $this->create_link = route('admin.projects.create');
        $this->update_link = route('admin.projects.update', 'id');
        $this->list_link = route('admin.projects.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_page = trans('admin/common.list');
        $module_name = $this->module_name;
        return view('backend.project.index',compact('list_page','module_name'));
    }

    public function getProject(Request $request){
        if ($request->ajax()) {
            $records = Project::whereNull('deleted_at')->orderby('id','desc')->get();
            $data_arr = array();
            foreach ($records as $record) {
                $projectTypes = ProjectType::where('id',$record->project_type_id)->first();
                $id = $record->id;
                $name = $record->name;
                $project_type = $projectTypes->name;
                $created_at = $record->created_at;
                $status = $record->status;

                if ($record->status == 1) {
                    $status = "<span class='badge badge-success badge-lg light'>Active</span>";
                }
                if ($record->status == 0) {
                    $status = "<span class='badge badge-danger badge-lg light'>In Active</span>";
                }
                $created_at = date("m/d/Y H:i A", strtotime($record->created_at));

                // end
                $data_arr[] = array(
                    "id" => $id,
                    "name" => $name,
                    "project_type_id" => $project_type,
                    "created_at" => $created_at,
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
        $projectTypes = ProjectType::whereNull('deleted_at')->orderby('id','desc')->get();
        $employees = User::with('roles')->whereHas('roles', function($q) {
                $q->whereIn('name', ['project manager','team leader','employee']);
            })->get();
        /*$employees = User::with('roles')->whereNotIn('name',['admin'])->get();*/
        return view('backend.project.create',compact('employees','projectTypes','list_page','inner_page_module_name'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'project_type_id' => 'required',
        ]);

        $data = array(
            'name' => $request['name'],
            'description' => $request['description'],
            'project_type_id' => $request['project_type_id'],
            'status' => $request['status'],
        ); 

        $project = Project::create($data);
        $insertId = $project->id;

        if(!empty($request->user_id) && count($request->user_id) > 0){
            foreach($request->user_id as $userId){
                $data1 = array(
                    'project_id' => $insertId,
                    'user_id' => $userId,
                );
                $projectUser = ProjectUser::create($data1);
            }
        }
        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $list_page = trans('admin/common.view');
        $inner_page_module_name = $this->inner_page_module_name;
        $project = Project::find($id);
        $projectUsers = ProjectUser::where('project_id',$id)->pluck('user_id');
        $users = User::whereIn('id', $projectUsers)->get();
        foreach($users as $user){
            $u[] = $user['name'];
        }
        $multiple_users = implode(', ',$u);
        return view('backend.project.view', compact('multiple_users','project','list_page','inner_page_module_name'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $list_page = trans('admin/common.edit');
        $inner_page_module_name = $this->inner_page_module_name;
        $project = Project::find($id);
        $projectTypes = ProjectType::whereNull('deleted_at')->orderby('id','desc')->get();
        /*$employees = User::with('roles')->whereNotIn('name',['admin'])->get();*/
        $employees = User::with('roles')->whereHas('roles', function($q) {
                $q->whereIn('name', ['project manager','team leader','employee']);
            })->get();
        $projectUsers = ProjectUser::where('project_id',$id)->get();
        $multiple_users = [];
        foreach($projectUsers as $user){
            $multiple_users[] = $user['user_id'];
        }
        return view('backend.project.create',compact('multiple_users','employees','projectUsers','project','projectTypes','list_page','inner_page_module_name'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'project_type_id' => 'required',
        ]);

        $data = array(
            'name' => $request['name'],
            'description' => $request['description'],
            'project_type_id' => $request['project_type_id'],
            'status' => $request['status'],
        ); 

        $project = Project::find($id);
        $project->update($data);

        if(!empty($request->user_id) && count($request->user_id) > 0){
            ProjectUser::where('project_id',$id)->delete();
            foreach($request->user_id as $userId){
                $data1 = array(
                    'project_id' => $id,
                    'user_id' => $userId,
                );
                $projectUser = ProjectUser::create($data1);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::find($id)->delete();
        if ($project == true) {
            return response()->json([
                'success' => true,
                'message' => 'Project deleted successfully!',
            ]);
        }
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully!');
    }
}
