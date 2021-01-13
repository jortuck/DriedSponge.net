<?php

namespace App\Http\Controllers\Manage;

use App\Jobs\SendAlert;
use App\Models\Alerts;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class AlertsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if(!\Auth::guest()){
            if(\Auth::user()->hasPermissionTo('Alerts.See')){
                $alerts = Alerts::select('id','message','tweetid','created_at','onsite')->orderBy('created_at','desc')->paginate(10);
                return response()->json($alerts);
            }else{
                return response()->json(['error' => 'Unauthorized'])->setStatusCode(403);
            }
        }
        return response()->json(['error' => 'Unauthenticated'])->setStatusCode(401);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if (\Auth::user()->hasPermissionTo('Alerts.Create')) {
            $validator = Validator::make($request->all(), [
                "message" => "required|min:3|max:1120",
                "discord" => "required|boolean",
                "twitter" => "required|boolean",
                "website" => "required|boolean"
            ]);
            if ($validator->passes()) {

                SendAlert::dispatch($request->message, $request->twitter, $request->discord, $request->website);
                return response()->json(['success' => 'Message has been posted!']);
            }
            return response()->json($validator->errors());
        } else {
            return response()->json(['error' => 'Unauthorized']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function show($id)
    {
        if(\Auth::guest()){
            return response()->json(['error' => 'Unauthenticated'])->setStatusCode(401);
        }
        if (\Auth::user()->hasPermissionTo('Alerts.Edit')) {
            $alert = Alerts::find($id);
            if($alert){
                return response()->json($alert);
            }else{
                return response()->json(['error' => 'Not found'])->setStatusCode(404);
            }
        }else{
            return response()->json(['error' => 'Unauthorized'])->setStatusCode(403);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function update(Request $request, $id)
    {
        if(\Auth::guest()){
            return response()->json(['error' => 'Unauthenticated'])->setStatusCode(401);
        }
        if (\Auth::user()->hasPermissionTo('Alerts.Edit')) {
            $alert = Alerts::find($id);
            if($alert){
                $validator = Validator::make($request->all(), [
                    "message" => "required|min:3|max:1120",
                    "website" => "required|boolean"
                ]);
                if($validator->passes()){
                    $alert->onsite = $request->website;
                    $alert->message = $request->message;
                    $alert->save();
                    return response()->json(['success' => 'Message has been updated!']);
                }
                return response()->json($validator->errors());
            }else{
                return response()->json(['error' => 'Not found'])->setStatusCode(404);
            }
        }else{
            return response()->json(['error' => 'Unauthorized'])->setStatusCode(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|object
     */
    public function destroy(Request $request,$id)
    {
        if(\Auth::guest()){
            return response()->json(['error' => 'Unauthenticated'])->setStatusCode(401);
        }
        if (\Auth::user()->hasPermissionTo('Alerts.Delete')) {
            $alert = Alerts::find($id);
            if($alert){
                $alert->deleteFull();
                $rest = Alerts::select('id','message','tweetid','created_at','onsite')->orderBy('created_at','desc')->paginate(10);
                return response()->json(['success' => true,"data"=>$rest]);
            }else{
                return response()->json(['error' => 'Not found'])->setStatusCode(404);
            }
        }else{
            return response()->json(['error' => 'Unauthorized'])->setStatusCode(403);
        }
    }
}
