<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Media extends Controller
{
    public function upload(Request $request){
        $file = $request->file('image');
        $extention = $file->extension();
        return $extention;
    }
}
