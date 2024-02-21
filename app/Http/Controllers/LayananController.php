<?php

namespace App\Http\Controllers;

use App\Models\FasilitasKesehatanModel;
use App\Models\LayananModel;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function awal(){
        $menu = 'data-layanan';
        $title = 'Data Layanan Fasilitas Kesehatan';

        $data = LayananModel::all();

        // Mengambil entri yang terakhir diperbarui
        $lastUpdated = LayananModel::latest('updated_at')->first();

        // Jika tidak ada data di tabel, tentukan nilai default
        $lastUpdatedTime = $lastUpdated ? $lastUpdated->updated_at->diffForHumans() : 'Tidak ada data';

        return view('apps.layanan.index',compact('menu','title','data','lastUpdatedTime'));
    }

    public function tambah_layanan(){
        $menu = 'data-layanan';
        $title = 'Tambah Data Layanan Fasilitas Kesehatan';

        $fasilitas = FasilitasKesehatanModel::all();

        return view('apps.layanan.tambah-layanan',compact('menu','title','fasilitas'));
    }

    public function get_fasilitas($id){
        $data = FasilitasKesehatanModel::find($id);

        return response()->json($data);
    }

    public function simpan_layanan(Request $request){
        $validasiData = $request->validate([
            'fasilitas_kesehatan_id'    => 'required',
            'nama_layanan'  => 'required',
            'keterangan'    => 'required',
        ]);

        LayananModel::create($validasiData);

        return redirect('/data-layanan')->with('sukses','Data Berhasil di Simpan!');
    }

    public function edit_layanan(LayananModel $layanan){
        $menu = 'data-layanan';
        $title = 'Edit Data Layanan Fasilitas Kesehatan';

        $fasilitas = FasilitasKesehatanModel::all();

        return view('apps.layanan.edit-layanan',compact('menu','title','fasilitas','layanan'));
    }

    public function update_layanan(Request $request, LayananModel $layanan){
        $validasiData = $request->validate([
            'fasilitas_kesehatan_id'    => 'required',
            'nama_layanan'  => 'required',
            'keterangan'    => 'required',
        ]);

        $layanan->update($validasiData);

        return redirect('/data-layanan')->with('update','Data Berhasil di Update!');
    }

    public function delete_layanan($layanan){
        $data = LayananModel::find($layanan);
        $data->delete();

        return redirect('/data-layanan')->with('delete','Data Berhasil di Hapus!');
    }
}
