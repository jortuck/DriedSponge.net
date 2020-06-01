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
        $perms  = DB::table('permissions')->orderBy('name', 'asc')->get();
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
            "perm_name" => "required|max:30|unique:permissions,name"
        ]);
        if ($validator->passes()) {
            $permission = Permission::create(['name' => $request->perm_name]);
            return response()->json(['success' => 'The <b>'.$request->perm_name.'</b> permission has been created!']);
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
        $perm = Permission::findByID($id);
        $perm->delete();
        return response()->json(['success' => 'The permission has successfully been deleted']);
    }
}
