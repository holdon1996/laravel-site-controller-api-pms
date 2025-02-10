<?php

namespace ThachVd\LaravelSiteControllerApi\Console\Commands;

use App\Services\Sc\TlLincoln\TlLincolnService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

/**
 *
 */
class EmptyRoomFromTlLincoln extends Command
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
    protected $description = 'Get file csv empty room TL-Lincoln every 10 minutes';

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
     * @throws GuzzleException
     */
    public function handle()
    {
        Log::info("■■■ EmptyRoomFromTlLincoln Start ■■■");
        $this->info("■■■ EmptyRoomFromTlLincoln Start ■■■");
        $this->tlLincolnService->getFileCsvEmptyRoom();
        Log::info("■■■ EmptyRoomFromTlLincoln End ■■■");
        $this->info("■■■ EmptyRoomFromTlLincoln End ■■■");
    }
}
