<?php

namespace App\Http\Controllers\Manage;

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
        //return \Twitter::postTweet(['status' => 'Ooh the tweet says its from driedsponge.net :) twitter api pretty cool', 'format' => 'json']);
        $alerts = DB::table('alerts')->orderBy('created_at', 'asc')->get();
        return view('manage.alerts.index')->with('alerts', $alerts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        if (\Auth::user()->hasPermissionTo('Alerts.Create')) {
            return view('manage.alerts.create');
        } else {
            return redirect()->back()->with('error', 'Unauthorized');
        }
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
                "discord" => "required",
                "twitter" => "required",
                "website" => "required"
            ]);
            if ($validator->passes()) {
                //$role = Alert::create(['name' => $request->role_name]);
                if($request->twitter){
                    $messagearray = str_split ($request->message,271);
                    $count = count($messagearray);
                    if($count == 1){
                        $form = $messagearray[0];
                    }else{
                        $form = $messagearray[0]."... (1/$count)";
                    }
                    $tweet = \Twitter::postTweet(['status' => $form, 'format' => 'json']);
                    $id=json_decode($tweet,true)['id_str'];
                    $i = 0;
                    foreach ($messagearray as $chunk){
                        $i++;
                        if($i==1){
                            continue;
                        }
                        $tweet2 = \Twitter::postTweet(['status' =>  $chunk."... ($i/$count)", 'format' => 'json','in_reply_to_status_id'=>$id]);
                    }
                }
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
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}
