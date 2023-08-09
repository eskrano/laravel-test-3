<?php

declare(strict_types=1);

namespace App\Services\Link\Contracts;

interface LinkServiceContract
{
    /**
     * @param array $data
     * @return LinkContract
     */
    public function create(array $data): LinkContract;

    /**
     * @param string $code
     * @return LinkContract
     */
    public function resolve(string $code): LinkContract;
}
