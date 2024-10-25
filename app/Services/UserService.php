<?php

namespace App\Services;

use App\Models\User;
use App\Services\Contracts\UserServiceInterface;

/**
 * Class UserService
 *
 * @package App\Services
 * @author Lucas Reis
 * @link https://github.com/reislucaz
 * @date 2024-10-25 
 * @copyright Lucas Reis
 */
class UserService implements UserServiceInterface
{
    
    public function findUserById(int $id): ?User
    {
        return User::find($id);
    }
    
    public function retrieveAllUsers(int $pagination): iterable
    {
        return User::select('id', 'name', 'email', 'created_at')->paginate($pagination);
    }

    public function create(array $data): User
    {
        $data['password'] = bcrypt($data['password']);
        return User::create($data);
    }

    public function update(int $id, array $data): ?User
    {
        $user = User::find($id);

        if (!$user) {
            return null;
        }

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);
        return $user;
    }

    public function delete(int $id): bool
    {
        $user = User::find($id);

        if (!$user) {
            return false;
        }

        return $user->delete();
    }
}
