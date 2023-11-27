<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class Bankseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = [
            ['nama' => 'BRI'],
            ['nama' => 'BCA'],
            ['nama' => 'MANDIRI'],
            // ... tambahkan bank lainnya sesuai kebutuhan
        ];

        foreach ($banks as $bank) {
            Bank::create($bank);
        }

    }
}
