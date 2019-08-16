<?php


class UserArrayRepository implements UserRepositoryInterface
{
    /**
     * @var UserModel[]
     */
    protected $users = [];

    public function save(UserModel $user): UserModel
    {
        $user->id = count($this->users) + 1;
        $this->users[] = $user;

        return $user;
    }

    public function exists(string $name): bool
    {
        foreach($this->users as $user) {
            if($user->name == $name) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return UserModel[]
     */
    public function get(): array
    {
        return $this->users;
    }
}