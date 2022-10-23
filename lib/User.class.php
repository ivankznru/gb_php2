<?php

class User
{
	public function verifyUser() {

		$authUser = false;

		// запись индификатора сессии
		$_SESSION['session_id'] = session_id();

		// проверка данных в сессии
		if (isset($_SESSION['login']) && isset($_SESSION['password'])){
			$authUser = $this->checkUserLogin($_SESSION['login'], $_SESSION['password']);
		}

		// попытка авторизации при помощи cookies
		if (!$authUser && isset($_COOKIE['login']) && isset($_COOKIE['password'])) {
			$authUser = $this->checkUserLogin($_COOKIE['login'], $_COOKIE['password']);
		}

		if ($authUser) {
			// запоминаем в куки последнюю посещенную старницу
			$_SESSION['id_user'] = $authUser[0]['id_user'];
			$last_url = end(explode("/", $_SERVER['REQUEST_URI']));

			if (!$last_urls = json_decode($_COOKIE['last_urls'], true)) {
				$last_urls = array($last_url);
			} else {
				array_unshift($last_urls, $last_url);
				$last_urls = array_unique($last_urls);
			}

			setcookie('last_urls', json_encode(array_slice($last_urls, 0, 5), time()+86400));

			return $authUser[0];
		} else {
			return false;
		}
	}

	private function checkUserLogin($login, $password) {

		$query = db::getInstance()->Select('SELECT * FROM user WHERE user_login=:login AND user_password =:password', ['login' => $login, 'password' => $password]);

		return $query;

	}


}