<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;

class LanguageController extends Controller
{
    public $module_name = '';
    public $inner_page_module_name = '';
    public $create_link = '';
    public $list_link = '';
    public $update_link = '';


    public function __construct(){
        $this->module_name = trans('admin/language.module_name');
        $this->inner_page_module_name = trans('admin/language.inner_page_module_name');
        $this->create_link = route('admin.language.create');
        $this->update_link = route('admin.language.update', 'id');
        $this->list_link = route('admin.language.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_page = trans('admin/common.list');
        $module_name = $this->module_name;
        return view('backend.languages.index',compact('list_page','module_name'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_page = trans('admin/common.add');
        $inner_page_module_name = $this->inner_page_module_name;
        return view('backend.languages.create',compact('list_page','inner_page_module_name'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
            'name' => 'required|unique:languages,name,NULL,id,deleted_at,NULL',
        ]);

        $data = array(
            'name' => $request['name'],
            'status' => $request['status'],
        ); 

        $language = Language::create($data);
        return redirect()->route('admin.languages.index')->with('success', 'Language created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $list_page = trans('admin/common.view');
        $inner_page_module_name = $this->inner_page_module_name;
        $language = Language::find($id);
        return view('backend.timesheets.view', compact('language','list_page','inner_page_module_name'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $list_page = trans('admin/common.edit');
        $inner_page_module_name = $this->inner_page_module_name;
        $language = Language::find($id);
        return view('backend.timesheets.create', compact('language','list_page','inner_page_module_name'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:languages,name,' . $id . ',id,deleted_at,NULL',
        ]);

        $data = array(
            'name' => $request['name'],
            'status' => $request['status'],
        );

        $language = Language::find($id);
        $language->update($data);

        return redirect()->route('admin.languages.index')->with('success', 'Language updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $language = Langugae::find($id)->delete();
        if ($language == true) {
            return response()->json([
                'success' => true,
                'message' => 'Language deleted successfully!',
            ]);
        }
        return redirect()->route('admin.languages.index')->with('success', 'Language deleted successfully!');
    }
}
