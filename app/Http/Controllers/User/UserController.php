<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserCreateRequest;
use App\Services\User\UserService;

class UserController extends Controller {
    public $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function store(UserCreateRequest $request) {
        return $this->userService->store($request);
    }
}
