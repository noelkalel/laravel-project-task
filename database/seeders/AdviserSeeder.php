<?php

namespace Database\Seeders;

use App\Models\Adviser;
use Illuminate\Database\Seeder;

class AdviserSeeder extends Seeder
{
    public function run()
    {
        $adviserOne = Adviser::create([
            'first_name' => 'test',
            'last_name'  => 'test',
            'email'      => 'test@test.com',
            'password'   => bcrypt('1111'),
        ]);

        $adviserTwo = Adviser::create([
            'first_name' => 'demo',
            'last_name'  => 'demo',
            'email'      => 'demo@demo.com',
            'password'   => bcrypt('1111'),
        ]);
    }
}
