<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Plaint;
use Validator;


class PlaintController extends Controller
{
    public function getTable(){
        $plaints = Plaint::get();
        return view('dashboard/plaints/table',compact(['plaints']));
    }

    public function postTable(Request $request){
        if($request->has('editBtn')){
            $rules = [
                'plaintId' => "required",
            ];
            $validator = Validator::make($request->all(),$rules);
            if($validator->fails()){
                return response()->json(['errors' => $validator->errors()], 200);
            }
            $plaint = Plaint::find($request->plaintId);
            $plaint->isClosed = $request->isClosed;
            $plaint->save();
            session()->flash('plaintClosed','تم اغلاق البلاغ بنجاح');
            return redirect()->back();

        } else if($request->has('deleteBtn')){
            Plaint::where('id',$request->plaintId)->delete();
            session()->flash('plaintDeleted','تم حذف البلاغ بنجاح');
            return redirect()->back();
        }
    }
}
