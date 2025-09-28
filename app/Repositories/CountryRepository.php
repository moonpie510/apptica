<?php

namespace App\Repositories;

use App\Models\Country;

class CountryRepository
{
    public function getById(int $id): ?Country
    {
        return Country::query()->where('id', $id)->first();
    }
}
