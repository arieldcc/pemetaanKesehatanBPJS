<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class KategoriModel extends Model
{
    use HasFactory;
    // mematikan auto increment
    public $incrementing = false;

    //Tipe data kunci utama adalah string
    protected $keyType = 'string';

    protected $table = 'kategori';
    protected $fillable = ['nama_kategori','icon'];
    protected $primaryKey = 'id';

    protected static function boot()
    {
        parent::boot();

        // generate UUID pada saat model sedang dibuat
        static::creating(function($model){
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }

    public function fasilitasKesehatan(){
        return $this->hasMany(FasilitasKesehatanModel::class, 'kategori_id');
    }
}
