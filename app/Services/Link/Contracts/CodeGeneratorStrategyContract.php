<?php declare(strict_types=1);

namespace App\Services\Link\Contracts;

interface CodeGeneratorStrategyContract
{
    public function generate(): string;
}
