<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectType;

class ProjectTypeController extends Controller
{
    public $module_name = '';
    public $inner_page_module_name = '';
    public $create_link = '';
    public $list_link = '';
    public $update_link = '';

    public function __construct(){
        $this->module_name = trans('admin/project-type.module_name');
        $this->inner_page_module_name = trans('admin/project-type.inner_page_module_name');
        $this->create_link = route('admin.project-type.create');
        $this->update_link = route('admin.project-type.update', 'id');
        $this->list_link = route('admin.project-type.index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_page = trans('admin/common.list');
        $module_name = $this->module_name;
        return view('backend.project-type.index',compact('list_page','module_name'));
    }

    public function getProjectType(Request $request){
        if ($request->ajax()) {
            $records = ProjectType::whereNull('deleted_at')->orderby('id','desc')->get();
            $data_arr = array();
            foreach ($records as $record) {
                $id = $record->id;
                $name = $record->name;
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
        return view('backend.project-type.create',compact('list_page','inner_page_module_name'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:project_types,name,NULL,id,deleted_at,NULL',
        ]);

        $data = array(
            'name' => $request['name'],
            'status' => $request['status'],
        ); 

        $projectType = ProjectType::create($data);
        return redirect()->route('admin.project-type.index')->with('success', 'Project Type created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $list_page = trans('admin/common.view');
        $inner_page_module_name = $this->inner_page_module_name;
        $projectType = ProjectType::find($id);
        return view('backend.project-type.view', compact('projectType','list_page','inner_page_module_name'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $list_page = trans('admin/common.edit');
        $inner_page_module_name = $this->inner_page_module_name;
        $projectType = ProjectType::find($id);
        return view('backend.project-type.create', compact('projectType','list_page','inner_page_module_name'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:project_types,name,' . $id . ',id,deleted_at,NULL',
        ]);

        $data = array(
            'name' => $request['name'],
            'status' => $request['status'],
        );

        $projectType = ProjectType::find($id);
        $projectType->update($data);

        return redirect()->route('admin.project-type.index')->with('success', 'Project Type updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $projectType = ProjectType::find($id)->delete();
        if ($projectType == true) {
            return response()->json([
                'success' => true,
                'message' => 'ProjectType deleted successfully!',
            ]);
        }
        return redirect()->route('admin.project-type.index')->with('success', 'Project Type deleted successfully!');
    }
}
