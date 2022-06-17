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
                'display_name' => 'Dokter',
            ],
            [
                'name'         => 'manage_patients',
                'display_name' => 'Pasien',
            ],
            [
                'name'         => 'manage_appointments',
                'display_name' => 'Pendaftaran',
            ],
            [
                'name'         => 'manage_patient_visits',
                'display_name' => 'Kasus Pasien',
            ],
            [
                'name'         => 'manage_staff',
                'display_name' => 'Staf',
            ],
            [
                'name'         => 'manage_doctor_sessions',
                'display_name' => 'Jadwal Dokter',
            ],
            [
                'name'         => 'manage_settings',
                'display_name' => 'Pengaturan',
            ],
            [
                'name'         => 'manage_services',
                'display_name' => 'Pelayanan',
            ],
            [
                'name'         => 'manage_treatments',
                'display_name' => 'Jasa',
            ],
            [
                'name'         => 'manage_pharmacies',
                'display_name' => 'Farmasi',
            ],
            [
                'name'         => 'manage_specialities',
                'display_name' => 'Spesialisasi',
            ],
            [
                'name'         => 'manage_countries',
                'display_name' => 'Negara',
            ],
            [
                'name'         => 'manage_states',
                'display_name' => 'Provinsi',
            ],
            [
                'name'         => 'manage_cities',
                'display_name' => 'Kabupaten',
            ],
            [
                'name'         => 'manage_roles',
                'display_name' => 'Peran',
            ],
            [
                'name'         => 'manage_currencies',
                'display_name' => 'Mata Uang',
            ],
            [
                'name'         => 'manage_admin_dashboard',
                'display_name' => 'Beranda',
            ],
            [
                'name'         => 'manage_front_cms',
                'display_name' => 'CMS',
            ],
            [
                'name'         => 'manage_transactions',
                'display_name' => 'Transaksi',
            ],
            [
                'name'         => 'manage_inventories',
                'display_name' => 'Gudang',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
