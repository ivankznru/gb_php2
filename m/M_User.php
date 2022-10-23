<?php
include_once 'config/db.php';

class  M_User {

    //	function auth($auth,$pass){
    //....
//        return true;
//    }

    private $conn_DB;

    public function __construct() {
        $this->conn_DB = $this->connect_PDO();
    }

    public  function connect_PDO () {
       return new PDO(DRIVER . ':host=' . SERVER . ';dbname=' . DB, USERNAME, PASSWORD);
    }

    public function auth ($auth, $pass)
    {
        $user =$this->conn_DB->query("SELECT * FROM users WHERE login = '" . $auth . "'")->fetch();
        if ($user) {
            if ($user['password'] == $this->pass_md5($user['name'], strip_tags($pass))) {
                $_SESSION['user_id'] = $user['id'];
                return 'Добро пожаловать в систему,' . $user['name'] . '!';
            } else {
                return 'Пароль не верный!';
            }
        } else {
            return 'Пользователь с таким логином не зарегистрирован!';
        }
    }

    public  function get_Id ($id)
    {

        return $this->conn_DB->query("SELECT * FROM users WHERE id = '" . $id . "'")->fetch();
    }


    public function reg ($name, $auth, $pass) {
        $user = $this->conn_DB->query("SELECT * FROM users WHERE login = '" . $auth . "'")->fetch();
        if (!$user) {
           if ($this->conn_DB->exec("INSERT INTO users VALUES
          (null, '" . $name ."','" . $auth ."','" . $this->pass_md5($name, $pass) ."')")){
           return "Вы успешно зарегистрированы";
           }

        } else {
            return "Логин уже используеться!";
        }

    }


    public function auth_out() {
        if (isset($_SESSION["user_id"])) {
            $_SESSION["user_id"]=null;
            session_destroy();
            return true;
        }
        return false;
    }

    public function pass_md5 ($name, $pass) {
        return strrev(md5($name)) . md5($pass);
    }
}