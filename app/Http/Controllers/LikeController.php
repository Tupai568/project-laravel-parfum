<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index(Request $request)
    {
        $post_id = $request->input('post_id');
        $user_id = auth()->user()->id;

        $data = [
            'post_id' => $post_id,
            'user_id' => $user_id
        ];

        $query = Like::where($data);

        if ($query->count() > 0) {
            $query->delete();
            $likeStatus = 'unliked';
        } else {
            Like::create($data);
            $likeStatus = 'liked';
        }
    
        $likeCount = Like::where('post_id', $post_id)->count();
    
        return response()->json([
            'status' => $likeStatus,
            'likeCount' => $likeCount
        ]);

    }
}
