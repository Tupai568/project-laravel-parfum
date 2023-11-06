<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Coment;
use App\Models\Categories;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() //home
    {
        return view('home.index', [
            'judul' => 'Home',
            "likes" => Post::withCount(["likes as likes_count"])->orderBy('likes_count', 'desc')->take(3)->get(),
            'categories' => Categories::all(),
            'unisexs' => Post::with('category')
                        ->whereHas('category', function ($query) {
                            $query->where('name', 'unisex');
                        })->latest()->take(10)->get(),
            'females' => Post::with('category')
                        ->whereHas('category', function ($query) {
                            $query->where('name', 'female');
                        })->latest()->take(10)->get(),
            'males' => Post::with('category')
                        ->whereHas('category', function ($query) {
                            $query->where('name', 'male');
                        })->latest()->take(10)->get()

        ]); 
    }

    
    public function category(Categories $category) //category berdasarkan nama
    {
        return view('home.category', [
            'judul' => $category->name,
            'categories' => Categories::all(),
            'posts' => $category->posts()
                        ->with('status', 'likes')
                        ->withCount('likes as like_count')
                        ->paginate(10)->withQueryString()
                        
        ]);
    }


    public function everything() //semua produk
    {
        return view('home.everything', [
            'judul' => 'everything',
            'categories' => Categories::all(),
            'posts' => Post::with('status', 'likes')
            ->orderBy('created_at', 'asc')
            ->withCount('likes as like_count')
            ->filter(request(['search']))
            ->paginate(10)->withQueryString()
        ]);
    }

    public function detail(Post $detail)
    {
        function hasil($relation){
            $user = "";
            $one = "";
            for ($i=0; $i < 10; $i++) { 
                $user.="replies.";
                $one.=$user.$relation.",";
            }
            $result = substr($one, 0, -1);
            $convert = explode(",", $result);
            return $convert;
        }


        $comments = Coment::with(array_merge(hasil("user"), ["user"] ))
            ->where('post_id', $detail->id)
            ->whereNull('parent_id')
            ->get();
        // $comments->load(array_merge(hasil("user")));


        return view('home.detail', [
            "judul" => "Detail Product",
            "categories" => Categories::all(),
            "comments" => $comments,
            "post" => $detail
        ]);
    }

}
