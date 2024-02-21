<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KategoriController extends Controller
{
    public function awal(){
        $menu = 'data-kategori';
        $title = 'Data Kategori';
        $data = KategoriModel::all();

        // Mengambil entri yang terakhir diperbarui
        $lastUpdated = KategoriModel::latest('updated_at')->first();

        // Jika tidak ada data di tabel, tentukan nilai default
        $lastUpdatedTime = $lastUpdated ? $lastUpdated->updated_at->diffForHumans() : 'Tidak ada data';

        return view('apps.kategori.index', compact('menu', 'title','data','lastUpdatedTime'));
    }

    public function tambah_kategori(){
        $menu = 'data-kategori';
        $title = 'Tambah Data Kategori';

        return view('apps.kategori.tambah-kategori',compact('menu','title'));
    }

    public function simpan_kategori(Request $request){
        // dd($request->all());
        $dataValidate = $request->validate([
            'nama_kategori' => 'required',
            'icon'      => 'image|mimes:jpeg,png,jpg|file|max:200|required',
        ]);

        if($request->file('icon')){
            $dataValidate['icon'] = $request->file('icon')->store('img-marker');
        }
        // dd($dataValidate['nama_kategori']);

        // KategoriModel::create($dataValidate);
        $data = new KategoriModel;
        $data->nama_kategori    = $request->nama_kategori;
        $data->icon             = $dataValidate['icon'];
        $data->save();

        return redirect('/data-kategori')->with('sukses','Data berhasil di Simpan!');
    }

    public function edit_kategori(KategoriModel $kategori){
        $menu = 'data-kategori';
        $title = 'Edit Data Kategori';

        return view('apps.kategori.edit-kategori', compact('menu','title','kategori'));
    }

    public function update_kategori(Request $request, KategoriModel $kategori){
        $dataValidasi = $request->validate([
            'nama_kategori' => 'required',
            'icon'      => 'image|mimes:jpeg,png,jpg|file|max:200',
        ]);

        if($request->file('icon')){
            if($request->oldicon){
                Storage::delete($request->oldicon);
            }
            $dataValidasi['icon'] = $request->file('icon')->store('img-marker');
        }

        // Jika ada icon yang diunggah, proses dan simpan
        if ($request->hasFile('icon')) {
            if ($request->oldicon) {
                Storage::delete($request->oldicon);
            }
            $validatedData['icon'] = $request->file('icon')->store('img-lokasifasilitas');
        } else {
            // Jika tidak ada icon baru, gunakan icon lama
            $validatedData['icon'] = $request->oldicon;
        }

        // $kategori->update([
        //     'nama_kategori' => $request->nama_kategori,
        //     'icon'          => $dataValidasi['icon'],
        // ]);

        $kategori->update($dataValidasi);

        return redirect('/data-kategori')->with('update','Data Berhasil di Update!');
    }

    public function delete_kategori($kategori){
        $data = KategoriModel::find($kategori);
        $data->delete();

        if($data->icon){
            Storage::delete($data->icon);
        }

        return redirect('/data-kategori')->with('delete','Data Berhasil di Hapus!');
    }

    public function get_icon($id){
        // dd($id);
        $data = KategoriModel::find($id);
        return response()->json($data);
    }
}
