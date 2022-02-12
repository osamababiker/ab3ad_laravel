<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;


class CategoriesController extends Controller
{
    public function getAll(){
        $categories = Category::get(); 
        if(count($categories) == 0){ 
            return response()->json(['message' => 'there are no categories'],404);
        }
        return response()->json(['data' => $categories],200);
    }

    
}
