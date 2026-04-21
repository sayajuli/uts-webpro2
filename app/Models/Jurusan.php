<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jurusan extends Model
{
    protected $table = 'tb_jurusan';

    protected $primaryKey = 'id_jurusan';

    protected $fillable = [
        'nama_jurusan',
        'akreditasi'
    ];

    public function mahasiswa(): HasMany
    {
        return $this->hasMany(Mahasiswa::class, 'id_jurusan', 'id_jurusan');
    }

    public function matakuliah(): HasMany
    {
        return $this->hasMany(Matakuliah::class, 'id_jurusan', 'id_jurusan');
    }
}
