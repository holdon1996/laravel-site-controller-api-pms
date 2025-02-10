<?php

use Illuminate\Support\Facades\Route;
use ThachVd\LaravelSiteControllerApi\Controllers\Sc\TlLincolnController;

Route::prefix('/api/sc')->group(function () {
    Route::get('/health', function (){
        echo "ok";
    });
    Route::prefix('/tl-lincoln')->group(function() {
        Route::post('/empty-room', [TlLincolnController::class, 'getEmptyRoom'])->name('tllincoln-api.get-empty-room');
        Route::post('/bulk-empty-room', [TlLincolnController::class, 'getBulkEmptyRoom'])->name('tllincoln-api.get-bulk-empty-room');
        Route::post('/price-plan', [TlLincolnController::class, 'getPricePlan'])->name('tllincoln-api.get-price-plan');
        Route::post('/bulk-price-plan', [TlLincolnController::class, 'getBulkPricePlan'])->name('tllincoln-api.get-bulk-price-plan');
    });
});
