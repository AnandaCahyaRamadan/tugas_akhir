<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'nama' => 'Super Admin',
                // 'kota' => 1172,
                'alamat_ktp' => 'Genteng',
                'email' => 'admin@dewangkara.com',
                'password' => Hash::make('1234512345'),
                'no_wa' => '085336448009',
                'email_verified_at' => now(),
            ],
            //pw = Yogicukma257
            [
                'nama' => 'Damar Langit',
                // 'kota' => 1172,
                'alamat_ktp' => 'sumbersari',
                'email' => 'publisher.musik.indonesia@gmail.com',
                'password' => Hash::make('12345678'),
                'no_wa' => '082231018918',
                'email_verified_at' => now(),
            ],
            //pw =
            [
                'nama' => 'cover',
                'nik' => '1234567891234569',
                // 'kota' => 1172,
                'alamat_ktp' => 'sumbersari',
                'email' => 'anandacahya.com@gmail.com',
                'password' => Hash::make('12345678'),
                'no_wa' => '082231018910',
                'bank_id' => 1,
                'no_rekening' => '1323449',
                'foto_ktp' => '/dps/foto/fsfsvvwc.jpg',
                'email_verified_at' => now(),
            ],
        ];

        $roles = [
            'super-admin',
            'publisher',
            'cover-patner',
        ];

        foreach ($users as $key => $user) {
            $create = User::create($user);
            $create->assignRole($roles[$key]);
        }

    }
}
