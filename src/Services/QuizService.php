<?php

namespace Quiz\Services;


use Exception;
use Quiz\Exceptions\QuizException;
use Quiz\Models\AnswerModel;
use Quiz\Models\QuestionModel;
use Quiz\Models\QuizModel;
use Quiz\Repositories\AnswerRepository;
use Quiz\Repositories\AttemptRepository;
use Quiz\Repositories\QuestionRepository;
use Quiz\Repositories\QuizRepository;
use Quiz\Repositories\UserAnswersRepository;
use Quiz\Repositories\UserRepository;
use Quiz\Session;

class QuizService
{
    private const SESSION_KEY_CURRENT_ATTEMPT_ID = 'currentAttemptId';
    private const SESSION_KEY_QUESTIONS_ANSWERED = 'questionsAnswered';

    /** @var QuizRepository $quizRepository */
    private $quizRepository;

    /** @var UserRepository $userRepository */
    private $userRepository;

    /** @var QuestionRepository $questionRepository */
    private $questionRepository;

    /** @var AnswerRepository $answerRepository */
    private $answerRepository;

    /** @var UserAnswersRepository $userAnswersRepository */
    private $userAnswersRepository;

    /** @var AttemptRepository $attemptRepository */
    private $attemptRepository;

    /** @var Session $session */
    private $session;


    public function __construct(QuizRepository $repository = null,
            UserRepository $userRepository = null,
            QuestionRepository $questionRepository = null,
            AnswerRepository $answerRepository = null,
            UserAnswersRepository $userAnswersRepository = null,
            AttemptRepository $attemptRepository = null,
            Session $session = null)
    {
        $this->quizRepository = $repository ?: new QuizRepository();
        $this->userRepository = $userRepository ?: new UserRepository();
        $this->questionRepository = $questionRepository ?: new QuestionRepository();
        $this->answerRepository = $answerRepository ?: new AnswerRepository();
        $this->userAnswersRepository = $userAnswersRepository ?: new UserAnswersRepository();
        $this->attemptRepository = $attemptRepository ?: new AttemptRepository();
        $this->session = $session ?: Session::getInstance();
    }

    public function getQuizRpcData()
    {
        $quizzes = $this->quizRepository->all();

        $quizData = [];

        foreach ($quizzes as $quiz) {
            $questionCount = $this->questionRepository->count(['quiz_id' => $quiz->id]);

            $quizData[] = [
                'id' => $quiz->id,
                'title' => $quiz->title,
                'questionCount' => $questionCount,
            ];
        }

        return $quizData;
    }

    /**
     * @param int $userId
     * @param int $quizId
     * @return QuizModel
     * @throws \Exception
     */
    public function start(int $userId, int $quizId)
    {
        $userExists = $this->userRepository->userExist(['id' => $userId]);

        if(!$userExists) {
            throw new QuizException('Unknown user');
        }

        $quiz = $this->getQuizById($quizId);

        $attempt = $this->attemptRepository->create([
            'user_id' => $userId,
            'quiz_id' => $quizId,
        ]);

        $this->session->set(self::SESSION_KEY_CURRENT_ATTEMPT_ID, $attempt->id);
        $this->session->set(self::SESSION_KEY_QUESTIONS_ANSWERED, 0);

        return $quiz;
    }

    public function getNextQuestion()
    {
        $attemptId = $this->session->get(self::SESSION_KEY_CURRENT_ATTEMPT_ID);
        $attempt = $this->getAttemptById($attemptId);

        $questionsAnswered = $this->session->get(self::SESSION_KEY_QUESTIONS_ANSWERED, -1);
        if ($questionsAnswered < 0) {
            throw new QuizException('Questions answered not set');
        }

        $question = $this->questionRepository->getQuestionByQuizIdAndOffset($attempt->quiz_id, $questionsAnswered);

        return $question;
    }


    /**
     * @param QuestionModel $question
     */
    public function getQuestionRpcData(QuestionModel $question)
    {
        $answerData = [];

        foreach ($question->answers as $answer) {
            $answerData[] = $this->getAnswerRpcData($answer);
        }

        return [
            'id' => $question->id,
            'text' => $question->text,
            'answers' => $answerData
        ];
    }

    public function getAnswerRpcData(AnswerModel $answer)
    {
        return [
            'id' => $answer->id,
            'text' => $answer->text,
        ];
    }

    /**
     * @param int $quizId
     * @return QuizModel|null
     * @throws Exception
     */
    public function getQuizById(int $quizId)
    {
        $quiz = $this->quizRepository->one(['id' => $quizId]);

        if (!$quiz) {
            throw new QuizException("Could not find quiz #$quizId");
        }

        return $quiz;
    }

    public function saveAnswer($answerId)
    {
        $answer = $this->answerRepository->one(['id' => $answerId]);

        if (!$answer) {
            throw new QuizException("Answer #$answer not found");
        }

        $currentAttemptId = $this->session->get(self::SESSION_KEY_CURRENT_ATTEMPT_ID);
        $attempt = $this->getAttemptById($currentAttemptId);

        $this->userAnswersRepository->create([
            'attempt_id' => $attempt->id,
            'question_id' => $answer->question_id,
            'answer_id' => $answer->id,
        ]);

        $questionsAnswered = $this->session->get(self::SESSION_KEY_QUESTIONS_ANSWERED);
        $questionsAnswered++;
        $this->session->set(self::SESSION_KEY_QUESTIONS_ANSWERED, $questionsAnswered);
    }

    /**
     * @return array
     */
    public function getResultData()
    {
        $currentAttemptId = $this->session->get(self::SESSION_KEY_CURRENT_ATTEMPT_ID);
        $attempt = $this->getAttemptById($currentAttemptId);

        $correctAnswerCount = 0;

        foreach ($attempt->userAnswers as $userAnswer) {
            $correctAnswerCount += $userAnswer->answer->is_correct;
        }

        $this->session->delete(self::SESSION_KEY_CURRENT_ATTEMPT_ID);
        $this->session->delete(self::SESSION_KEY_QUESTIONS_ANSWERED);

        return [
            'correctAnswerCount' => $correctAnswerCount,
        ];
    }

    /**
     * @param $attemptId
     * @return \Quiz\Models\AttemptModel|null
     * @throws Exception
     */
    public function getAttemptById($attemptId)
    {
        $attempt = $this->attemptRepository->one(['id' => $attemptId]);
        if (!$attempt) {
            throw new QuizException('Quiz has not been started');
        }
        return $attempt;
    }


}