<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonsultasiPengaduan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengaduan_id',
        'jadwal_konsultasi',
        'type_konsultasi',
        'link_konsultasi',
        'status_konsultasi',
        'konsultan_id'
    ];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }

    public function konsultan()
    {
        return $this->belongsTo(User::class, 'konsultan_id');
    }
}
