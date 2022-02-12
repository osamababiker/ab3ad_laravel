<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class,'userId');
    }

    public function category(){
        return $this->belongsTo(Category::class,'categoryId');
    }

    public function item(){
        return $this->belongsTo(Item::class,'itemId');
    }

}
