<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function awal(){
        $menu = 'data-user';
        $title = 'Data User';

        $user = User::all();

        // Mengambil entri yang terakhir diperbarui
        $lastUpdated = User::latest('updated_at')->first();

        // Jika tidak ada data di tabel, tentukan nilai default
        $lastUpdatedTime = $lastUpdated ? $lastUpdated->updated_at->diffForHumans() : 'Tidak ada data';

        return view('apps.user.index',compact('menu','title','user', 'lastUpdatedTime'));
    }

    public function edit_user(User $user){
        $menu = 'data-user';
        $title = 'Edit Data User';

        return view('apps.user.edit-user',compact('menu','title','user'));
    }

    public function update_user(Request $request, User $user){
        // dd(isset($request->reset_passw));
        $request->validate([
            'name'    => 'required',
            'email'   => 'required|email',
        ]);

        if(isset($request->reset_passw)){
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt('admin1234'),
            ]);
        }else{
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }

        // dd($request->all());

        return redirect('/data-user')->with('update','Data User berhasil di Update!');
    }
}
