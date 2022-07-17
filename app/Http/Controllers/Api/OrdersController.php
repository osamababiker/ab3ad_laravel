<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Channel;
use App\Models\Setting;
use Validator;
use DB;

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

    public function getAllOrders($lat,$lng){
        // $distance = 5;
        //  $orders = Order::select('*', DB::raw('( 6371 * acos( cos( radians(' . $lat . ') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(' . $lng . ') ) + sin( radians(' . $lat .') ) * sin( radians(lat) ) ) ) AS distance'))
        //  ->havingRaw('distance < ?', [$distance])
        //  ->with('user')
        //  ->with('item')
        //  ->with('category')
        //  ->get();
        $orders = Order::where('isDeleted', 0)->where('status', 0)
            ->with('user')->with('item')->with('category')->get();
        return response()->json(['data' => $orders],200);
    }

    public function getSingleOrder($orderId){
        $order = Order::where('id',$orderId)->where('isDeleted',0)
            ->with('user')->with('category')->with('item')->first();
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
        $cart = json_decode($request->cart);

        if($request->file != null && $request->file != ''){
            $uploadedFile = time().'_'. rand(1000, 9999).$_FILES['file']['name'];
            $file_size =$_FILES['file']['size'];
            $file_tmp =$_FILES['file']['tmp_name'];
            $file_type=$_FILES['file']['type'];
            move_uploaded_file($file_tmp,public_path('upload/orders/').$uploadedFile);
        }else $uploadedFile = '';

        $order->userId = $request->userId;
        $order->categoryId = $cart->categoryId;
        $order->itemId = $cart->itemId;
        $order->quantity = $cart->quantity;
        $order->delivary_time = $cart->deliveryTime;
        $order->notes = $cart->deliveryNote;
        $order->lat = $request->lat;
        $order->lng = $request->lng;
        $order->status = $request->status;
        $order->file = $uploadedFile;

        $order->save();

        try{
            $id = $order->id;
            $title = "طلب توصيل جديد على أبعاد";
            $body = "هناك طلب توصيل جديد على أبعاد , قم بالاطلاع عليه الان";

            $url = 'https://fcm.googleapis.com/fcm/send';
            $serverKey = "AAAAfhcIixE:APA91bFSEFWFkjoBVADZnG7e4aNc1ppDhuddETsJCfDo_8Z3GafQVI9Wza-fyAG_o4jIli49R9JRODPSMe1fYFfMCUaRHeBYdbPVzpgGn4gd_D-evIrm4AjQe0ZPoNTvVw9-YzwPCLWB";
            $dataArr = array('click_action' => 'FLUTTER_NOTIFICATION_CLICK', 'id' => $id,'status'=>"done");
            $notification = array('title' =>$title, 'body' => $body, 'sound' => 'default');
            $arrayToSend = array('to' => "/topics/driversTopic", 'notification' => $notification, 'data' => $dataArr, 'priority'=>'high');
            $fields = json_encode ($arrayToSend);
            $headers = array (
                'Authorization: key=' . $serverKey,
                'Content-Type: application/json'
            );

            $ch = curl_init ();
            curl_setopt ( $ch, CURLOPT_URL, $url );
            curl_setopt ( $ch, CURLOPT_POST, true );
            curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
            curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

            $result = curl_exec ( $ch );

            curl_close ( $ch );

        }catch (\Throwable $th) {
            print($th);
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
        $rules = [
            'customerId'          => 'required',
            'orderId'           => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $order = Order::find($request->orderId);
        $order->status = 2;
        $order->customer_complete_sign = 1;
        $order->save();

        return response()->json([
            'success' => true
        ], 200);
    }
}
