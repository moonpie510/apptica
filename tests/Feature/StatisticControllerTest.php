<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Application\Application;
use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class StatisticControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_app_top_category_success(): void
    {
        Country::query()->create([
            'external_id' => 1,
            'title' => 'United States',
        ]);

        Application::query()->create([
            'external_id' => 1421444,
            'title' => 'Among Us',
        ]);

        Artisan::call('apptica:upload-data');

        $date = Carbon::now()->subDays(3)->format('Y-m-d');

        $response = $this->get("/api/appTopCategory?date=$date");

        $response->assertJson([ "status_code" => 200]);
    }

    public function test_get_app_top_category_error(): void
    {
        Country::query()->create([
            'id' => 1,
            'external_id' => 1,
            'title' => 'United States',
        ]);

        Application::query()->create([
            'id' => 1,
            'external_id' => 1421444,
            'title' => 'Among Us',
        ]);

        Artisan::call('apptica:upload-data');

        $date = Carbon::now()->subDays(3)->format('Y/m/d');

        $response = $this->get("/api/appTopCategory?date=$date");

        $response->assertJson([
            "status_code" => 400,
            'error' => [
                'date' => [
                    'Неверный формат даты, пример: 2025-09-28'
                ]
            ]
        ]);
    }
}
