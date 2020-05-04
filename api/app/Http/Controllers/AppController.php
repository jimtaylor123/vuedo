<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class AppController extends Controller
{
     /**
     * Returns the api version number - the front page...
     *
     * @return JsonResponse
     */
    public function version(): JsonResponse
    {
        return response()->json([
            'name' => 'axis todo',
            'version' => '1.0.0'
        ]);
    }

    /**
     * Redirect users from raw domain to /api
     *
     * @return RedirectResponse
     */
    public function web() : RedirectResponse
    {
        return redirect('api');
    }
}
