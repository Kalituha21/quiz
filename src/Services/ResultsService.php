<?php


namespace Quiz\Services;


use Quiz\Models\AttemptModel;
use Quiz\Repositories\AttemptRepository;
use Quiz\Repositories\UserAnswersRepository;

class ResultsService
{
    /** @var UserAnswersRepository $userAnswersRepository */
    private $userAnswersRepository;

    /** @var AttemptRepository $attemptRepository */
    private $attemptRepository;

    public function __construct()
    {
        $this->userAnswersRepository = new UserAnswersRepository();
        $this->attemptRepository = new AttemptRepository();

    }

    /**
     * @param int $userId
     * @return AttemptModel[] $userAttemptData
     */
    public function getUserAttempts(int $userId)
    {
        $userAttemptData = [];
        $userAttempts = $this->attemptRepository->all(['user_id' => $userId]);
        foreach ($userAttempts as $userAttempt) {
            $userAttemptInAttemptModel = new AttemptModel();
            $userAttemptInAttemptModel->id = $userAttempt['id'];
            $userAttemptInAttemptModel->user_id = $userAttempt['user_id'];
            $userAttemptInAttemptModel->quiz_id = $userAttempt['quiz_id'];
            $userAttemptData[] = $userAttemptInAttemptModel;
        }

        return $userAttemptData;
    }
}