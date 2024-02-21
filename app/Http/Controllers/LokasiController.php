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
}
