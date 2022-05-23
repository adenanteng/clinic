<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DefaultSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inputs = [
            [
                'title'             => 'Lindungi & jaga kesehatan anda',
                'short_description' => 'Kami menyediakan solusi perawatan kesehatan untuk anda',
                'image'             => asset('assets/front/images/home/home-page-image.png'),
                'is_default'        => true,
            ],
        ];

        foreach ($inputs as $input) {
            $image = $input['image'];
            unset($input['image']);
            $slider = Slider::create($input);
//            $slider->addMediaFromUrl($image)->toMediaCollection(Slider::SLIDER_IMAGE, config('app.media_disc'));
        }
    }
}
