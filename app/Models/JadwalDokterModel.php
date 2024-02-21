<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class JadwalDokterModel extends Model
{
    use HasFactory;

    // matikan auto increment
    public $incrementing = false;

    //Tipe data kunci utama adalah string
    protected $keyType = 'string';

    protected $table = 'jadwal_dokter';
    protected $fillable = [
        'dokter_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'keterangan',
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

    public function dokter(){
        return $this->belongsTo(DokterModel::class, 'dokter_id');
    }
}
