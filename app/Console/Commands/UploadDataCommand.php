<?php

namespace App\Console\Commands;

use App\Models\Application\ApplicationTopHistory;
use App\Repositories\ApplicationRepository;
use App\Repositories\AppticaRepository;
use App\Repositories\CountryRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class UploadDataCommand extends Command
{
    protected $signature = 'apptica:upload-data';
    protected $description = 'Сбор и сохранение prepared данных для endpoint-а';

    public function __construct(
        private readonly AppticaRepository $appticaRepository,
        private readonly ApplicationRepository $applications,
        private readonly CountryRepository $countries,
    )
    {
        parent::__construct();
    }

    public function handle(): void
    {
        // Если таблица с историей не заполнена, то берем все данные, иначе берем данные за вчера и позавчера
        if (ApplicationTopHistory::query()->count() === 0) {
            $dateFrom = null;
            $dateTo = null;
        } else {
            $dateFrom = Carbon::now()->subDays(2);
            $dateTo = Carbon::now()->subDays(1);
        }

        $application = $this->applications->getById(1);
        $country = $this->countries->getById(1);

        $histories = $this->appticaRepository->getTopHistory($application, $country, $dateFrom, $dateTo);
        $this->applications->saveHistory($histories, $application, $country);
    }
}
