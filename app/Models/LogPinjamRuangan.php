<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogPinjamRuangan extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'log_pinjam_ruangans';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const JENIS_SELECT = [
        'diajukan'  => 'Diajukan',
        'disetujui' => 'Disetujui',
        'ditolak'   => 'Ditolak',
    ];

    protected $fillable = [
        'peminjaman_id',
        'ruang_id',
        'jenis',
        'log',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function peminjaman()
    {
        return $this->belongsTo(PinjamRuang::class, 'peminjaman_id');
    }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'ruang_id');
    }
}
