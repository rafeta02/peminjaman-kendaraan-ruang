<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 21,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 22,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 23,
                'title' => 'master_access',
            ],
            [
                'id'    => 24,
                'title' => 'unit_create',
            ],
            [
                'id'    => 25,
                'title' => 'unit_edit',
            ],
            [
                'id'    => 26,
                'title' => 'unit_show',
            ],
            [
                'id'    => 27,
                'title' => 'unit_delete',
            ],
            [
                'id'    => 28,
                'title' => 'unit_access',
            ],
            [
                'id'    => 29,
                'title' => 'sub_unit_create',
            ],
            [
                'id'    => 30,
                'title' => 'sub_unit_edit',
            ],
            [
                'id'    => 31,
                'title' => 'sub_unit_show',
            ],
            [
                'id'    => 32,
                'title' => 'sub_unit_delete',
            ],
            [
                'id'    => 33,
                'title' => 'sub_unit_access',
            ],
            [
                'id'    => 34,
                'title' => 'satpam_create',
            ],
            [
                'id'    => 35,
                'title' => 'satpam_edit',
            ],
            [
                'id'    => 36,
                'title' => 'satpam_show',
            ],
            [
                'id'    => 37,
                'title' => 'satpam_delete',
            ],
            [
                'id'    => 38,
                'title' => 'satpam_access',
            ],
            [
                'id'    => 39,
                'title' => 'driver_create',
            ],
            [
                'id'    => 40,
                'title' => 'driver_edit',
            ],
            [
                'id'    => 41,
                'title' => 'driver_show',
            ],
            [
                'id'    => 42,
                'title' => 'driver_delete',
            ],
            [
                'id'    => 43,
                'title' => 'driver_access',
            ],
            [
                'id'    => 44,
                'title' => 'kendaraan_create',
            ],
            [
                'id'    => 45,
                'title' => 'kendaraan_edit',
            ],
            [
                'id'    => 46,
                'title' => 'kendaraan_show',
            ],
            [
                'id'    => 47,
                'title' => 'kendaraan_delete',
            ],
            [
                'id'    => 48,
                'title' => 'kendaraan_access',
            ],
            [
                'id'    => 49,
                'title' => 'log_access',
            ],
            [
                'id'    => 50,
                'title' => 'lantai_create',
            ],
            [
                'id'    => 51,
                'title' => 'lantai_edit',
            ],
            [
                'id'    => 52,
                'title' => 'lantai_show',
            ],
            [
                'id'    => 53,
                'title' => 'lantai_delete',
            ],
            [
                'id'    => 54,
                'title' => 'lantai_access',
            ],
            [
                'id'    => 55,
                'title' => 'ruang_create',
            ],
            [
                'id'    => 56,
                'title' => 'ruang_edit',
            ],
            [
                'id'    => 57,
                'title' => 'ruang_show',
            ],
            [
                'id'    => 58,
                'title' => 'ruang_delete',
            ],
            [
                'id'    => 59,
                'title' => 'ruang_access',
            ],
            [
                'id'    => 60,
                'title' => 'pinjam_ruang_create',
            ],
            [
                'id'    => 61,
                'title' => 'pinjam_ruang_edit',
            ],
            [
                'id'    => 62,
                'title' => 'pinjam_ruang_show',
            ],
            [
                'id'    => 63,
                'title' => 'pinjam_ruang_delete',
            ],
            [
                'id'    => 64,
                'title' => 'pinjam_ruang_access',
            ],
            [
                'id'    => 65,
                'title' => 'log_pinjam_ruangan_show',
            ],
            [
                'id'    => 66,
                'title' => 'log_pinjam_ruangan_access',
            ],
            [
                'id'    => 67,
                'title' => 'pinjam_kendaraan_create',
            ],
            [
                'id'    => 68,
                'title' => 'pinjam_kendaraan_edit',
            ],
            [
                'id'    => 69,
                'title' => 'pinjam_kendaraan_show',
            ],
            [
                'id'    => 70,
                'title' => 'pinjam_kendaraan_delete',
            ],
            [
                'id'    => 71,
                'title' => 'pinjam_kendaraan_access',
            ],
            [
                'id'    => 72,
                'title' => 'log_pinjam_kendaraan_show',
            ],
            [
                'id'    => 73,
                'title' => 'log_pinjam_kendaraan_access',
            ],
            [
                'id'    => 74,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
