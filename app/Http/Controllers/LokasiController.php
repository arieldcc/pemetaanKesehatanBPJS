<?php

namespace App\Http\Controllers;

use App\Models\FasilitasKesehatanModel;
use App\Models\KategoriModel;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function awal(){
        $menu = 'data-lokasi';
        $title = 'Lokasi Pelayanan Kesehatan BPJS';

        // $fasilitas = FasilitasKesehatanModel::all();
        $fasilitas = FasilitasKesehatanModel::with(['kategori', 'dokter', 'dokter.jadwalDokter', 'layanan'])->get();

        // dd($fasilitas);
        $kategori = KategoriModel::all();

        return view('apps.lokasi.index',compact('menu','title','fasilitas','kategori'));
    }

    public function cariLokasi(Request $request) {
        $query = FasilitasKesehatanModel::with(['kategori', 'dokter', 'dokter.jadwalDokter', 'layanan']);

        if ($request->has('kategori_id') && !empty($request->kategori_id)) {
            $query->where('kategori_id', $request->kategori_id);
        }

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_fasilitas', 'like', '%' . $search . '%')
                  ->orWhereHas('layanan', function($q) use ($search) {
                      $q->where('nama_layanan', 'like', '%' . $search . '%');
                  });
            });
        }

        $fasilitas = $query->get();

        return response()->json($fasilitas);
    }

}
