<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use APp\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public $module_name = '';
    public $inner_page_module_name = '';
    public $create_link = '';
    public $list_link = '';
    public $update_link = '';

    public function __construct(){
        $this->module_name = trans('admin/user.module_name');
        $this->inner_page_module_name = trans('admin/user.inner_page_module_name');
        $this->create_link = route('admin.users.create');
        $this->update_link = route('admin.users.update', 'id');
        $this->list_link = route('admin.users.index');
        $this->middleware('permission:admin-users', ['only' => ['index','getUser','create','store','show','edit','update','destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_page = trans('admin/common.list');
        $module_name = $this->module_name;
        return view('backend.user.index',compact('module_name','list_page'));
    }

     public function getUser(Request $request){
        if ($request->ajax()) {
            $records = User::role('admin-user')->get();
            $data_arr = array();
            foreach ($records as $record) {
                $id = $record->id;
                $name = $record->name;
                $email = $record->email;
                $created_at = $record->created_at;

                $created_at = date("m/d/Y H:i A", strtotime($record->created_at));

                // end
                $data_arr[] = array(
                    "id" => $id,
                    "name" => $name,
                    "email" => $email,
                    "created_at" => $created_at,
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
        return view('backend.user.create',compact('inner_page_module_name','list_page'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => 'required'
        ]);

        $data = array(
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ); 

        $admin_user = User::create($data);
        $admin_user->assignRole('admin-user');

        return redirect()->route('admin.users.index')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $list_page = trans('admin/common.view');
        $inner_page_module_name = $this->inner_page_module_name;
        $admin_user = User::find($id);
        return view('backend.user.view', compact('admin_user','list_page','inner_page_module_name'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $list_page = trans('admin/common.edit');
        $inner_page_module_name = $this->inner_page_module_name;
        $admin_user = User::find($id);
        return view('backend.user.create', compact('admin_user','list_page','inner_page_module_name'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id.',id,deleted_at,NULL',
        ]);

        $data = array(
            'name' => $request['name'],
            'email' => $request['email'],
        );    

        if(isset($request->password) && !empty($request->password)){
            $data['password'] = Hash::make($request->password);
        }

        $admin_user = User::find($id);
        $admin_user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id)->delete();
        if ($user == true) {
            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully!',
            ]);
        }
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }
}
