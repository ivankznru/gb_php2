<?php

class OrderController extends Controller
{
    public $view = 'order';
    public $title;
    private $error;

    function __construct() {

        parent::__construct();
        $this->title .= ' | Заказ';

    }

    public function changeStatus() {

        if (!isset($_POST['id_order']) || !isset($_POST['id_status']) || !isset($_SESSION['id_user'])) return array('error' => 'Ошибка');

        $data = array(
            'id_order'  => (int)$_POST['id_order'],
            'id_status' => (int)$_POST['id_status'],
            'id_user'   => $_SESSION['id_user']
        );

        if ($result = Order::changeStatus($data)) {
            return array('success' => 'Успешно');
        } else {
            return array('error' => 'Что то пошло не так');
        }

    }

}