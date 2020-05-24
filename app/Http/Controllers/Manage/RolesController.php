<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Database\Eloquent\ModelNotFoundException;
class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles  = DB::table('roles')->orderBy('created_at', 'desc')->get();
        return view('manage.roles.index')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.roles.create');
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
                    "name" => "required|min:3|max:30|unique:roles,name"
                ]);
                if ($validator->passes()) {
                    $role = Role::create(['name' => $request->name]);
                    return response()->json(['success' => '<b>'.$request->name.'</b> role has been created! Redirecting you back to the roles page...']);
                }
                return response()->json($validator->errors());
           
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $role = Role::findOrFail($id);
            $permissionsAll = Permission::all();
            return view('manage.roles.edit')->with('role',$role)->with('permissionsAll',$permissionsAll);
        }
        catch(ModelNotFoundException $err){
            return redirect('/manage/roles')->with('error','Role does not exist');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findByID($id);
        $role->delete();
        return response()->json(['success' => 'The role has successfully been deleted']);
    }
}
