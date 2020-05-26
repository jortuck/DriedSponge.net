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
            $permissionsAll = Permission::orderBy('name', 'asc')->get();
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
        if($request->perm){
            try{
                $role = Role::findOrFail($id);
                try{
                    $perm = Permission::findOrFail($request->pid);
                    if($role->hasPermissionTo($perm->name)){
                        $group = explode('.',$perm->name);
                        if($group[0]=="*" or isset($group[1]) && $group[1] == "*" ){
                            $fullperm = "*";
                        }else{
                            $fullperm=$group[0].".*";
                        }
                        if($fullperm !== $perm->name && $role->hasPermissionTo($fullperm)){
                            return response()->json(['error' => 'In order to revoke this perm, you must disable <b>'.$fullperm.'</b>']);
                        }
                        $role->revokePermissionTo($perm->name);
                        $txt = 'revoked from';
                        $status=false;
                    }else{
                        $role->givePermissionTo($perm->name);
                        $txt='added to';
                        $status=true;
                    }
                    return response()->json(['success' => 'The <b>'.$perm->name.'</b> permission has been '.$txt.' the '.$role->name.' role','status'=>$status]);
                }
                catch(ModelNotFoundException $err){
                    return response()->json(['error' => 'The permission you are trying to add to the role does not exist.']);
                }
            }
            catch(ModelNotFoundException $err){
                return response()->json(['error' => 'The role you are trying to edit does not exist.']);
            }
        }else{

            $validator =  Validator::make($request->all(), [
                "name" => "required|min:3|max:30|unique:roles,name"
            ]);
            if ($validator->passes()) {
                $role = Role::findByID($id);
                $role->name=$request->name;
                $role->save();
                return response()->json(['success' => 'The role has been updated!']);
            }
            return response()->json($validator->errors());

        }
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
