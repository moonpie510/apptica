<?php

namespace App\Repositories;

use App\Models\Application\Application;
use App\Models\Application\ApplicationTopHistory;
use App\Models\Country;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection as SupportCollection;

class ApplicationRepository
{
    public function getById(int $id): ?Application
    {
        return Application::query()->where('id', $id)->first();
    }

    public function getCategoriesPositions(Carbon $date): SupportCollection
    {
        return ApplicationTopHistory::query()
            ->where('date', $date->format('Y-m-d'))
            ->selectRaw('category_id, MIN(position) as position')
            ->groupBy('category_id')
            ->pluck('position', 'category_id');
    }

    public function saveHistory(SupportCollection $histories, Application $application, Country $country): void
    {
        foreach ($histories as $categoryId => $subCategories) {
            $data = [];

            foreach ($subCategories as $subCategoryId => $positions) {
                foreach ($positions as $date => $position) {
                    if ($position === null) {
                        continue;
                    }

                    $data[] = [
                        'application_id' => $application->id,
                        'country_id' => $country->id,
                        'category_id' => $categoryId,
                        'sub_category_id' => $subCategoryId,
                        'date' => $date,
                        'position' => $position,
                    ];
                }
            }

            ApplicationTopHistory::query()->upsert(
                $data,
                ['application_id', 'country_id', 'category_id', 'sub_category_id', 'date'],
                ['position']
            );
        }
    }
}
