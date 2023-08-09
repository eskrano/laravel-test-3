<?php

declare(strict_types=1);

namespace App\Services\Link\Contracts;

interface LinkContract
{
    public function getId(): int | string;

    public function getCode(): string;

    public function getTarget(): string;

    public function getLifetime(): \DateTimeInterface;

    public function getClickLimit(): int;

    public function getCreatedAt(): \DateTimeInterface;
}

