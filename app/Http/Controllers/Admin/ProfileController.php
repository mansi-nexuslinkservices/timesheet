<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Image;
use Str;
use Helper;
use Session;

class ProfileController extends Controller
{
    public $module_name = '';
    public $create_link = '';
    public $list_link = '';
    public $update_link = '';
    
    public function __construct(){
        $this->module_name = trans('admin/profile.module_name');
        $this->create_link = route('admin.profile.create');
        $this->update_link = route('admin.profile.update', 'id');
        $this->list_link = route('admin.profile.index');
    }
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $module_name = $this->module_name;
        $userId = Auth::user()->id;
        $user = User::find($userId);
        Session::put('loginUser', $user);
        return view('backend.profile.index',compact('user','module_name'));
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
        $date = \Carbon\Carbon::parse($request->birth_date)->format('Y-m-d');
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|unique:users,email,'.$id.',id',
            'specialty' => 'required',
            'skills' => 'required',
            'gender' => 'required',
            'birth_date' => 'required',
            'phone' => 'required',
        ]);

        $data = array(
            'name' => $request['name'],
            'surname' => $request['surname'],
            'email' => $request['email'],
            'specialty' => $request['specialty'],
            'skills' => $request['skills'],
            'gender' => $request['gender'],
            'birth_date' => $date,
            'phone' => $request['phone'],

        );        

        /*if(isset($request->birth_date) && !empty($request->birth_date)){
            $data['birth_date'] = $date;
        }*/

        if($request->hasFile('profile')){
            if (isset($request['profile']) && $request['profile'] != null) {
                $file = $request->file('profile');
                $path = 'storage'.DIRECTORY_SEPARATOR.'user-profile';

                $fileOriginal = $file->getClientOriginalName();
                $fName = Str::slug(pathinfo($fileOriginal, PATHINFO_FILENAME));
                $extension = pathinfo($fileOriginal, PATHINFO_EXTENSION);

                $filename = date('YmdHi-').$fName.'.'.$extension;
                $file_path = $request->file('profile')->getRealPath();
                $thumbImagePath = public_path($path.DIRECTORY_SEPARATOR.'thumb-images');
                $result = Helper::ThumbnailImage($filename, $file_path, $thumbImagePath);

                // For Image Save in database
                $filename = Helper::InsertImage($file,$path);
                $data['profile'] = $filename;
            }
        }

        $user = User::find($id);
        $user->update($data);

        return redirect()->route('admin.profile.index')->with('success', 'Your profile updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
