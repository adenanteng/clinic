<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DefaultRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'clinic_admin',
                'display_name' => 'Admin',
                'is_default' => true,
            ],
            [
                'name' => 'doctor',
                'display_name' => 'Doctor',
                'is_default' => false,
            ],
            [
                'name' => 'patient',
                'display_name' => 'Patient',
                'is_default' => false,
            ],
        ];
        foreach ($roles as $role) {
            Role::create($role);
        }

        /** @var Role $adminRole */
        $adminRole = Role::whereName('clinic_admin')->first();
        /** @var Role $doctorRole */
        $doctorRole = Role::whereName('doctor')->first();
        /** @var Role $patientRole */
        $patientRole = Role::whereName('patient')->first();

        /** @var User $user */
        $user = User::whereEmail('admin@clinic.com')->first();
        /** @var Doctor $doctor */
        $doctor = User::whereEmail('doctor@clinic.com')->first();
        /** @var Patient $patient */
        $patient = User::whereEmail('patient@clinic.com')->first();

        $allPermission = Permission::pluck('name', 'id');

        $adminRole->givePermissionTo($allPermission);
        $doctorRole->givePermissionTo($allPermission);
        $patientRole->givePermissionTo($allPermission);

        if ($user) {
            $user->assignRole($adminRole);
        }
        if ($doctor) {
            $doctor->assignRole($doctorRole);
        }
        if ($patient) {
            $patient->assignRole($patientRole);
        }

//        /** @var Role $adminRole */
//        $adminRole = Role::whereName('clinic_admin')->first();
//
//        /** @var User $user */
//        $user = User::whereEmail('admin@clinic.com')->first();
//
//        $allPermission = Permission::pluck('name', 'id');
//        $adminRole->givePermissionTo($allPermission);
//        if ($user) {
//            $user->assignRole($adminRole);
//        }
//
//        $doctorRole = Role::whereName('doctor')->first();
//        $doctor = User::whereEmail('doctor@clinic.com')->first();
//        if ($doctor) {
//            $doctor->assignRole($doctorRole);
//        }
//
//
//        $patientRole = Role::whereName('patient')->first();
//        $doctor = User::whereEmail('patient@clinic.com')->first();
//        if ($doctor) {
//            $doctor->assignRole($patientRole);
//        }
    }
}
