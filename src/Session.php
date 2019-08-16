<?php


namespace Quiz;


use Quiz\Models\UserModel;

class Session
{
    const TYPE_MESSAGE = 'messages';
    const TYPE_ERROR = 'errors';
    const LOGGED_IN_USER = 'loggedInUser';

    protected static $instance;


    public function __construct()
    {
        session_start();
    }

    public static function getInstance(): Session
    {
        if (!self::$instance) {
            self::$instance = new Session();
        }

        return self::$instance;
    }

    public function get(string $key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }

    public function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }



    public function hasErrors(): bool
    {
        return (bool)$this->hasMessages(self::TYPE_ERROR);
    }

    public function hasMessages(string $type = self::TYPE_MESSAGE): bool
    {
        return (bool)$this->getMessage($type);
    }

    /**
     * @return array
     */
    public function getErrors(bool $flush = false): array
    {
        return $this->getMessage(self::TYPE_ERROR, $flush);
    }
    public function addError(string $string)
    {
        $this->addMessage($string, self::TYPE_ERROR);

    //        if (!isset($_SESSION['errors'])) {
    //            $_SESSION['errors'] = [];
    //        }
    //
    //        $_SESSION['errors'][] = $string;
    }

    public function getMessage(string $type = self::TYPE_MESSAGE, bool $flush = false): array
    {
        $messages = $_SESSION[$type] ?? [];
        if ($flush) {
            $_SESSION[$type] = [];
        }

        return $messages;
    }

    public function addMessage(string $string, string $type = self::TYPE_MESSAGE)
    {
        $messages = $this->get($type, []);
        $messages[] = $string;
        $this->set($type, $messages);
    }

    public function setLoggedInUser(UserModel $user)
    {
        $this->set(self::LOGGED_IN_USER, $user->id);
    }

    public function getLoggedInUserId(): ?int
    {
        return $this->get(self::LOGGED_IN_USER);
    }

    public function logoutUser()
    {
        unset($_SESSION[self::LOGGED_IN_USER]);
    }

    public function delete(string $key)
    {
        unset($_SESSION[$key]);
    }

}