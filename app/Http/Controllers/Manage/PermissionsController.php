<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use Validator;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perms  = DB::table('permissions')->orderBy('created_at', 'desc')->get();
        return view('manage.permissions.index')->with('perms', $perms);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            "name" => "required|min:3|max:30|unique:permissions,name"
        ]);
        if ($validator->passes()) {
            $permission = Permission::create(['name' => $request->name]);
            return response()->json(['success' => 'The <b>'.$request->name.'</b> permission has been created! Redirecting you back to the permissions page...']);
        }
        return response()->json($validator->errors());
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
