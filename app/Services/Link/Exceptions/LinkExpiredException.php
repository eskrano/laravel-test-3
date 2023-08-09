<?php declare(strict_types=1);

namespace App\Services\Link\Exceptions;

class LinkExpiredException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Link has expired.');
    }
}
