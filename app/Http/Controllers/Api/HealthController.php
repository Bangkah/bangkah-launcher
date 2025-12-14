<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HealthController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'status' => 'ok',
            'app' => config('app.name'),
            'time' => now()->toISOString(),
        ]);
    }
}
