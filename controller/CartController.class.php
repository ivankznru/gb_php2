<?php

class CartController extends Controller
{
    public $view = 'cart';
    public $title;
    private $error;

    function __construct() {

        parent::__construct();
        $this->title .= ' | Корзина';

    }

    public function index() {

        $data = array();
        if (!$cartGoods = Cart::getInfo()) return $data;

        $data['total'] = 0;
        foreach ($cartGoods as $good) {
            $product_info = Good::getGood($good['id_good']);
            $data['goods'][] = array(
                'id_good'       => $good['id_good'],
                'name'          => $product_info['name'],
                'quantity'      => $good['quantity'],
                'price'         => number_format($product_info['price'], 2, ',', ' '),
                'total'         => round($good['price'], 2)
            );
            $data['total'] += round($good['price'], 2);
        }

        $data['total'] = number_format($data['total'], 2, ',', ' ');

        return $data;

    }

    public function add() {

        if (!isset($_POST['id_good'])) return array('error' => 'Ошибка');

        $data = array();

        if (isset($_SESSION['id_user'])) {
            $data['id_user'] = $_SESSION['id_user'];
        } else {
            $data['id_user'] = 0;
        }

        $data['id_good'] = $_POST['id_good'];
        $product_info = Good::getGood($_POST['id_good']);

        if (!$product_info) return array('error' => 'Ошибка');

        $data['price'] = $product_info['price'];

        $data['session_id'] = $_SESSION['session_id'];

        Cart::addCart($data);

        return array('success' => 'Добавлено');
    }

    public function order() {

        $data = array();
        if (!$cartGoods = Cart::getInfo()) return array('error' => 'Ошибка');

        if (isset($_SESSION['id_user'])) {
            $id_user = $_SESSION['id_user'];
        } else {
            return array('error' => 'Зарегистрируйтесь');
        }

        $total = 0;
        foreach ($cartGoods as $good) {
            $product_info = Good::getGood($good['id_good']);
            $data['goods'][] = array(
                'id_good'       => $good['id_good'],
                'quantity'      => $good['quantity'],
                'price'         => $product_info['price'],
                'total'         => round($good['price'], 2)
            );
            $total += round($good['price'], 2);
        }

        $data['order_info'] = array(
            'id_user' => $id_user,
            'total'   => $total
        );

        Order::addOrder($data);
        Cart::clear();

        return array('success' => 'Оформлено');

    }


}