<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class Roleseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'super-admin', 'guard_name' => 'web'],
            ['name' => 'publisher', 'guard_name' => 'web'],
            ['name' => 'cover-patner', 'guard_name' => 'web'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
