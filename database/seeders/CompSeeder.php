<?php

namespace Database\Seeders;

use App\Models\Comp;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CompSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        File::cleanDirectory(public_path('assets/img/logo'));
        File::copy(public_path('assets/img/megadata/mega_11_white.png'), public_path('assets/img/logo/logo.png'));
        Comp::create([
            'name' => 'MEGADATA',
            'phone' => '086969696',
            'address' => 'JL. Kampung Pasar Kembang, Yogyakarta',
            'logo' => 'logo.png',
        ]);
    }
}
