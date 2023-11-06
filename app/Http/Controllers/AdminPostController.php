<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\Coment;
use App\Models\Status;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class AdminPostController extends Controller
{
    /**->                        -
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.index', [
            'judul' => 'dashboardAdmin',
            'categories' => Categories::all(),
            'posts' => Post::with('category', 'status')->latest()->filter(request(['search']))->get(),
        ]);
    }

    /** 
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.create', [
            'judul' => 'dashboardAdminCreate',
            'statuses' => Status::all(),
            'categories' => Categories::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * php artisan storage:link
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'judul' => 'required|min:5',
            'harga' => 'required|integer',
            'status_id' => 'required',
            'category_id' => 'required',
            'image' => 'image|file|max:3072',
            'descripsi' => 'required|min:10|max:300'
        ]);

        if ($request->file('image')) {
            $validateData['image'] = $request->file('image')->store('post-image');
        }

        Post::create($validateData);
        return redirect('/dashboard/admin/posts')->with('success', 'berhasil tambah data');

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('dashboard.show', [
            'judul' => 'dashboardAdminShow',
            'categories' => Categories::all(),
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('dashboard.edit', [
            'judul' => 'dashboardAdminEdit',
            'post' => $post,
            'statuses' => Status::all(),
            'categories' => Categories::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
            'judul' => 'required|min:5',
            'harga' => 'required|integer',
            'status_id' => 'required',
            'category_id' => 'required',
            'image' => 'image|file|max:3072',
            'descripsi' => 'required|min:10|max:300'
        ];

        $validateData = $request->validate($rules);

        if($request->file('image')){
            if($request->oldIMG){
                Storage::delete($request->oldIMG);
            }
            $validateData['image'] = $request->file('image')->store('post-image');
        }


        Post::where('id', $post->id)->update($validateData);
        return redirect('/dashboard/admin/posts')->with('success', 'berhasil update data');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post) //$post harus sama dengan text terakhir dirouting
    {
        if($post->image){
            Storage::delete($post->image);
        }
        $cekPost = Post::find($post->id);

        // Post::destroy($post->id);
        if (!$cekPost) {
            return redirect('/dashboard/admin/posts')->with('error', 'Produk tidak ditemukan');
        }

        // Hapus komentar yang terkait dengan product
        Coment::where('post_id', $post->id)->delete();

        // Hapus like yang terkait dengan product
        Like::where('post_id', $post->id)->delete();

        // Hapus product
        $cekPost->delete();

        return redirect('/dashboard/admin/posts')->with('success', 'Berhasil menghapus data');
    }
}
