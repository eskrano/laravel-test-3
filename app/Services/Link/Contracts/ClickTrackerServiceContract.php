<?php declare(strict_types=1);

namespace App\Services\Link\Contracts;

use App\Services\Link\DataObjects\ClickInformation;

interface ClickTrackerServiceContract
{
    public function track(LinkContract $link, ClickInformation $information): void;
}
