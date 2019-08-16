<?php


namespace Quiz\Controlers;

use Quiz\Services\UserService;
use Quiz\Session;
use Exception;

class AuthController extends BaseController
{
    protected $registrationValidationRule = [
        'password' => 'required|confirmed|min:8',
        'email' => 'required|unique:users|email',
        'name' => 'required'
    ];

    public function register()
    {
        return $this->view('register');
    }

    public function login()
    {
        return $this->view('login');
    }

    public function registerPost()
    {
        $data = $this->input;

        if ($data['password'] !== $data['password_confirmation']){
            Session::getInstance()->addError('Password do not commit');
            redirect('register');
            die;
        }

        $userService = new UserService();
        try {
            $userService->registerUser($data);
        }
        catch (Exception $exeption) {
            Session::getInstance()->addError($exeption->getMessage());
            redirect('register');
        }

        Session::getInstance()->addMessage('Created sucsessfuly');
        redirect();
    }

    public function loginPost()
    {
        $data = $this->input;
        $userService = new UserService();
        try {
            $userService->attemptLogin($data);
            redirect();
        } catch (Exception $exeption) {
            Session::getInstance()->addError($exeption->getMessage());
            redirect('login');
        }

    }

    public function logout()
    {
        Session::getInstance()->logoutUser();
        redirect();
    }

}