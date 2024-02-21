<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DokterModel extends Model
{
    use HasFactory;

    // mematikan auto increment
    public $incrementing = false;

    //Tipe data kunci utama adalah string
    protected $keyType = 'string';

    protected $table = 'dokter';
    protected $fillable = [
        'fasilitas_kesehatan_id',
        'nama_dokter',
        'spesialis',
        'no_telp',
        'email',
        'foto',
    ];

    protected static function boot()
    {
        parent::boot();

        // generate UUID pada saat model sedang dibuat
        static::creating(function($model){
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }

    protected $primaryKey = 'id';

    public function fasilitasKesehatan(){
        return $this->belongsTo(FasilitasKesehatanModel::class, 'fasilitas_kesehatan_id');
    }

    public function jadwalDokter(){
        return $this->hasMany(JadwalDokterModel::class, 'dokter_id');
    }
}
