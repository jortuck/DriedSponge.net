<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Github extends Controller
{
    function Webhook(){
        return response()->json("Test");
    }
}
