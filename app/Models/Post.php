<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('judul', 'like', '%' . $search . '%')
                ->orWhere('harga', 'like', '%' . $search . '%')
                ->orWhereHas('category', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('status', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
        });
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function like()
    {
        if (Auth::check()) {
            return $this->hasOne(Like::class)->where('likes.user_id', Auth::user()->id);
        }
    }


    public function likes()
    {
        // if (Auth::check()) {
        //     return $this->hasOne(Like::class)->where('likes.user_id', Auth::user()->id);
        // }
        return $this->hasMany(Like::class);
    }

    // Menggunakan withCount untuk menghitung jumlah "Suka"
    public function totalLikes()
    {
        // return $this->hasOne(Like::class)
        //     ->selectRaw('post_id, count(*) as count')
        //     ->groupBy('post_id');
        return $this->hasOne(Like::class)->count();
    }

    public function coments()
    {
        return $this->hasMany(Coment::class)->whereNull('parent_id');
    }
}

