<?php

class LoginController extends Controller
{
	public $view = 'index';
	public $title;
	private $error;

	function __construct()
	{
		parent::__construct();
//		$this->title .= ' | Регистрация нового пользователя';

	}

	public function index() {
		
		$data = array();

		if (isset($_POST['name'])) {
			$login = $_POST['name'];
		} else {
			$login = '';
		}

		if (isset($_POST['password'])) {
			$password = $_POST['password'];
		} else {
			$password = '';
		}

		if (isset($_POST['remember'])) {
			$remember = $_POST['remember'];
		} else {
			$remember = false;
		}

		if (isset($_POST['redirect'])) {
			$redirect = $_POST['redirect'];
		} else {
			$redirect = 'index';
		}

		$this->verifyUser($login, $password, $remember);
		unset($_POST);
		header('Location:'.$redirect);


	}

	public function logout() {

		unset($_SESSION['password']);
		unset($_SESSION['user_name']);
		unset($_SESSION['login']);
		setcookie('login', ' ', time() - 86400);
		setcookie('password', ' ', time() - 86400);

		if (isset($_POST['redirect'])) {
			$redirect = $_POST['redirect'];
		} else {
			$redirect = 'index';
		}

		unset($_POST);
		header('Location:'.$redirect);
	}

	private function verifyUser($login, $password, $remember = false) {

		$_SESSION['login'] = $login;

		$verify = Login::verifyUser($login, $password);

		if (!$verify) {

			$_SESSION['error']['login'] = 'Неверное имя или пароль';

			return;
		}

		if (isset($_SESSION['error']['login'])) {
			unset($_SESSION['error']['login']);
		}

		$_SESSION['password'] = $verify[0]['user_password'];
		$_SESSION['user_name'] = $verify[0]['user_name'];
		
		if($remember) {
			setcookie('login', $login, time()+86400);
			setcookie('password', $verify[0]['user_password'], time()+86400);
		} else {
			setcookie('login', ' ', time() - 86400);
			setcookie('password', ' ', time() - 86400);
		}

	}
	

}