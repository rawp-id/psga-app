<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonsultasiPelaporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelaporan_id',
        'jadwal_konsultasi',
        'type_konsultasi',
        'link_konsultasi',
        'status_konsultasi',
        'konsultan_id'
    ];

    public function pelaporan()
    {
        return $this->belongsTo(Pelaporan::class);
    }

    public function konsultan()
    {
        return $this->belongsTo(User::class, 'konsultan_id');
    }
}
