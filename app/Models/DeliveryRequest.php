<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryRequest extends Model
{
    use HasFactory;
    protected $table = 'delivery_requests';
    protected $guarded = [];

    public function customer(){
        return $this->belongsTo(User::class, 'customerId');
    }

    public function driver(){
        return $this->belongsTo(User::class, 'driverId');
    }

    public function order(){
        return $this->belongsTo(Order::class, 'orderId');
    }
}
