<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\User;
use App\Models\Coment;
use App\Models\Categories;
use Illuminate\Http\Request;

class DataUserController extends Controller
{
    public function index()
    {
        return view('dashboard.dataUser', [
            "judul" => "dataUser",
            "categories" => Categories::all(),
            "users" => User::orderBy('IsAdmin', 'DESC')->filter(request(['search']))->get()
        ]);
    }

    public function update(Request $request)
    {   
        $status = $request->input("IsAdmin");
        $id = $request->input("id");
        $validate = $request->validate([
            'IsAdmin' => 'required'
        ]);

        if ($status == 0) {
            $validate["IsAdmin"] = true;
        }else{
            $validate["IsAdmin"] = false;
        }
        
        User::where('id', $id)->update($validate);
        return redirect('/dataUser')->with('success', 'berhasil update data');        
    }

    public function destroy(Request $request)
    {
        $id = $request->input("id");
        $user = User::find($id);

        if (!$user) {
            return redirect('/dataUser')->with('error', 'User tidak ditemukan');
        }

        // Hapus komentar yang terkait dengan pengguna
        Coment::where('user_id', $id)->delete(); 

        // Hapus like yang terkait dengan product
        Like::where('user_id', $id)->delete();

        // Hapus pengguna
        $user->delete();

        return redirect('/dataUser')->with('success', 'Berhasil menghapus data');
    }


    // public function destroy(Request $request)
    // {
    //     $id = $request->input("id");
    //     User::destroy($id);
    //     Coment::destroy('user_id', $id);
    //     return redirect('/dataUser')->with('success', 'berhasil delete data'); 
        
    // }
}
