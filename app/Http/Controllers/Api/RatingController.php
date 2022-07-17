<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Rating;
use App\Models\User; 

class RatingController extends Controller
{
    public function getUserRating($userId){
        $ratings = Rating::where('userId',$userId)
            ->with('user')->with('rater')->get();
        return response()->json([
            'data' => $ratings
        ],200);
    }

    public function saveRating(Request $request){
        $rules = [
            'userId' => "required",
            'raterId' => 'required',
            'rating' => 'required',
            'review' => 'required'
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $rating = new Rating();
        $rating->userId = $request->userId;
        $rating->raterId = $request->raterId;
        $rating->rating = $request->rating;
        $rating->review = $request->review;
        $rating->save();

        $rating = Rating::where('id',$rating->id)->with('user')->with('rater')->first();

        // to update user rating
        $userNewRating = Rating::where('userId',$request->userId)->selectRaw('SUM(rating)/COUNT(userId) AS avg_rating')->first()->avg_rating;
        $user = User::find($request->userId);
        $user->rating = number_format($userNewRating,1);
        
        return response()->json([
            'data' => $rating
        ], 200);
    }
}
