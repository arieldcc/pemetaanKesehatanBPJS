<?php

namespace App\Http\Controllers;

use App\Models\FasilitasKesehatanModel;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FasilitasKesehatanController extends Controller
{
    public function awal(){
        $menu = 'data-fasilitas';
        $title = 'Data Fasilitas Kesehatan';

        // Mengambil entri yang terakhir diperbarui
        $lastUpdated = FasilitasKesehatanModel::latest('updated_at')->first();

        // Jika tidak ada data di tabel, tentukan nilai default
        $lastUpdatedTime = $lastUpdated ? $lastUpdated->updated_at->diffForHumans() : 'Tidak ada data';

        // // Ambil semua fasilitas kesehatan dengan kategori yang terkait
        // $fasilitasKesehatan = FasilitasKesehatanModel::with('kategori')->get();

        // // Mengelompokkan fasilitas kesehatan berdasarkan kategori_id
        // $groupedByKategori = $fasilitasKesehatan->groupBy('kategori_id');

        // // Siapkan data untuk dikirim ke view
        // $data = [];
        // foreach ($groupedByKategori as $kategoriId => $fasilitas) {
        //     $kategori = $fasilitas->first()->kategori;
        //     $data[] = [
        //         'kategori' => $kategori->nama_kategori,
        //         'fasilitas' => $fasilitas,
        //         'icon' => $kategori->icon // jika Anda ingin menampilkan ikon
        //     ];
        // }

        $data = FasilitasKesehatanModel::all();
        return view('apps.fasilitaskesehatan.index',compact('menu','title','data','lastUpdatedTime'));
    }

    public function tambah_fasilitas(){
        $menu = 'data-fasilitas';
        $title = 'Tambah Data Fasilitas Kesehatan';
        $kategori = KategoriModel::all();

        return view('apps.fasilitaskesehatan.tambah-fasilitas',compact('menu','title','kategori'));
    }

    public function simpan_fasilitas(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'kategori_id'   => 'required',
            'nama_fasilitas'=> 'required',
            'alamat'        => 'required',
            'kota'          => 'required',
            'propinsi'      => 'required',
            'kode_pos'      => 'required',
            'no_telp'       => 'required',
            'email'         => 'required|email',
            'latitude'      => 'required',
            'longitude'     => 'required',
            'foto'          => 'sometimes|image|mimes:jpeg,png,jpg|max:500',
        ]);

        // Cek apakah ada file foto yang diunggah
        if ($request->hasFile('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('img-lokasifasilitas');
        } else {
            $validatedData['foto'] = null; // Jika tidak ada foto, set sebagai null
        }

        // Buat record baru di database dengan data yang telah divalidasi
        FasilitasKesehatanModel::create($validatedData);

        // Redirect kembali ke halaman dengan pesan sukses
        return redirect('/data-fasilitas')->with('sukses', 'Data berhasil di Simpan!');
    }


    public function edit_fasilitas(FasilitasKesehatanModel $fasilitas){
        $menu = 'data-fasilitas';
        $title = 'Edit Data Fasilitas Kesehatan';

        $kategori = KategoriModel::all();

        return view('apps.fasilitaskesehatan.edit-fasilitas',compact('menu','title','fasilitas','kategori'));
    }

    public function update_fasilitas(Request $request, FasilitasKesehatanModel $fasilitas)
    {
        $validatedData = $request->validate([
            'kategori_id'    => 'required',
            'nama_fasilitas' => 'required',
            'alamat'         => 'required',
            'kota'           => 'required',
            'propinsi'       => 'required',
            'kode_pos'       => 'required',
            'no_telp'        => 'required',
            'email'          => 'required|email',
            'latitude'       => 'required',
            'longitude'      => 'required',
            'foto'           => 'sometimes|image|mimes:jpeg,png,jpg|max:200',
        ]);

        // Jika ada foto yang diunggah, proses dan simpan
        if ($request->hasFile('foto')) {
            if ($request->oldfoto) {
                Storage::delete($request->oldfoto);
            }
            $validatedData['foto'] = $request->file('foto')->store('img-lokasifasilitas');
        } else {
            // Jika tidak ada foto baru, gunakan foto lama
            $validatedData['foto'] = $request->oldfoto;
        }

        // Update fasilitas dengan data yang divalidasi
        $fasilitas->update($validatedData);

        return redirect('/data-fasilitas')->with('update', 'Data berhasil di Update!');
    }


    public function delete_fasilitas($fasilitas){
        $data = FasilitasKesehatanModel::find($fasilitas);
        $data->delete();

        if($data->foto){
            Storage::delete($data->foto);
        }

        return redirect('/data-fasilitas')->with('delete','Data Berhasil di Hapus!');
    }
}
