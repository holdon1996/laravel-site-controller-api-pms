<?php

namespace ThachVd\LaravelSiteControllerApi\Console\Commands;

use ThachVd\LaravelSiteControllerApi\Services\Sc\TlLincoln\TlLincolnService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class MasterPlanDiffFromTlLincoln extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:MasterPlanFromTlLincoln';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get master plan diff TL-Lincoln';

    private TlLincolnService $tlLincolnService;

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
        Log::info("■■■ MasterPlanFromTlLincoln Start ■■■");
        $this->info("■■■ MasterPlanFromTlLincoln Start ■■■");
        $this->tlLincolnService->getMasterPlanDiff();
        Log::info("■■■ MasterPlanFromTlLincoln End ■■■");
        $this->info("■■■ MasterPlanFromTlLincoln End ■■■");
    }
}
