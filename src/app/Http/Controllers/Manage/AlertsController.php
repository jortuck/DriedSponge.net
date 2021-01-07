<?php

namespace App\Http\Controllers\Manage;

use App\Alerts;
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
                $alerts = Alerts::select('id','message','tweetid','created_at')->orderBy('created_at','desc')->paginate(10);
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
                $alert = new Alerts();
                $alert->message = $request->message;
                if($request->twitter){
                    $messagearray = str_split ($request->message,271);
                    $count = count($messagearray);
                    if($count == 1){
                        $form = $messagearray[0];
                    }else{
                        $form = $messagearray[0]."... (1/$count)";
                    }
                    $tweet = \Twitter::postTweet(['status' => $form, 'format' => 'object']);
                    $tweetlink =  \Twitter::linkTweet($tweet);
                    $id=$tweet->id_str;
                    $alert->tweetid = $id;
                    $i = 0;
                    foreach ($messagearray as $chunk){
                        $i++;
                        $end = "... ($i/$count)";
                        if($i ==1){
                            continue;
                        }elseif ($i==$count){
                            $end = " ($i/$count)";
                        }
                        $tweet2 = \Twitter::postTweet(['status' =>  $chunk.$end, 'format' => 'json','in_reply_to_status_id'=>$id]);
                    }
                }
                if($request->discord){
                    $fields = array();
                    if($request->twitter){
                        array_push($fields, array("name" => "Tweet Link", "value" => $tweetlink));
                    }
                    $embed = array(
                        "title" =>  "New Message",
                        "type" => "rich",
                        "color" => hexdec("007BFF"),
                        "timestamp" => date("c"),
                        "fields" => $fields,
                        "description"=>$request->message
                    );
                    $response = \Http::post(config('extra.discord_alerts_hook'),["embeds" => [$embed]]);
                }
                $alert->save();
                return response()->json(['success' => 'Message has been posted! '.$alert->tweetid]);
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
    public function destroy(Request $request,$id)
    {
        if(\Auth::guest()){
            return response()->json(['error' => 'Unauthenticated'])->setStatusCode(401);
        }
        if (\Auth::user()->hasPermissionTo('Alerts.Delete')) {
            $alert = Alerts::find($id);
            if($alert){
                $alert->deleteFull();
                $rest = Alerts::select('id','message','tweetid','created_at')->orderBy('created_at','desc')->paginate(10);
                return response()->json(['success' => true,"data"=>$rest]);
            }else{
                return response()->json(['error' => 'Not found'])->setStatusCode(404);
            }
        }else{
            return response()->json(['error' => 'Unauthorized'])->setStatusCode(403);
        }
    }
}
