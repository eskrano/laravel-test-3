<?php

namespace App\Providers;

use App\Services\Link\Contracts\ClickTrackerServiceContract;
use App\Services\Link\Contracts\CodeGeneratorStrategyContract;
use App\Services\Link\Contracts\LinkServiceContract;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerLinkService();
    }

    /**
     * @return void
     */
    private function registerLinkService(): void
    {
        $this->app->bind(
            LinkServiceContract::class,
            function () {
                $services = config('links.services');
                $currentService = config('links.current_service');

                if (!isset($services[$currentService])) {
                    throw new \InvalidArgumentException('Invalid link service');
                }

                return new $services[$currentService];
            }
        );

        $this->app->bind(
            CodeGeneratorStrategyContract::class,
            function () {
                $strategies = config('links.code_generator_strategies');
                $currentStrategy = config('links.code_generator_strategy');

                if (!isset($strategies[$currentStrategy])) {
                    throw new \InvalidArgumentException('Invalid code generator strategy');
                }

                return new $strategies[$currentStrategy];
            }
        );

        // register click tracking

        $this->app->bind(
            ClickTrackerServiceContract::class,
            function () {
                $services = config('links.click_trackers');
                $currentService = config('links.click_tracker');

                if (!isset($services[$currentService])) {
                    throw new \InvalidArgumentException('Invalid click tracker service');
                }

                return new $services[$currentService];
            }
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
