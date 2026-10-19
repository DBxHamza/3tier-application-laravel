<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class StatusController extends Controller
{
    /** Reports which container answered and whether the data tier is reachable. */
    public function __invoke(): JsonResponse
    {
        $driver = config('database.default');
        $host = config("database.connections.{$driver}.host");

        try {
            DB::select('select 1');
            $up = true;
        } catch (\Throwable) {
            $up = false;
        }

        return response()->json([
            'app' => ['up' => true, 'hostname' => gethostname(), 'php' => PHP_VERSION],
            'database' => ['up' => $up, 'driver' => $driver, 'host' => $host],
        ]);
    }
}
