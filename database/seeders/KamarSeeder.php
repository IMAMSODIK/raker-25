<?php

namespace Database\Seeders;

use App\Models\Kamar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kamar::create([
            'no_kamar' => '1'
        ]);

        Kamar::create([
            'no_kamar' => '2'
        ]);
    }
}
