<?php

namespace ThachVd\LaravelSiteControllerApi;

use Illuminate\Support\ServiceProvider;
use ThachVd\LaravelSiteControllerApi\Console\Commands\ScApiGenerateModels;

class SiteControllerApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->mergeConfigFrom(
            __DIR__ . '/configs/sc.php', 'sc'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        $this->loadRoutesFrom(__DIR__ . '/routes/sc.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        // publish migration
        $this->publishes([
            __DIR__.'/database/migrations/' => database_path('migrations'),
        ], 'sc-api-migrations');

        // publish config
        $this->publishes([
            __DIR__ . '/configs/sc.php' => config_path('sc.php'),
        ], 'sc-api-configs');

        //// publish model
        //$publishedModelPaths = [
        //    __DIR__.'/Models/ScApiLog.php' => app_path('Models/ScApiLog.php'),
        //    __DIR__.'/Models/ScTlLincolnSoapApiLog.php' => app_path('Models/ScTlLincolnSoapApiLog.php'),
        //];
        //foreach ($publishedModelPaths as $packageModelPath => $publishedModelsPath) {
        //    if (!file_exists($publishedModelsPath)) {
        //        $this->publishes([
        //            $packageModelPath => $publishedModelsPath,
        //        ], 'sc-api-models');
        //    }
        //}
        //
        //// publish routes
        //$publishedRoutesPath = base_path('routes/sc.php');
        //if (!file_exists($publishedRoutesPath)) {
        //    $this->publishes([
        //        __DIR__ . '/routes/sc.php' => base_path('routes/sc.php'),
        //    ], 'sc-api-routes');
        //}
        //
        //// publish controllers
        //$publishedControllersPath = app_path('Http/Controllers/Sc/TlLincolnController.php');
        //if (!file_exists($publishedControllersPath)) {
        //    $this->publishes([
        //        __DIR__ . '/Controllers/Sc' => app_path('Http/Controllers/Sc'),
        //    ], 'sc-api-controllers');
        //}
        //
        //// publish services
        //$publishedServicesPath = app_path('Services/Sc');
        //if (!file_exists($publishedServicesPath)) {
        //    $this->publishes([
        //        __DIR__ . '/Services/Sc' => app_path('Services/Sc'),
        //    ], 'sc-api-services');
        //}

        // load routes
        //if (file_exists($publishedRoutesPath)) {
        //    echo "load routes from $publishedRoutesPath\n";
        //    $this->loadRoutesFrom($publishedRoutesPath);
        //}
        //
        //$this->commands([
        //    ScApiGenerateModels::class,
        //]);
    }
}
