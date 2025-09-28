<?php

namespace Database\Seeders;

use App\Models\Application\Application;
use App\Models\Country;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Country::query()->create([
            'external_id' => 1,
            'title' => 'United States',
        ]);

        Application::query()->create([
            'external_id' => 1421444,
            'title' => 'Among Us',
        ]);
    }
}
