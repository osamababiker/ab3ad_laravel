<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Validator;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function getTable(){
        $info = Setting::first();
        return view('dashboard/settings/table',compact(['info']));
    }

    public function postTable(Request $request){
        $this->validate($request,[
            'appName' => 'required|string',
            'appVersion' => 'required|string',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required|string',
            'policy' => 'required|string',
            'price_for_k' => 'required',
        ]);
        $info = Setting::find($request->settingsId);
        $info->appName = $request->appName;
        $info->appVersion = $request->appVersion;
        $info->phone = $request->phone;
        $info->email = $request->email;
        $info->address = $request->address;
        $info->policy = $request->policy;
        $info->price_for_k = $request->price_for_k;
        $info->save();
        session()->flash('settingsUpdated','تم تحديث البيانات بنجاح');
        return redirect()->back();
    }
}
