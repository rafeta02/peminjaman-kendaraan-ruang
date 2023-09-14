<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Kendaraan extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'kendaraans';

    protected $appends = [
        'foto',
    ];

    public const JENIS_SELECT = [
        'mobil' => 'Mobil',
        'motor' => 'Motor',
    ];

    protected $dates = [
        'servis_terakhir',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const KONDISI_SELECT = [
        'layak'       => 'Layak Pakai',
        'tidak_layak' => 'Tidak Layak Pakai',
    ];

    public const OPERASIONAL_SELECT = [
        'unit'     => 'Operasional Unit',
        'pimpinan' => 'Operasional Pimpinan',
    ];

    protected $fillable = [
        'plat_no',
        'merk',
        'jenis',
        'kondisi',
        'operasional',
        'is_used',
        'unit_kerja_id',
        'owned_by_id',
        'servis_terakhir',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function kendaraanPinjamKendaraans()
    {
        return $this->hasMany(PinjamKendaraan::class, 'kendaraan_id', 'id');
    }

    public function unit_kerja()
    {
        return $this->belongsTo(SubUnit::class, 'unit_kerja_id');
    }

    public function owned_by()
    {
        return $this->belongsTo(User::class, 'owned_by_id');
    }

    public function getServisTerakhirAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setServisTerakhirAttribute($value)
    {
        $this->attributes['servis_terakhir'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getFotoAttribute()
    {
        $files = $this->getMedia('foto');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }
}
