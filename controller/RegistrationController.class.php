<?php

class RegistrationController extends Controller
{
    public $view = 'registration';
    public $title;
    private $error;

    function __construct()
    {
        parent::__construct();
        $this->title .= ' | Регистрация нового пользователя';

    }

    public function index() {

        $data = array();

        if (isset($_POST['name']) && $this->validate()) {
            Registration::addUser($_POST);
            unset($_POST);
        }

        if (isset($_POST['login'])) {
            $data['login'] = $_POST['login'];
        } else {
            $data['login'] = '';
        }

        if (isset($_POST['name'])) {
            $data['name'] = $_POST['name'];
        } else {
            $data['name'] = '';
        }

        if (isset($_POST['password1'])) {
            $data['password1'] = $_POST['password1'];
        } else {
            $data['password1'] = '';
        }

        if (isset($_POST['password2'])) {
            $data['password2'] = $_POST['password2'];
        } else {
            $data['password2'] = '';
        }

        $data['error'] = $this->error;

        return $data;

    }

    private function validate() {

        //    проверка логина
        if (mb_strlen($_POST['login'], 'utf-8') < 3 || mb_strlen($_POST['login'], 'utf-8') > 64){
            $this->error['error_login'] = 'Логин должен быть от 3 до 64 символов';
        }

        if (Registration::getUserbyLogin($_POST['login'])) {
            $this->error['error_login'] = 'Такой логин существует';
        }

        //    проверка имени
        if (mb_strlen($_POST['name'], 'utf-8') < 3 || mb_strlen($_POST['name'], 'utf-8') > 64){
            $this->error['error_name'] = 'Имя должно быть от 3 до 64 символов';
        }

        // проверка паролей
        if (mb_strlen($_POST['password1'], 'utf-8') < 3 || mb_strlen($_POST['password2'], 'utf-8') > 64){
            $this->error['error_password'] = 'Пароль должен быть от 3 до 64 символов';
        }

        if ($_POST['password1'] != $_POST['password2']){
            $this->error['error_password'] = 'Введенные пароли не совпадают';
        }

        if ($this->error) {
            return false;
        } else {
            return true;
        }

    }


}