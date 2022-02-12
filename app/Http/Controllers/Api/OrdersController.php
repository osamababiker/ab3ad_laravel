<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Channel;
use App\Models\Setting;
use Validator;

class OrdersController extends Controller
{
    
    /*
        order status
        0 => created 
        1 => assigned
        2 => is completed
        3 => is canceled
    */

    public function getOrders($userId){
        $orders = Order::where('isDeleted', 0)->where('userId',$userId)
            ->with('user')->with('category')->with('item')->get();
        return response()->json(['data' => $orders],200);
    }

    public function getAllOrders(){
        $orders = Order::where('isDeleted', 0)->where('status', 0)
            ->with('user')->with('category')->with('item')->get();
        return response()->json(['data' => $orders],200);
    }

    public function getSingleOrder($orderId){
        $order = Order::where('id',$orderId)->where('isDeleted',0)
            ->with('user')->with('category')->first();
        return response()->json(['data' => $order],200);
    }

    public function store(Request $request){
        $rules = [ 
            'userId'        => 'required',
            'cart'          => 'required',
            'lat'           => 'required',
            'lng'           => 'required',
            'status'        => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 200);
        }
        
        $order = new Order();
        $cartData = json_decode($request->cart);
        foreach($cartData as $cart){
            $order->userId = $request->userId;
            $order->categoryId = $cart->categoryId;
            $order->itemId = $cart->itemId;
            $order->quantity = $cart->quantity;
            $order->delivary_time = $cart->deliveryTime;
            $order->notes = $cart->deliveryNote;
            $order->customerLat = $request->lat;
            $order->customerLng = $request->lng;
            $order->status = $request->status;

            $order->save();
        }

        return response()->json([
            'success' => true
        ], 201);

    }

    public function deleteOrder($orderId){
        $order = Order::find($orderId);
        if(!$order){
            return response()->json(['message' => 'no order match this id'], 404);
        }
        $order->isDeleted = 1;
        $order->save();
        return response()->json(['message' => 'order has been deleted'],200);
    }


    public function updateOrder(Request $request){
        $order = Order::find($request->orderId);
        $order->status = $request->status;
        $order->save();
        return response()->json(['message' => 'order has been updated'],200);
    }
}
