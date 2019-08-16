<?php

interface UserRepositoryInterface
{
    public function save(UserModel $user): UserModel;

    public function exists(string $name): bool;

    /**
     * @return UserModel[]
     */
    public function get(): array;
}