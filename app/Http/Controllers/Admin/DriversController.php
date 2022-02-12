<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Driver; 
use App\Models\Offer;
use App\Models\Order;
use App\Models\User;
use App\Models\DriverPayment;

class DriversController extends Controller
{
    public function getTable(){
        $drivers = Driver::orderBy('id','DESC')->get();
        return view('dashboard/drivers/table',compact(['drivers']));
    }

    public function postTable(Request $request){
        if($request->has('editDriverBtn')){
            $driver = Driver::find($request->driverId);
            $driver->isAccepted = $request->isAccepted;
            $driver->save();
            if($request->isAccepted == 1){
                $user = User::find($driver->user->id);
                $user->isDriver = 1;
                $user->save();
            }
            session()->flash('driverUpdated','تم تحديث حالة السائق بنجاح');
            return redirect()->back();
        }
        if($request->has('deleteDriverBtn')){
            $driver = Driver::find($request->driverId);
            if(file_exists(public_path('upload/drivers/transport/'.$driver->transportImage))){
                unlink(public_path('upload/drivers/transport/'.$driver->transportImage));
            }
            if(file_exists(public_path('upload/drivers/license/'.$driver->licenseImage))){
                unlink(public_path('upload/drivers/license/'.$driver->licenseImage));
            }
            $driver->delete();
            session()->flash('driverDeleted','تم حذف  السائق بنجاح');
            return redirect()->back();
        }
        if($request->has('addPaymentBtn')){
            DriverPayment::create([
                'driverId' => $request->driverId,
                'amount' => $request->amount
            ]);
            session()->flash('paymentCreated','تم حفظ قيمة المبلغ بنجاح');
            return redirect()->back();
        }
    }


    public function getDriverReport($driverId){
        // get all offers for orders that driver send and get accepted
        $offers = Offer::where('driverId',$driverId)
            ->where('status',1)->get();
        $orders_count = $offers->count();
        $completed_orders_counter = 0;
        $canceled_orders_counter = 0;
        $total_income = 0;
        $total_payments = 0;
        foreach($offers as $offer){
            // to get total income for driver +
            // to get completed / canceled orders count
            $check_if_order_completed = Order::find($offer->orderId)->status;
            if($check_if_order_completed == 2){
                $total_income += $offer->offer;
                $completed_orders_counter += 1;
            }
            if($check_if_order_completed == 3){
                $canceled_orders_counter += 1;
            }
        }
        $payments = DriverPayment::where('driverId',$driverId)->get();
        foreach($payments as $payment) {
            $total_payments += $payment->amount;
        }
        $driver = Driver::find($driverId);
        return view('dashboard/drivers/report',compact(['driver','orders_count','completed_orders_counter','canceled_orders_counter','offers','total_income','total_payments']));
    }


}
