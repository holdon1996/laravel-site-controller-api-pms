<?php

namespace ThachVd\LaravelSiteControllerApi\Console\Commands;

use ThachVd\LaravelSiteControllerApi\Services\Sc\TlLincoln\TlLincolnService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class MasterRoomTypeDiffFromTlLincoln extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:MasterRoomTypeDiffFromTlLincoln';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get master room type diff TL-Lincoln';
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
        Log::info("■■■ MasterRoomTypeDiffFromTlLincoln Start ■■■");
        $this->info("■■■ MasterRoomTypeDiffFromTlLincoln Start ■■■");
        $this->tlLincolnService->getMasterRoomTypeDiff();
        Log::info("■■■ MasterRoomTypeDiffFromTlLincoln End ■■■");
        $this->info("■■■ MasterRoomTypeDiffFromTlLincoln End ■■■");
    }
}
