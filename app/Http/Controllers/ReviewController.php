<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    public function createReview(Request $request){
        try {
            $pizzaId = $request->input('pizza_id');
            $userId = auth()->user()->id;
            $review = $request->input('review');

            $newReview = new Review();
            $newReview->pizza_id = $pizzaId;
            $newReview->user_id = $userId;
            $newReview->review = $review;
            $newReview->save();

            return response()->json([
                'success' => true,
                'message' => 'Review created',
                'data' => $review
            ]);
        } catch (\Throwable $th){
            Log::error('CREATIN REVIEW: '.$th->getMessage());
            return response()->json([ 
                'success' => false,
                'message' => "Error creating review"],500);
        }
    }
}
