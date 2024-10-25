<?php

namespace App\Services\Contracts;

use App\Models\User;

/**
 * Interface UserServiceInterface
 *
 * @package App\Services\Contracts
 * @author Lucas Reis
 * @link https://github.com/reislucaz
 * @date 2024-10-25 
 * @copyright Lucas Reis
 */
interface UserServiceInterface
{
    public function create(array $data): User;
    public function findUserById(int $id): ?User;
    public function retrieveAllUsers(int $pagination): iterable;
    public function update(int $id, array $data): ?User;
    public function delete(int $id): bool;
}
