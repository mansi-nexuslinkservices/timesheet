<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RateCard;
use App\Models\ProjectType;

class RateCardController extends Controller
{
    public $module_name = '';
    public $inner_page_module_name = '';
    public $create_link = '';
    public $list_link = '';
    public $update_link = '';

    public function __construct(){
        $this->module_name = trans('admin/rates.module_name');
        $this->inner_page_module_name = trans('admin/rates.inner_page_module_name');
        $this->create_link = route('admin.rates.create');
        $this->update_link = route('admin.rates.update', 'id');
        $this->list_link = route('admin.rates.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_page = trans('admin/common.list');
        $module_name = $this->module_name;
        return view('backend.ratecard.index',compact('module_name','list_page'));
    }

    public function getRates(Request $request){
        if ($request->ajax()) {
            $records = RateCard::with('project_type')->whereNull('deleted_at')->orderby('id','desc')->get();
            $data_arr = array();
            foreach ($records as $record) {
                $id = $record->id;
                $project_type_id = $record->project_type->name ?? '';
                $junior = $record->junior ?? '';
                $medior = $record->medior ?? '';
                $senior = $record->senior ?? '';
                $created_at = $record->created_at;
                $created_at = date("m/d/Y H:i A", strtotime($record->created_at));

                // end
                $data_arr[] = array(
                    "id" => $id,
                    'project_type_id' => $project_type_id,
                    'junior' => $junior,
                    'medior' => $medior,
                    'senior' => $senior,
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
        $projectTypes = ProjectType::whereNull('deleted_at')->where('status',1)->orderby('id','desc')->get();
        return view('backend.ratecard.create',compact('projectTypes','inner_page_module_name','list_page'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_type_id' => 'required',
        ]);

        $data = array(
            'project_type_id' => $request['project_type_id'],
            'junior' => $request['junior'],
            'medior' => $request['medior'],
            'senior' => $request['senior'],
        ); 

        $rateCard = RateCard::create($data);
        return redirect()->route('admin.rates.index')->with('success', 'Rate created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $list_page = trans('admin/common.view');
        $inner_page_module_name = $this->inner_page_module_name;
        $rateCard = RateCard::with('project_type')->find($id);
        return view('backend.ratecard.view', compact('rateCard','list_page','inner_page_module_name'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $list_page = trans('admin/common.edit');
        $inner_page_module_name = $this->inner_page_module_name;
        $projectTypes = ProjectType::whereNull('deleted_at')->where('status',1)->orderby('id','desc')->get();
        $rateCard = RateCard::find($id);
        return view('backend.ratecard.create', compact('projectTypes','rateCard','list_page','inner_page_module_name'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'project_type_id' => 'required',
        ]);

        $data = array(
            'project_type_id' => $request['project_type_id'],
            'junior' => $request['junior'],
            'medior' => $request['medior'],
            'senior' => $request['senior'],
        ); 

        $rateCard = RateCard::find($id);
        $rateCard->update($data);

        return redirect()->route('admin.rates.index')->with('success', 'Rate updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rateCard = RateCard::find($id)->delete();
        if ($rateCard == true) {
            return response()->json([
                'success' => true,
                'message' => 'Rate card deleted successfully!',
            ]);
        }
        return redirect()->route('admin.rates.index')->with('success', 'Rate deleted successfully!');
    }
}
