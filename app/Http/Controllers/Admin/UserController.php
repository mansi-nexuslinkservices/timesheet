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
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $module_name = $this->module_name;
        $admin_user = User::where('super_admin',1)->first();
        return view('backend.user.index',compact('admin_user','module_name'));
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
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => 'required'
        ]);

        $data = array(
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'super_admin' => 1
        ); 

        $user = User::create($data);
        return redirect()->route('admin.users.index')->with('success', 'User created successfully!');
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

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id.',id,deleted_at,NULL',
            'password' => 'required'
        ]);

        $data = array(
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'super_admin' => 1
        );    

        $user = User::find($id);
        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
