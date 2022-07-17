<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $table = "ratings";
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class,'userId');
    }

    public function rater(){
        return $this->belongsTo(User::class,'raterId');
    }
}
