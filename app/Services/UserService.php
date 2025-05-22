<?php

namespace App\Services;

use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Illuminate\Database\QueryException;

class UserService {
    public function store(UserCreateRequest $request) {
        try {
            $data             = $request->validated();
            $data['password'] = bcrypt($data['password']);

            $user  = User::create($data);
            $token = auth()->login($user->fresh());

            return response()->json([
                'user'  => $user,
                'token' => $token,
            ]);
        } catch (QueryException $queryException) {
            if ($queryException->errorInfo[1] === 1062) {
                return response()->json(['message' => 'Email already exists.'], 409);
            }

            return response()->json(['message' => 'An error occurred while creating the user.'], 500);
        }
    }
}
