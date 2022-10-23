<?php

class Registration extends Model {



    public function getUserbyLogin($login)
    {

        $query = db::getInstance()->Select('SELECT * FROM user WHERE user_login=:login', ['login' => $login]);

        return $query;

    }

    public function addUser($data) {

        $help = new Help();
        $salt = $help->token(6);

        $data_query = array(
            'name'          => $data['name'],
            'login'         => $data['login'],
            'password'      => md5($data['password1'] . $salt),
            'salt'          => $salt
        );

        db::getInstance()->Query('INSERT INTO user SET user_name=:name, user_login=:login, user_password=:password, salt=:salt', $data_query);

    }
}