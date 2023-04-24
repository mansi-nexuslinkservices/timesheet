<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Backend\User;
use DB;
use Auth;

class RoleController extends Controller
{

    public $module_name = '';
    public $inner_page_module_name = '';
    public $create_link = '';
    public $list_link = '';
    public $update_link = '';

    function __construct()
    {
        $this->module_name = trans('admin/roles.module_name');
        $this->inner_page_module_name = trans('admin/roles.inner_page_module_name');
        $this->create_link = route('admin.roles.create');
        $this->update_link = route('admin.roles.update', 'id');
        $this->list_link = route('admin.roles.index');

        $this->middleware('permission:role', ['only' => ['index','getRole','create','store','edit','update','destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_page = trans('admin/common.list');
        $module_name = $this->module_name;
        return view('backend.roles.index',compact('list_page','module_name')); 
    }

    public function getRole(Request $request , Role $role){
        if ($request->ajax()) {
            $records = Role::orderBy('id','DESC')->get();
            $data_arr = array();
            foreach($records as $record){
                $id = $record->id;
                $name = $record->name;
                $created_at = $record->created_at;
                //if( $name == 'admin' ){ continue; }
                $created_date = date("m/d/Y H:i A", strtotime($record->created_at));
                
                $data_arr[] = array(
                   "id" => $id,
                   "name" => $name,
                   "created_at" => $created_date,
                );
            }
            $response = array(
                "aaData" => $data_arr
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
        $db_permission = Permission::get();
        return view('backend.roles.create',compact('db_permission','list_page','inner_page_module_name'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
    
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
    
        return redirect()->route('admin.roles.index')->with('success','Role created successfully!');
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
        $list_page = trans('admin/common.edit');
        $inner_page_module_name = $this->inner_page_module_name;
        $role = Role::find($id);
        $name = $role->name;
        /*if( $name == 'admin' ){ abort(401); }*/
        $db_permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('backend.roles.create',compact('role','db_permission','rolePermissions','list_page','inner_page_module_name'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
    
        $role = Role::find($id);
        $name = $role->name;
        /*if( $name == 'admin' ){ abort(401); }*/
        $role->name = $request->input('name');
        $role->save();
    
        $role->syncPermissions($request->input('permission'));
    
        return redirect()->route('admin.roles.index')->with('success','Role updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::where('id',$id)->where('name', '!=' , 'admin');
        $isDeleted = $role->delete();
        if( $isDeleted ){
            return response()->json([
                'success' => true,
                'message' => 'Role deleted successfully!',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Role failed to deleted!',
            ]);
        }
        return redirect()->route('admin.roles.index')->with('success','Role deleted successfully!');
    }
}
