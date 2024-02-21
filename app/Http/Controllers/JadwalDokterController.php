<?php

namespace App\Http\Controllers;

use App\Models\DokterModel;
use App\Models\JadwalDokterModel;
use Illuminate\Http\Request;

class JadwalDokterController extends Controller
{
    public function awal(){
        $menu = 'data-jadwal';
        $title = 'Data Jadwal Dokter';

        $data = JadwalDokterModel::all();

        // Mengambil entri yang terakhir diperbarui
        $lastUpdated = JadwalDokterModel::latest('updated_at')->first();

        // Jika tidak ada data di tabel, tentukan nilai default
        $lastUpdatedTime = $lastUpdated ? $lastUpdated->updated_at->diffForHumans() : 'Tidak ada data';

        return view('apps.jadwaldokter.index',compact('menu','title','data','lastUpdatedTime'));
    }

    public function tambah_jadwal(){
        $menu = 'data-jadwal';
        $title = 'Tambah Data Jadwal Dokter';

        $dokter = DokterModel::all();

        return view('apps.jadwaldokter.tambah-jadwal',compact('menu','title', 'dokter'));
    }

    public function get_dokter($id){
        $data = DokterModel::find($id);

        return response()->json($data);
    }

    public function simpan_jadwal(Request $request){
        $validasiData = $request->validate([
            'dokter_id' => 'required',
            'hari'      => 'required',
            'jam_mulai' => 'required',
            'jam_selesai'   => 'required',
            'keterangan'    => 'required',
        ]);

        JadwalDokterModel::create($validasiData);

        return redirect('/data-jadwal')->with('sukses','Data Berhasil di Simpan!');
    }

    public function edit_jadwal(JadwalDokterModel $jadwal){
        $menu = 'data-jadwal';
        $title = 'Edit Data Jadwal Dokter';

        $dokter = DokterModel::all();

        return view('apps.jadwaldokter.edit-jadwal',compact('menu','title','jadwal','dokter'));
    }

    public function update_jadwal(Request $request, JadwalDokterModel $jadwal){
        $validasiData = $request->validate([
            'dokter_id' => 'required',
            'hari'      => 'required',
            'jam_mulai' => 'required',
            'jam_selesai'   => 'required',
            'keterangan'    => 'required',
        ]);

        $jadwal->update($validasiData);

        return redirect('data-jadwal')->with('update','Data Berhasil di Update!');
    }

    public function delete_jadwal($id){
        $data = JadwalDokterModel::find($id);
        $data->delete();

        return redirect('/data-jadwal')->with('delete','Data Berhasil di Hapus!');
    }
}
