<?php
//
// Контроллер странцы чтения
//
include_once('m/M_User.php');

class C_User extends C_Base{

    //	public function action_auth(){
    /*$this-'>title .= '::Авторизация;
    $user = new M_User();
    $info = "Пользователь не авторизован";
    if($_POST){
        $auth = $_POST['auth'];
        $info = $user->auth("log","past"));
        $this->content = $this->Template('v_auth.php', array('text' => $info));
    }
    else{
       $this->content = $this->Template('v/v_auth.php');
    }
    */
//	}

    public function action_auth() {
        $this->title .= '::Авторизация';
        $this->content = $this->Template('v/v_auth.php', array());
        if ($this->isPost()) {
            $user = new M_User();
            $info = $user->auth($_POST['auth'], $_POST['password']);
            $this->content = $this->Template('v/v_auth.php' , array('text'=> $info));
        }
        else{
            $this->content = $this->Template('v/v_auth.php');
        }
    }


   public function action_account(){

       $user = new M_User();
       $info = $user -> get_Id($_SESSION['user_id']);
       $this->title .= '::' . $info['name'];
       $this->content = $this->Template('v/v_account.php', array('username'=> $info['name'], 'userlogin'=>$info['auth']));
   }

      public function action_reg(){

       $this->title .= '::Регистрация';
       $this->content = $this->Template('v/v_reg.php', array());

       if($this->isPost()) {
           $user = new M_User();
           $info = $user->reg($_POST['name'], $_POST['auth'], $_POST['password']);
           $this->content = $this->Template('v/v_reg.php', array('text' => $info));
       }
   }


   public function action_auth_out() {
     $user = new M_User();
     $result = $user->auth_out();
   }

}

?>