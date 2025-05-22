<?php

namespace App\Http\Controllers;

use App\Services\FavoriteService;
use Illuminate\Http\Request;

class FavoriteController extends Controller {
    public $favoriteService;

    public function __construct(FavoriteService $favoriteService) {
        $this->favoriteService = $favoriteService;
    }

    public function index(Request $request) {
        return $this->favoriteService->index($request);
    }

    public function toggleFavorite(Request $request, string $id) {
        return $this->favoriteService->toggleFavorite($request, $id);
    }
}
