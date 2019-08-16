<?php

namespace Quiz\Repositories;

use Quiz\Models\UserModel;

/**
 * @method UserModel|null one(array $conditions = [])
 * @method UserModel[] all(array $conditions = [])
 * @method UserModel create(array $data) : Model
 */
class UserRepository extends BaseRepository
{
    protected function getModelClass()
    {
        return UserModel::class;
    }

    public function userExist(array $conditions = []): bool
    {
        return UserModel::query()->where($conditions)->exists();
    }

}