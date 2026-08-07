<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\InstagramService;

class WidinstaController extends Controller
{
    public function index(InstagramService $instagramService)
    {
        return response()->json(
            $instagramService->getInstagramData()
        );
    }
}
