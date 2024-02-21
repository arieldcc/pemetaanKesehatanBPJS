<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LayananModel extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    // matikan auto increment
    public $incrementing = false;

    //Tipe data kunci utama adalah string
    protected $keyType = 'string';

    protected $table = 'layanan';
    protected $fillable = [
        'fasilitas_kesehatan_id',
        'nama_layanan',
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

    public function fasilitasKesehatan(){
        return $this->belongsTo(FasilitasKesehatanModel::class, 'fasilitas_kesehatan_id');
    }
}
