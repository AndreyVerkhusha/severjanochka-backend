<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class AuthController extends Controller {
    protected $authService;

    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    public function login(FormRequest $request): JsonResponse {
        return $this->authService->login($request);
    }

    public function logout() {
        return $this->authService->logout();
    }

    public function me(): JsonResponse {
        return $this->authService->me();
    }
}
