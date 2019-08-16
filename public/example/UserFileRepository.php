<?php


class UserFileRepository extends UserArrayRepository implements UserRepositoryInterface
{
    const FILENAME = 'user.json';

    public function __construct()
    {
        if(file_exists(self::FILENAME)) {
            $json = file_get_contents(self::FILENAME);
            $usersArray = json_decode($json, true);

            foreach ($usersArray as $userArray) {
                $user = new UserModel();
                $user->id = $userArray['id'];
                $user->name = $userArray['name'];

                $this->users[] = $user;
            }
        }
    }

    public function saveToFile()
    {
        $json = json_encode($this->users, JSON_PRETTY_PRINT);
        file_put_contents(self::FILENAME, $json);
    }

    public function save(UserModel $user): UserModel
    {
        $user = parent::save($user);
        $this->saveToFile();
        return $user;
    }


}