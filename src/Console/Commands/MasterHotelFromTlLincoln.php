<?php

namespace ThachVd\LaravelSiteControllerApi\Console\Commands;

use ThachVd\LaravelSiteControllerApi\Services\Sc\TlLincoln\TlLincolnService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class MasterHotelFromTlLincoln extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:MasterHotelFromTlLincoln';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get master hotel TL-Lincoln';

    protected $tlLincolnService;

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
        Log::info("■■■ MasterHotelFromTlLincoln Start ■■■");
        $this->info("■■■ MasterHotelFromTlLincoln Start ■■■");
        $this->tlLincolnService->getMasterHotel();
        Log::info("■■■ MasterHotelFromTlLincoln End ■■■");
        $this->info("■■■ MasterHotelFromTlLincoln End ■■■");
    }
}
