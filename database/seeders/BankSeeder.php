<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Bank::create([
            'name' => 'BRI',
            'acc_name' => 'Alfian Setiawan',
            'acc_number' => '583901018105535',
            'desc' => 'OK'
        ]);

        Bank::create([
            'name' => 'BNI',
            'acc_name' => 'Alfian Setiawan',
            'acc_number' => '5839535',
            'desc' => ''
        ]);
    }
}
