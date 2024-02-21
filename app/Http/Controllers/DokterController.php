<?php

namespace App\Http\Controllers;

use App\Models\DokterModel;
use App\Models\FasilitasKesehatanModel;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokterController extends Controller
{
    public function awal(){
        $menu = 'data-dokter';
        $title = 'Data Dokter';

        $data = DokterModel::all();

        // Mengambil entri yang terakhir diperbarui
        $lastUpdated = DokterModel::latest('updated_at')->first();

        // Jika tidak ada data di tabel, tentukan nilai default
        $lastUpdatedTime = $lastUpdated ? $lastUpdated->updated_at->diffForHumans() : 'Tidak ada data';

        return view('apps.dokter.index',compact('menu','title','data','lastUpdatedTime'));
    }

    public function tambah_dokter() {
        $menu = 'data-dokter';
        $title = 'Tambah Data Dokter';

        $fasilitas = FasilitasKesehatanModel::all();

        return view('apps.dokter.tambah-dokter',compact('menu','title','fasilitas'));
    }

    public function simpan_dokter(Request $request) {
        $dataValidate = $request->validate([
            'fasilitas_kesehatan_id'    => 'required',
            'nama_dokter'               => 'required',
            'spesialis'                 => 'required',
            'no_telp'                   => 'required',
            'email'                     => 'required',
            'foto'                      => 'image|mimes:jpeg,png,jpg|file|max:500',
        ]);

        if($request->file('foto')){
            $dataValidate['foto'] = $request->file('foto')->store('img-dokter');
        }

        $data = new DokterModel;
        $data->fasilitas_kesehatan_id   = $request->fasilitas_kesehatan_id;
        $data->nama_dokter              = $request->nama_dokter;
        $data->spesialis                = $request->spesialis;
        $data->no_telp                  = $request->no_telp;
        $data->email                    = $request->email;
        $data->foto                     = $dataValidate['foto'];
        $data->save();

        return redirect('/data-dokter')->with('sukses','Data berhasil di Simpan!');
    }

    public function edit_dokter(DokterModel $dokter) {
        $menu = 'data-dokter';
        $title = 'Edit Data Dokter';

        $fasilitas = FasilitasKesehatanModel::all();

        return view('apps.dokter.edit-dokter',compact('menu','title','dokter','fasilitas'));
    }

    public function update_dokter(Request $request, DokterModel $dokter)
    {
        // Validasi data
        $validatedData = $request->validate([
            'fasilitas_kesehatan_id' => 'required',
            'nama_dokter'            => 'required',
            'spesialis'              => 'required',
            'no_telp'                => 'required',
            'email'                  => 'required|email',
            'foto'                   => 'image|mimes:jpeg,png,jpg|max:500',
        ]);

        // Siapkan data yang akan di-update
        $updateData = $request->only(['fasilitas_kesehatan_id', 'nama_dokter', 'spesialis', 'no_telp', 'email']);

        // Periksa dan proses file foto jika diunggah
        if ($file = $request->file('foto')) {
            // Hapus foto lama jika ada
            if ($dokter->foto && Storage::exists($dokter->foto)) {
                Storage::delete($dokter->foto);
            }

            // Simpan foto baru dan update data untuk di-update
            $updateData['foto'] = $file->store('img-dokter');
        }

        // Update data dokter
        $dokter->update($updateData);

        return redirect('/data-dokter')->with('update', 'Data berhasil di Update!');
    }


    public function delete_dokter($dokter){
        $data = DokterModel::find($dokter);
        $data->delete();

        if($data->foto){
            Storage::delete($data->foto);
        }

        return redirect('/data-dokter')->with('delete','Data Berhasil di Hapus!');
    }
}
