<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogPinjamKendaraan extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'log_pinjam_kendaraans';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'peminjaman_id',
        'kendaraan_id',
        'peminjam_id',
        'jenis',
        'log',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const JENIS_SELECT = [
        'diajukan'     => 'Diajukan',
        'diproses'     => 'Diproses',
        'disetujui'    => 'Disetujui',
        'dipinjam'     => 'Dipinjam',
        'ditolak'      => 'Ditolak',
        'dikembalikan' => 'Dikembalikan',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function peminjaman()
    {
        return $this->belongsTo(PinjamKendaraan::class, 'peminjaman_id');
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
    }

    public function peminjam()
    {
        return $this->belongsTo(User::class, 'peminjam_id');
    }
}
