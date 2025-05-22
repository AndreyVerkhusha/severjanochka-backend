<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Services\UserService;

class UserController extends Controller {
    public $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function store(UserCreateRequest $request) {
        return $this->userService->store($request);
    }
}
