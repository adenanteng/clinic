<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DefaultStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
            'first_name'        => 'Chintia',
            'last_name'         => 'Dewi',
            'contact'           => '1234567890',
            'gender'            => User::FEMALE,
            'type'              => User::STAFF,
            'email'             => 'nurse@clinically.com',
            'email_verified_at' => Carbon::now(),
            'password'          => Hash::make('123456'),
            'region_code'       => '62',
        ];

        $user = User::create($input);

        /** @var Role $staffRole */
        $staffRole = Role::create(['name' => 'nurse', 'display_name' => 'Perawat']);
        $user->assignRole($staffRole);

        /** @var Permission $allPermission */
        $allPermission = Permission::pluck('id');
        $staffRole->givePermissionTo($allPermission);

    }
}
