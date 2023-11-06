<?php

namespace App\Http\Controllers;

use App\Models\Coment;
use Illuminate\Http\Request;


class ComentController extends Controller
{
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'user_id' => 'required',
            'post_id' => 'required',
            'coment' => 'required',
            'parent_id' => ''
        ]);

        Coment::create($validateData);

        return redirect("/detail/".$request->input("post_id"));
    }
 
}
