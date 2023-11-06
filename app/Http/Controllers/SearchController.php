<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class SearchController extends Controller
{
    public function index (Request $request){
        $search = $request->input('search');


        if(isset($search)){
            $results = Post::where('judul', 'LIKE', '%'.$search.'%')->get();
            if(count($results) !== 0){
                    return response()->json($results);
            }else{
                return response()->json([
                    "result" => "not found"
                ]);
            }
        }
    }
}
