<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Setting;
use Validator;

class SettingsController extends Controller
{ 
    public function getInfo(){
        $info = Setting::first();
        return response()->json([
            'data' => $info
        ], 200);
    } 
}
