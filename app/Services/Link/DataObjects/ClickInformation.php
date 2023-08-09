<?php declare(strict_types=1);

namespace App\Services\Link\DataObjects;

use Illuminate\Http\Request;

class ClickInformation
{

    /**
     * @param string $ip
     * @param string $userAgent
     * @param string $referer
     */
    public function __construct(
        public string $ip,
        public string $userAgent,
        public string $referer,
    ) {}


    /**
     * @param Request $request
     * @return static
     */
    public static function fromRequest(Request $request)
    {
        return new static(
            $request->ip(),
            $request->userAgent(),
            $request->headers->get('referer', 'N/A'),
        );
    }
}
