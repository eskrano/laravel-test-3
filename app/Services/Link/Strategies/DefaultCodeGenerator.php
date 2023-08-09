<?php declare(strict_types=1);

namespace App\Services\Link\Strategies;

use App\Services\Link\Contracts\CodeGeneratorStrategyContract;
use Illuminate\Support\Str;

class DefaultCodeGenerator implements CodeGeneratorStrategyContract
{
    /**
     * @return string
     */
    public function generate(): string
    {
        return Str::random(8);
    }
}
