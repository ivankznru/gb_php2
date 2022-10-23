<?php

class Login extends Model {

    public function verifyUser($login, $password) {

        $salt = self::getUserSalt($login);

        $password = md5($password . $salt);

        $query = db::getInstance()->Select('SELECT * FROM user WHERE user_login=:login AND user_password =:password', ['login' => $login, 'password' => $password]);

        return $query;

    }
    
    public function getUserSalt($login) {
        $query = db::getInstance()->Select('SELECT salt FROM user WHERE user_login=:login', ['login' => $login]);

        if ($query)
            return $query[0]['salt'];
        else {
            return false;
        }
    }
    
}