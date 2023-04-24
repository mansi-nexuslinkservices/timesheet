<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public $module_name = '';
    public $inner_page_module_name = '';
    public $create_link = '';
    public $list_link = '';
    public $update_link = '';

    public function __construct(){
        $this->module_name = trans('admin/client.module_name');
        $this->inner_page_module_name = trans('admin/client.inner_page_module_name');
        $this->create_link = route('admin.clients.create');
        $this->update_link = route('admin.clients.update', 'id');
        $this->list_link = route('admin.clients.index');
        $this->middleware('permission:clients', ['only' => ['index','getClient','create','store','show','edit','update','destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_page = trans('admin/common.list');
        $module_name = $this->module_name;
        return view('backend.client.index',compact('list_page','module_name'));
    }

    public function getClient(Request $request){
        if ($request->ajax()) {
            $records = Client::whereNull('deleted_at')->orderby('id','desc')->get();
            $data_arr = array();
            foreach ($records as $record) {
                $id = $record->id;
                $name = $record->name;
                $email = $record->email;
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
                    "email" => $email,
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
        return view('backend.client.create',compact('list_page','inner_page_module_name'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:clients,email,NULL,id,deleted_at,NULL',
        ]);

        $data = array(
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'country' => $request['country'],
            'state' => $request['state'],
            'status' => $request['status'],
        ); 

        $client = Client::create($data);
        return redirect()->route('admin.clients.index')->with('success', 'Client created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $list_page = trans('admin/common.view');
        $inner_page_module_name = $this->inner_page_module_name;
        $client = Client::find($id);
        return view('backend.client.view', compact('client','list_page','inner_page_module_name'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $list_page = trans('admin/common.edit');
        $inner_page_module_name = $this->inner_page_module_name;
        $client = Client::find($id);
        return view('backend.client.create', compact('client','list_page','inner_page_module_name'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:clients,email,'.$id.',id,deleted_at,NULL',
        ]);

        $data = array(
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'country' => $request['country'],
            'state' => $request['state'],
            'status' => $request['status'],
        );

        $client = Client::find($id);
        $client->update($data);

        return redirect()->route('admin.clients.index')->with('success', 'Client updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::find($id)->delete();
        if ($client == true) {
            return response()->json([
                'success' => true,
                'message' => 'Client deleted successfully!',
            ]);
        }
        return redirect()->route('admin.clients.index')->with('success', 'Client deleted successfully!');
    }
}
