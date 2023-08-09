<?php

declare(strict_types=1);

namespace App\Services\Link\Drivers;

use App\Models\Link;
use App\Services\Link\Contracts\LinkContract;
use App\Services\Link\Contracts\LinkServiceContract;
use App\Services\Link\Exceptions\LinkExpiredException;
use Carbon\Carbon;

class DatabaseLinkService implements LinkServiceContract
{
    /**
     * @param array $data
     * @return LinkContract
     */
    public function create(array $data): LinkContract
    {
        $link = Link::create([
            'url' => $data['url'],
            'code' => $data['code'],
            'lifetime' => $data['lifetime'],
            'click_limit' => $data['click_limit'],
        ]);

        return $link;
    }

    /**
     * @param string $code
     * @return LinkContract
     * @throws LinkExpiredException
     */
    public function resolve(string $code): LinkContract
    {
        $link = Link::where('code', $code)->firstOrFail();
        $createdAt = $link->created_at;

        $available = $createdAt->copy()->addHours($link->lifetime->hour);

        if (now()->greaterThan($available)) {
            throw new LinkExpiredException();
        }

        if ($link->click_limit > 0 && $link->clicks()->count() >= $link->click_limit) {
            throw new LinkExpiredException();
        }

        return $link;
    }
}
