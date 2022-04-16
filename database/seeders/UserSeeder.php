<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        File::cleanDirectory(public_path('assets/img/profile'));
        File::copy(public_path('assets/img/default.png'), public_path('assets/img/profile/default.png'));
        
        $name = date('YmdHis');
        File::copy(public_path('assets/img/profile-5.jpeg'), public_path('assets/img/profile/' . $name . '.jpeg'));
        $user = User::create([
            'name' => 'Alfian',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin12345'),
            'phone' => '082324129752',
            'foto' => $name . '.jpeg',
        ]);
        $user->assignRole('admin');

        $name2 = date('Ymd');
        File::copy(public_path('assets/img/profile-6.jpeg'), public_path('assets/img/profile/' . $name2 . '.jpeg'));
        $user1 = User::create([
            'name' => 'Member',
            'email' => 'member@gmail.com',
            'password' => Hash::make('member12345'),
            'phone' => '082224086343',
            'foto' => $name2 . '.jpeg',
        ]);
        $user1->assignRole('member');
    }
}
