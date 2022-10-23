<?php
class CategoriesController extends Controller
{

    public $view = 'categories';

    public function index($rdata)
    {
        $data = array();

        $data['categories'] = Category::getCategories(isset($rdata['id']) ? $rdata['id'] : 0);
        $data['goods'] = Good::getGoods(isset($rdata['id']) ? $rdata['id'] : 0);
        
        return $data;
    }
}
?>