<?php declare(strict_types=1);

namespace App\Services\Link\ClickTrackerDrivers;

use App\Models\Link;
use App\Services\Link\Contracts\LinkContract;
use App\Services\Link\DataObjects\ClickInformation;
use App\Services\Link\Contracts\ClickTrackerServiceContract;

class DatabaseClickTracker implements ClickTrackerServiceContract
{

        /**
        * @param string $code
        * @param ClickInformation $information
        */
        public function track(LinkContract $link, ClickInformation $information): void
        {
            $link->clicks()->create([
                'ip' => $information->ip,
                'user_agent' => $information->userAgent,
                'referer' => $information->referer,
            ]);
        }
}
