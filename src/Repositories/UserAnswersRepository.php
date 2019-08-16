<?php


namespace Quiz\Repositories;


use Quiz\Models\UserAnswersModel;

class UserAnswersRepository extends BaseRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return UserAnswersModel::class;
    }
}