<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DefaultPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name'         => 'manage_doctors',
                'display_name' => 'Mengelola Dokter',
            ],
            [
                'name'         => 'manage_patients',
                'display_name' => 'Mengelola Pasien',
            ],
            [
                'name'         => 'manage_appointments',
                'display_name' => 'Mengelola Pendaftaran',
            ],
            [
                'name'         => 'manage_patient_visits',
                'display_name' => 'Mengelola Kasus Pasien',
            ],
            [
                'name'         => 'manage_staff',
                'display_name' => 'Mengelola Staf',
            ],
            [
                'name'         => 'manage_doctor_sessions',
                'display_name' => 'Mengelola Jadwal Dokter',
            ],
            [
                'name'         => 'manage_settings',
                'display_name' => 'Mengelola Pengaturan',
            ],
            [
                'name'         => 'manage_services',
                'display_name' => 'Mengelola Pelayanan',
            ],
            [
                'name'         => 'manage_specialities',
                'display_name' => 'Mengelola Spesialisasi',
            ],
            [
                'name'         => 'manage_countries',
                'display_name' => 'Mengelola Negara',
            ],
            [
                'name'         => 'manage_states',
                'display_name' => 'Mengelola Provinsi',
            ],
            [
                'name'         => 'manage_cities',
                'display_name' => 'Mengelola Kabupaten',
            ],
            [
                'name'         => 'manage_roles',
                'display_name' => 'Mengelola Peran',
            ],
            [
                'name'         => 'manage_currencies',
                'display_name' => 'Mengelola Mata Uang',
            ],
            [
                'name'         => 'manage_admin_dashboard',
                'display_name' => 'Mengelola Beranda',
            ],
            [
                'name'         => 'manage_front_cms',
                'display_name' => 'Mengelola CMS',
            ],
            [
                'name'         => 'manage_transactions',
                'display_name' => 'Mengelola Transaksi',
            ],
            [
                'name'         => 'manage_pharmacys',
                'display_name' => 'Mengelola Apotek',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
