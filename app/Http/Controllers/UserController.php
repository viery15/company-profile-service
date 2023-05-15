<?php

namespace App\Http\Controllers;

use App\Domain\User\Services\UserService;
use App\Http\Requests\CreateUserRequest;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function findAll()
    {
        $result = $this->userService->findAll();

        return response()->json([
            'success' => true,
            'data' => $result,
        ], 200);
    }

    public function store(CreateUserRequest $request)
    {
        $user = $this->userService->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'User created successfully.',
            'data' => $user,
        ], 201);
    }
}
