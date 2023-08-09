<?php

return [
    /**
     * Current link service
     */
    'current_service' => env('CURRENT_SERVICE', 'database'),


    /**
     * List of available link services
     */
    'services' => [
        'database' => \App\Services\Link\Drivers\DatabaseLinkService::class,
    ],


    'code_generator_strategy' => env('CODE_GENERATOR_STRATEGY', 'default'),

    'code_generator_strategies' => [
        'default' => \App\Services\Link\Strategies\DefaultCodeGenerator::class,
    ],


    /**
     * Click tracking
     */

    'click_tracker' => env('CLICK_TRACKER', 'database'),

    'click_trackers' => [
        'database' => \App\Services\Link\ClickTrackerDrivers\DatabaseClickTracker::class,
    ]
];
