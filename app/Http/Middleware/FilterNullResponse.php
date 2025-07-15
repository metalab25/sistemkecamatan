<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use App\Helpers\ArrayHelper;

class FilterNullResponse
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($response instanceof JsonResponse) {
            $originalData = $response->getData(true);
            $filteredData = ArrayHelper::filterRecursive($originalData);
            $response->setData($filteredData);
        }

        return $response;
    }
}
