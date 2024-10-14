<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kendaraan;
use App\Models\SubUnit;
use Illuminate\Support\Str;


class KendaraanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unit = SubUnit::where('slug', 'bagian-tata-usaha-lppm')->first();
        $dih = SubUnit::where('slug', 'bagian-tata-usaha-lppm')->first();
        $kendaraan = [
            [
                'plat_no'           => 'AD1048XA',
                'slug'              => Str::slug('AD1048XA', '-'),
                'merk'              => 'TOYOTA KIJANG INNOVA G TAHUN 2010 WARNA HITAM',
                'jenis'             => 'mobil',
                'kondisi'           => 'layak',
                'operasional'       => 'unit',
                'unit_kerja_id'     => $unit->id,
            ],
            [
                'plat_no'           => 'AD9504LA',
                'slug'              => Str::slug('AD9504LA', '-'),
                'merk'              => 'MITSUBISHI KUDA GLX DELUXE TAHUN 2002 WARNA BIRU',
                'jenis'             => 'mobil',
                'kondisi'           => 'tidak_layak',
                'operasional'       => 'unit',
                'unit_kerja_id'     => $unit->id,
            ],
            [
                'plat_no'           => 'AD9990CA',
                'slug'              => Str::slug('AD9990CA', '-'),
                'merk'              => 'HONDA SUPRA 125 TAHUN 2014 WARNA MERAH HITAM',
                'jenis'             => 'motor',
                'kondisi'           => 'layak',
                'operasional'       => 'unit',
                'unit_kerja_id'     => $unit->id,
            ],
            [
                'plat_no'           => 'AD1148XA',
                'slug'              => Str::slug('AD1148XA', '-'),
                'merk'              => 'TOYOTA AVANZA TAHUN 2016 WARNA HITAM',
                'jenis'             => 'mobil',
                'kondisi'           => 'layak',
                'operasional'       => 'unit',
                'unit_kerja_id'     => SubUnit::where('slug', 'bagian-biro-riset-dan-pengabdian-kepada-masyarakat')->first()->id,
            ],
            [
                'plat_no'           => 'AD1629HX',
                'slug'              => Str::slug('AD1629HX', '-'),
                'merk'              => 'TOYOTA HILUX TAHUN 2021 WARNA HITAM',
                'jenis'             => 'mobil',
                'kondisi'           => 'layak',
                'operasional'       => 'unit',
                'unit_kerja_id'     => SubUnit::where('slug', 'bagian-biro-riset-dan-pengabdian-kepada-masyarakat')->first()->id,
            ],
            [
                'plat_no'           => 'AD1146XA',
                'slug'              => Str::slug('AD1146XA', '-'),
                'merk'              => 'TOYOTA AVANZA TAHUN 2016 WARNA HITAM',
                'jenis'             => 'mobil',
                'kondisi'           => 'layak',
                'operasional'       => 'unit',
                'unit_kerja_id'     => SubUnit::where('slug', 'bagian-direkrorat-inovasi-dan-hilirisasi')->first()->id,
            ],
            [
                'plat_no'           => 'AD9822GA',
                'slug'              => Str::slug('AD9822GA', '-'),
                'merk'              => 'TRALL HONDA CRF 150CC TAHUN 2020 WARNA MERAH PUTIH',
                'jenis'             => 'motor',
                'kondisi'           => 'layak',
                'operasional'       => 'unit',
                'unit_kerja_id'     => SubUnit::where('slug', 'upt-pendidikan-dan-pelatihan-kehutanan')->first()->id,
            ],
            [
                'plat_no'           => 'AD6144XH',
                'slug'              => Str::slug('AD6144XH', '-'),
                'merk'              => 'TRALL HONDA CRF 150CC TAHUN 2019 WARNA MERAH PUTIH',
                'jenis'             => 'motor',
                'kondisi'           => 'layak',
                'operasional'       => 'unit',
                'unit_kerja_id'     => SubUnit::where('slug', 'upt-pendidikan-dan-pelatihan-kehutanan')->first()->id,
            ],
            [
                'plat_no'           => 'AD1089XA',
                'slug'              => Str::slug('AD1089XA', '-'),
                'merk'              => 'TOYOTA KIJANG SUPER LONG/KF52 TAHUN 1996 WARNA ABU ABU',
                'jenis'             => 'mobil',
                'kondisi'           => 'layak',
                'operasional'       => 'unit',
                'unit_kerja_id'     => $unit->id,
            ],
        ];

        Kendaraan::insert($kendaraan);
    }
}
