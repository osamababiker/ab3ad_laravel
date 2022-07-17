<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeliveryRequest;
use App\Models\Order;
use Validator;

class DeliveryRequestsController extends Controller
{

    public function getDeliveryRequests($userId){
        $requests = DeliveryRequest::where('isDeleted', 0)->where('driverId',$userId)
            ->with('customer')->with('driver')->with('order')->get();
        return response()->json(['data' => $requests],200);
    }

    public function getAcceptedDeliveryRequests($orderId){
        $request = DeliveryRequest::where('isDeleted', 0)->where('orderId',$orderId)
            ->where('isAccepted',1)
            ->with('customer')->with('driver')->with('order')->first();
        return response()->json(['data' => $request],200);
    }

    public function orderCompelete(Request $request){
        $rules = [
            'driverId'          => 'required',
            'orderId'           => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $order = Order::find($request->orderId);
        $order->status = 2;
        $order->driver_complete_sign = 1;
        $order->save();

        return response()->json([
            'success' => true
        ], 200);
    }

    public function store(Request $request){
        $rules = [
            'customerId'        => 'required',
            'driverId'          => 'required',
            'orderId'           => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $checkRequests = DeliveryRequest::where('driverId',$request->driverId)
            ->where('customerId',$request->customerId)
            ->where('orderId', $request->orderId)->count();
        if($checkRequests > 0){
            return response()->json([
                'success' => true
            ], 201);
        }
        
        $deliveryRequest = new DeliveryRequest();
        $deliveryRequest->customerId = $request->customerId;
        $deliveryRequest->driverId = $request->driverId;
        $deliveryRequest->orderId = $request->orderId;
        $deliveryRequest->save();

        return response()->json([
            'success' => true
        ], 201);
    }
}
