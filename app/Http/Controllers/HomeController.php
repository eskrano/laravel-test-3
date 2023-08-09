<?php

namespace App\Http\Controllers;

use App\Http\Requests\Link\Create;
use App\Models\Link;
use App\Services\Link\Contracts\ClickTrackerServiceContract;
use App\Services\Link\Contracts\CodeGeneratorStrategyContract;
use App\Services\Link\Contracts\LinkServiceContract;
use App\Services\Link\DataObjects\ClickInformation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        return view('home');
    }

    /**
     * @param Create $request
     * @param LinkServiceContract $linkService
     * @param CodeGeneratorStrategyContract $codeGeneratorService
     * @return View
     */
    public function store(Create                        $request,
                          LinkServiceContract           $linkService,
                          CodeGeneratorStrategyContract $codeGeneratorService
    ): View
    {

        $hours = $request->post('lifetime', 1);
        $wholeHours = floor($hours);
        $minutes = ($hours - $wholeHours) * 60;

        $time = Carbon::createFromTime($wholeHours, $minutes, 0);
        $formattedTime = $time->format('H:i:s');

        $link = $linkService->create(array_merge($request->validated(), [
            'code' => $codeGeneratorService->generate(),
            'lifetime' => $formattedTime,
        ]));

        return view('link_created', compact('link'));
    }

    /**
     * @param string $code
     * @param LinkServiceContract $linkService
     * @param ClickTrackerServiceContract $clickTrackerService
     * @return RedirectResponse
     */
    public function redirect(
        string                      $code,
        LinkServiceContract         $linkService,
        ClickTrackerServiceContract $clickTrackerService
    ): RedirectResponse
    {
        $link = $linkService->resolve($code);
        $clickTrackerService->track(
            $link,
            ClickInformation::fromRequest(request())
        );

        return redirect($link->getTarget());
    }

    /**
     * @param string $code
     * @return View
     */
    public function stats(string $code): View
    {
        $link = Link::where('code', $code)->firstOrFail();
        $clicks = $link->clicks()->orderBy('id','desc')->paginate(20);
        return view('stats', compact('link', 'clicks'));
    }
}
