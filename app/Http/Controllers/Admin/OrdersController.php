<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Order;

class OrdersController extends Controller
{
    public function getTable(){
        $orders = Order::where('isDeleted',0)->get();
        return view('dashboard/orders/table',compact(['orders']));
    }
}
