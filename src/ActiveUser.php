<?php


namespace Quiz;


use Quiz\Models\AttemptModel;
use Quiz\Models\UserModel;
use Quiz\Services\ResultsService;

class ActiveUser
{
    public static function isLoggedIn(): bool
    {
        return !is_null(Session::getInstance()->getLoggedInUserId());
    }

    public static function getLoggedInUser(): ?UserModel
    {
        $userId = Session::getInstance()->getLoggedInUserId();

        /** @var UserModel $user */
        $user = UserModel::query()->where(['id' => $userId])->first();

        return $user;
    }

    /** @return AttemptModel[] $attempts */
    public static function getResults()
    {

        $userId = Session::getInstance()->getLoggedInUserId();
        $resultsService = new ResultsService();
        $attempts = $resultsService->getUserAttempts($userId);

        return $attempts;
    }

}