<?php

namespace ThachVd\LaravelSiteControllerApi\Console\Commands;

use ThachVd\LaravelSiteControllerApi\Services\Sc\TlLincoln\TlLincolnService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

/**
 *
 */
class PlanPriceFromTlLincoln extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:EmptyRoomFromTlLincoln';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get file csv plan price TL-Lincoln every 10 minutes';

    /**
     * @var TlLincolnService
     */
    protected $tlLincolnService;

    /**
     * @param TlLincolnService $tlLincolnService
     */
    public function __construct(TlLincolnService $tlLincolnService)
    {
        parent::__construct();
        $this->tlLincolnService = $tlLincolnService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info("■■■ EmptyRoomFromTlLincoln Start ■■■");
        $this->info("■■■ EmptyRoomFromTlLincoln Start ■■■");
        $this->tlLincolnService->getFileCsvPlanPrice();
        Log::info("■■■ EmptyRoomFromTlLincoln End ■■■");
        $this->info("■■■ EmptyRoomFromTlLincoln End ■■■");
    }
}
