<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\DeliveryRequest;

class DeliveryRequestsController extends Controller
{
    public function getTable(){
        $requests = DeliveryRequest::where('isDeleted', 0)->get();
        return view('dashboard/deliveryRequests/table', compact(['requests']));
    }

    public function postTable(Request $request){
        if($request->has('approve_btn')){

            // to reject other requests
            $deliveryRequests = DeliveryRequest::where('orderId',$request->orderId)->get();
            foreach($deliveryRequests as $d_request){
                $d_request->isAccepted = 0;
                $d_request->save();
            }

            $deliveryRequest = DeliveryRequest::find($request->requestId);
            $deliveryRequest->isAccepted = 1;
            $deliveryRequest->save();

            $order = Order::find($deliveryRequest->orderId);
            $order->status = 1;
            $order->save();


            session()->flash('feedback', 'تم قبول الطلب بنجاح');
            return redirect()->back();
        }

        if($request->has('delete_btn')){
            $deliveryRequest = DeliveryRequest::find($request->requestId);
            $deliveryRequest->isDeleted = 1;
            $deliveryRequest->save();
            session()->flash('feedback', 'تم قبول الطلب بنجاح');
            return redirect()->back();
        }
    }
}
