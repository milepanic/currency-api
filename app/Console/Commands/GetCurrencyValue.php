<?php

namespace App\Console\Commands;

use App\Services\CurrencyService;
use App\Services\RequestService;
use Illuminate\Console\Command;

class GetCurrencyValue extends Command
{
    private $requestService;
    private $currencyService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:get {date?} {--force}';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(RequestService $requestService, CurrencyService $currencyService)
    {
        parent::__construct();

        $this->requestService = $requestService;
        $this->currencyService = $currencyService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = $this->argument('date');
        if (! $date) {
            $date = date('Y-m-d');
        }

        $result = $this->requestService->makeRequest($date);

        $this->currencyService->saveValues($result, $date, $this->option('force'));
    }
}
