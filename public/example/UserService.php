<?php


class UserService
{
    public $repository;
    protected  $emails;

    public function __construct(UserRepositoryInterface $repository, EmailInterface $emails)
    {
        $this->emails = $emails;
        $this->repository = $repository;
    }

    public function register(string $name, string $email)
    {
        if($this->repository->exists($name)) {
            return false;
        }

        $user = new UserModel();
        $user->name = $name;

        $user = $this->repository->save($user);

        $this->emails->send($email, 'Hello ' . $user->name);
        return $user;
    }

    /**
     * @return UserModel[]
     */
    public function getUsers(): array
    {
        return $this->repository->get();
    }
}