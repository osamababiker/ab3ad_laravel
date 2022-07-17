<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public $mapKey = "AIzaSyAf437n2BxD-hg2NdOYrxvSn7ohQRFYelI";

    public function getTable(){
        $users = User::get();
        $key = $this->mapKey;
        return view('dashboard/users/table',compact(['users','key']));
    }

    public function postTable(Request $request){
        $user = User::find($request->userId);
        $user->isDriver = $request->isDriver;
        $user->role = $request->role;
        $user->save();

        session()->flash('userUpdated','تم تحديث بيانات المستخدم بنجاح');
        return redirect()->back();
    }
}
