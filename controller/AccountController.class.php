<?php

class AccountController extends Controller
{
    public $view = 'account';
    public $title;

    function __construct() {
        parent::__construct();
        $this->title .= ' | Личный кабинет';
    }

    public function index() {

        $data = array();
        $user = new User();

        if ($user->verifyUser()) {
            $data['last_pages'] = json_decode($_COOKIE['last_urls'], TRUE);
        } else {
            $redirect = 'index.php';
            header('Location:'.$redirect);
        }

        $data['orders'] = array();

        if (!$orders = Order::getOrders($_SESSION['id_user'])) return $data;

        foreach ($orders as &$order) {

            if (!$products_info = Order::getProducts($order['id_order'])) {
                continue;
            }

            $goods = array();

            foreach ($products_info as $product) {
                $goods[] = array(
                    'id_good'       => $product['id_good'],
                    'name'          => $product['name'],
                    'quantity'      => $product['quantity'],
                    'price'         => number_format($product['price'], 2, ',', ' '),
                    'total'         => number_format($product['total'], 2, ',', ' '),
                );
            }

            $data['orders'][] = array(
                'id_order'                => $order['id_order'],
                'id_order_status'         => $order['id_order_status'],
                'order_status_name'       => $order['order_status_name'],
                'total'                   => $order['total'],
                'goods'                   => $goods,
            );
        }

        $data['order_statuses'] = Order::getStatuses();

        return $data;
    }


}