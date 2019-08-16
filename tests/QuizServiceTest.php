<?php

namespace Quiz\Tests;


use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Quiz\Exceptions\QuizException;
use Quiz\Models\AttemptModel;
use Quiz\Models\QuizModel;
use Quiz\Repositories\AnswerRepository;
use Quiz\Repositories\AttemptRepository;
use Quiz\Repositories\QuestionRepository;
use Quiz\Repositories\QuizRepository;
use Quiz\Repositories\UserAnswersRepository;
use Quiz\Repositories\UserRepository;
use Quiz\Services\QuizService;
use Quiz\Session;

class QuizServiceTest extends TestCase
{
    /** @var QuizRepository|MockInterface $quizRepository */
    private $quizRepository;

    /** @var UserRepository|MockInterface $userRepository */
    private $userRepository;

    /** @var QuestionRepository|MockInterface $questionRepository */
    private $questionRepository;

    /** @var AnswerRepository|MockInterface $answerRepository */
    private $answerRepository;

    /** @var UserAnswersRepository|MockInterface $userAnswersRepository */
    private $userAnswersRepository;

    /** @var AttemptRepository|MockInterface $attemptRepository */
    private $attemptRepository;

    /** @var Session|MockInterface $session */
    private $session;

    /** @var QuizService $quizService */
    private $quizService;

    public function setUp(): void
    {
        parent::setUp();

        $this->quizRepository = \Mockery::mock(QuizRepository::class);
        $this->userRepository = \Mockery::mock(UserRepository::class);
        $this->questionRepository = \Mockery::mock(QuestionRepository::class);
        $this->answerRepository = \Mockery::mock(AnswerRepository::class);
        $this->userAnswersRepository = \Mockery::mock(UserAnswersRepository::class);
        $this->attemptRepository = \Mockery::mock(AttemptRepository::class);
        $this->session = \Mockery::mock(Session::class);

        $this->quizService = new QuizService(
            $this->quizRepository,
            $this->userRepository,
            $this->questionRepository,
            $this->answerRepository,
            $this->userAnswersRepository,
            $this->attemptRepository,
            $this->session
        );
    }

    public function testQuizStart_UserDoesntExist_exceptionThrow()
    {
        $this->userRepository
            ->shouldReceive('userExist')
            ->once()
            ->andReturnFalse();

        $this->expectException(QuizException::class);

        $this->quizService->start(1,1);
    }

    public function testQuizStart_quizDoesntExist_exceptionThrow()
    {
        $this->userRepository
            ->shouldReceive('userExist')
            ->once()
            ->andReturnTrue();

        $this->quizRepository
            ->shouldReceive('one')
            ->once()
            ->andReturnNull();

        $this->expectException(QuizException::class);

        $this->quizService->start(1,1);
    }

    public function tearDown(): void
    {
        parent::tearDown();

        \Mockery::close();
    }

    public function testQuizStart_everythingIsCorrect_quizReturned()
    {
        $this->userRepository
            ->shouldReceive('userExist')
            ->atLeast()
            ->once()
            ->andReturnTrue();

        $returnedQuiz = new QuizModel();
        $returnedQuiz->id = 500;

        $this->quizRepository
            ->shouldReceive('one')
            ->atLeast()
            ->once()
            ->andReturn($returnedQuiz);

        $returnAttempt = new AttemptModel();
        $returnAttempt->id = 100;

        $userId = 30;
        $quizId = 15;

        $this->attemptRepository
            ->shouldReceive('create')
            ->atLeast()
            ->once()
            ->with([
                'user_id' => $userId,
                'quiz_id' => $quizId
            ])->once()
            ->andReturn($returnAttempt);

        $this->session->shouldReceive('set')->atLeast()->twice();

        $quiz = $this->quizService->start($userId, $quizId);

        $this->assertEquals($returnedQuiz->id, $quiz->id, 'Correct quiz returned');
    }

}