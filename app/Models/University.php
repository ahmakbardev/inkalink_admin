<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'nama_universitas',
        'gambar_rnm', // ubah dari gambar_RNM ke gambar_rnm
        'nama_jurusan',
        'nilai_rnm',
        'url_info_pendaftaran',
        'url_info_passinggrade',
        'url_biaya_pendidikan'
    ];

    public function universities()
    {
        return $this->hasMany(University::class, 'nama_universitas', 'nama_universitas');
    }
}
