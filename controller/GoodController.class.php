<?php
class GoodController extends Controller
{

    public $view = 'good';

    public function index($parameters = array()) {
        
        $data = array();

        if (!isset($parameters['id']) || !(int)$parameters['id']) return $data;
            
        $product_info = Good::getGood((int)$parameters['id']);

        if (!$product_info) return $data;
        
        $data['good'] = $product_info;
        
        return $data;

    }
}
?>