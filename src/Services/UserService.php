<?php

namespace Quiz\Services;

use Quiz\Models\UserModel;
use Quiz\Repositories\UserRepository;
use Exception;
use Quiz\Session;

class UserService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    /**
     * @param array $data
     * @return UserModel
     * @throws Exception
     */
    public function registerUser(array $data): UserModel
    {
        if ($this->repository->userExist(['email' => $data['email']])) {
            throw new Exception('User already exist');
        }

        return $this->repository->create($data);
    }

    /**
     * @param array $data
     * @throws Exception
     */
    public function attemptLogin(array $data)
    {
        $user =  $this->repository->one(['email' => $data['email']]);

        $userExists = (bool)$user;
        $isPasswordCorrect =  password_verify($data['password'], $user->password ?? '');

        if (!$userExists || !$isPasswordCorrect) {
            throw new Exception('Could not log you in! Try agen!');
        }

        $this->login($user);
    }

    protected function login(UserModel $user)
    {
        Session::getInstance()->setLoggedInUser($user);
    }


}