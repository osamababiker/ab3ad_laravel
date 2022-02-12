<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Driver;

class HomeController extends Controller
{
    public function index(){
        $orders_count = Order::count();
        $users_count = User::count();
        $drivers_count = Driver::count();
        return view('dashboard/index',compact(['orders_count','users_count','drivers_count']));
    }
}