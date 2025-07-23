<?php

namespace Database\Seeders;

use App\Models\Capsule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CapsuleSeeder extends Seeder
{
    public function run(): void {
        Capsule::factory(20)->create();
    }
}