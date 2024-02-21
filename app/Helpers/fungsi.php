<?php
namespace App\Helpers;
use App\Models\DokterModel;
use App\Models\FasilitasKesehatanModel;
use App\Models\JadwalDokterModel;
use App\Models\KategoriModel;
use App\Models\LayananModel;

class DashboardHelper
{
    public static function getDashboardStats()
    {
        $kategoriCount = KategoriModel::count();
        $fasilitasCount = FasilitasKesehatanModel::count();
        $dokterCount = DokterModel::count();
        $jadwalCount = JadwalDokterModel::count();
        $layananCount = LayananModel::count();

        return [
            'kategoriCount' => $kategoriCount,
            'fasilitasCount' => $fasilitasCount,
            'dokterCount' => $dokterCount,
            'jadwalCount' => $jadwalCount,
            'layananCount' => $layananCount,
        ];
    }
}
