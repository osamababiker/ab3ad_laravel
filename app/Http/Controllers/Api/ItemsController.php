<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

class ItemsController extends Controller
{
    public function getAllItems(){
        $items = Item::all();
        return response()->json([
            'data' => $items
        ],200);
    }   

    public function getItemsByCategory($categoryId){
        $items = Item::where('categoryId', $categoryId)->get();
        return response()->json([
            'data' => $items
        ],200);
    }
} 
