<?php

namespace App\Http\Controllers;

use App\Services\Store\ImageService;
use App\Services\Store\Services;

class BaseController extends Controller
{
    public function __construct(
        protected readonly Services $services,
        protected readonly ImageService $imageService
    ) {
    }
}
