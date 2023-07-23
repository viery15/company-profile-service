<?php

namespace App\Http\Controllers;

use App\Domain\User\Services\UserService;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $user = $this->userService->create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'User created successfully.',
            'data' => $user,
        ], 201);
    }

    public function delete(string $id)
    {
        $this->userService->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully.',
        ], 200);
    }

    public function patch(string $id, Request $request)
    {
        $this->userService->patch($id, $request->all());

        return response()->json([], 204);
    }
}
