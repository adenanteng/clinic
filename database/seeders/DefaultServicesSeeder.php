<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Setting;
use App\Models\Specialization;
use Illuminate\Database\Seeder;

class DefaultServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
            [
                'category_id'       => '1',
                'name'              => 'Poli Umum',
//                'charges'           => '50000',
                'status'            => Service::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon'              => asset('assets/front/images/services_images/Diagnostics.png'),
            ],
            [
                'category_id'       => '1',
                'name'              => 'Poli Gigi',
//                'charges'           => '50000',
                'status'            => Service::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon'              => asset('assets/front/images/services_images/Treatment.png'),
            ],
            [
                'category_id'       => '1',
                'name'              => 'Poli Mata',
//                'charges'           => '50000',
                'status'            => Service::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon'              => asset('assets/front/images/services_images/Surgery.png'),
            ],
            [
                'category_id'       => '1',
                'name'              => 'KIA',
//                'charges'           => '50000',
                'status'            => Service::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon'              => asset('assets/front/images/services_images/Emergency.png'),
            ],
            [
                'category_id'       => '4',
                'name'              => 'Vaksin Covid-19',
//                'charges'           => '50000',
                'status'            => Service::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon'              => asset('assets/front/images/services_images/Vaccine.png'),
            ],
        ];

        $doctor = Doctor::firstOrfail();

        foreach ($input as $data) {
            $image = $data['icon'];
            unset($data['icon']);
            $service = Service::create($data);
            $service->serviceDoctors()->sync($doctor->id);
//            $service->addMediaFromUrl($image)->toMediaCollection(Service::ICON, config('app.media_disc'));
        }
    }
}
