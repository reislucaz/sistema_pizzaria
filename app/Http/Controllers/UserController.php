<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\Request;


/**
 * Class UserController
 *
 * @package App\Http\Controllers
 * @author Vinícius Siqueira
 * @link https://github.com/ViniciusSCS
 * @date 2024-08-23 21:48:54
 * @copyright UniEVANGÉLICA
 */
class UserController extends Controller
{
    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers(10);

        return response()->json([
            'status' => 200,
            'message' => 'Usuários encontrados!',
            'data' => $users
        ], 200);
    }

    public function show(int $id)
    {
        $user = $this->userService->getUserById($id);

        if (!$user) {
            return response()->json(['status' => 404, 'message' => 'Usuário não encontrado!'], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Usuário encontrado com sucesso!',
            'data' => $user
        ], 200);
    }

    public function store(UserCreateRequest $request)
    {
        $user = $this->userService->createUser($request->validated());

        return response()->json([
            'status' => 201,
            'message' => 'Usuário cadastrado com sucesso!',
            'data' => $user
        ], 201);
    }

    public function update(UserUpdateRequest $request, int $id)
    {
        $user = $this->userService->updateUser($id, $request->validated());

        if (!$user) {
            return response()->json(['status' => 404, 'message' => 'Usuário não encontrado!'], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Usuário atualizado com sucesso!',
            'data' => $user
        ], 200);
    }

    public function destroy(int $id)
    {
        $deleted = $this->userService->deleteUser($id);

        if (!$deleted) {
            return response()->json(['status' => 404, 'message' => 'Usuário não encontrado!'], 404);
        }

        return response()->json(['status' => 200, 'message' => 'Usuário deletado com sucesso!'], 200);
    }
}