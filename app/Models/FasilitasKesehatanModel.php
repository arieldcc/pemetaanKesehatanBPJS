<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FasilitasKesehatanModel extends Model
{
    use HasFactory;
    // matikan auto increment
    public $incrementing = false;

    //Tipe data kunci utama adalah string
    protected $keyType = 'string';

    protected $table = 'fasilitas_kesehatan';
    protected $fillable = [
        'kategori_id',
        'nama_fasilitas',
        'alamat',
        'kota',
        'propinsi',
        'kode_pos',
        'no_telp',
        'email',
        'latitude',
        'longitude',
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

    public function kategori(){
        return $this->belongsTo(KategoriModel::class, 'kategori_id');
    }

    public function dokter(){
        return $this->hasMany(DokterModel::class, 'fasilitas_kesehatan_id');
    }

    public function layanan(){
        return $this->hasMany(LayananModel::class, 'fasilitas_kesehatan_id');
    }
}
