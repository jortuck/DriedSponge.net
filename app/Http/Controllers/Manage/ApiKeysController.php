<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\View\View;
use App\ApiKey as ApiKey;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Validator;

class ApiKeysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        if (\Auth::user()->hasPermissionTo('Api.Create')) {
            $apikeys = ApiKey::All();
            return view('manage.apikeys.index')->with('apikeys', $apikeys);
        }else{
            return redirect('/manage')->with('error', 'Unauthorized');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        if (\Auth::user()->hasPermissionTo('Api.Create')) {
            return view('manage.apikeys.create');
        } else {
            return redirect('/manage/api')->with('error', 'Unauthorized');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        if (\Auth::user()->hasPermissionTo('Api.Create')) {

            $validator = Validator::make($request->all(), [
                "key_name" => "required|min:3|max:50|unique:api_keys,name"
            ]);
            if ($validator->passes()) {
                $key = new ApiKey;
                $key->name = $request->key_name;
                $key->api_token = Str::uuid();
                $key->save();
                return response()->json(['success' => '<b>' . $request->key_name . '</b> key has been created!']);
            }
            return response()->json($validator->errors());
        } else {
            return response()->json(['error' => 'Unauthorized']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        if (\Auth::user()->hasPermissionTo('Api.Edit')) {
            try {
                $key = ApiKey::findOrFail($id);
                $permissionsAll = Permission::orderBy('name', 'asc')->where('guard_name', 'api')->get();
                return view('manage.apikeys.edit')->with('key', $key)->with('permissionsAll', $permissionsAll);
            } catch (ModelNotFoundException $err) {
                return redirect('/manage/api')->with('error', 'Key does not exist');
            }
        } else {
            return redirect('/manage/api')->with('error', 'Unauthorized');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        if (\Auth::user()->hasPermissionTo('Api.Edit')) {
            if ($request->perm) {
                try {
                    $key = ApiKey::findOrFail($id);
                    try {
                        $perm = Permission::findOrFail($request->pid);
                        if ($key->hasPermissionTo($perm->name)) {
                            $key->revokePermissionTo($perm->name);
                            $txt = 'revoked from';
                            $status = false;
                        } else {
                            $key->givePermissionTo($perm->name);
                            $txt = 'added to';
                            $status = true;
                        }
                        return response()->json(['success' => 'The ' . $perm->name . ' permission has been ' . $txt . ' the ' . $key->name . ' role', 'status' => $status]);
                    } catch (ModelNotFoundException $err) {
                        return response()->json(['error' => 'The permission you are trying to add to the api key does not exist.']);
                    }
                } catch (ModelNotFoundException $err) {
                    return response()->json(['error' => 'The api key you are trying to edit does not exist.']);
                }
            } else if ($request->regen) {
                $key = ApiKey::find($id);
                $key->api_token = Str::uuid();
                $key->save();
                return response()->json(['success' => 'The key has been regenerated!']);
            } else {
                $validator = Validator::make($request->all(), [
                    "key_name" => "required|min:3|max:50|unique:api_keys,name"
                ]);
                if ($validator->passes()) {
                    $key = ApiKey::find($id);
                    $key->RegenToken();
                    return response()->json(['success' => 'The key has been updated!']);
                }
                return response()->json($validator->errors());
            }
        } else {
            return response()->json(['error' => 'Unauthorized']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        if (\Auth::user()->hasPermissionTo('Api.Delete')) {
            $key = ApiKey::find($id);
            $key->delete();
            return response()->json(['success' => 'The key has successfully been revoked']);
        } else {
            return response()->json(['error' => 'Unauthorized']);
        }
    }
}
