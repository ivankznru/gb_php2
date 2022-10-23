<?php

class Order extends Model {
    protected static $table = 'orders';

    public function addOrder($data) {

        db::getInstance()->Query("INSERT INTO ocorder SET id_user=:id_user, id_order_status='1', total=:total",
            $data['order_info']);
        $id_order = db::getInstance()->lastId();

        foreach ($data['goods'] as $good) {
            $good['id_order'] = $id_order;

            db::getInstance()->Query("INSERT INTO order_product SET id_order=:id_order, id_good=:id_good, quantity=:quantity, price=:price, total=:total",
                $good);
        }

    }

    public function getOrders($user_id) {

        return  db::getInstance()->Select("SELECT * FROM ocorder od LEFT JOIN order_status os ON (od.id_order_status = os.id_order_status)WHERE id_user=:id_user ORDER BY id_order ASC",
            ['id_user' => $user_id]);
    }

    public function getProducts($order_id) {
        return  db::getInstance()->Select("SELECT op.id_good, op.quantity, op.price, op.total, gd.name FROM order_product op LEFT JOIN goods gd ON (op.id_good = gd.id_good) WHERE id_order=:id_order ORDER BY op.price ASC",
            ['id_order' => $order_id]);
    }

    public function getStatuses() {
        return  db::getInstance()->Select("SELECT * FROM order_status");
    }

    public function changeStatus($data) {
        // проверяем на связка Номер Заказа - Пользователь
        $order_id = db::getInstance()->Select("SELECT DISTINCT(id_order) FROM ocorder WHERE id_order=:id_order AND id_user=:id_user", ['id_order' => $data['id_order'], 'id_user' => $data['id_user']]);

        if (!$order_id) return false;

        db::getInstance()->Query("UPDATE ocorder SET id_order_status=:id_status WHERE id_order=:id_order", ['id_order' => $order_id[0]['id_order'], 'id_status' => $data['id_status']]);

        return true;

    }
}