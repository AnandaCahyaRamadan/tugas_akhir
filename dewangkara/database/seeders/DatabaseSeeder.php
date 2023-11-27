<?php

namespace Database\Seeders;

use Database\Seeders\Bankseeder;
use Database\Seeders\Roleseeder;
use Database\Seeders\Userseeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(Bankseeder::class);
        $this->call(Roleseeder::class);
        $this->call(Userseeder::class);

    }
}
