<?php

class IndexController extends Controller
{
    public $view = 'index';
    public $title;

    function __construct() {
        parent::__construct();
        $this->title .= ' | Главная';
    }

    public function index() {

        $data = array();
        $data['categories'] = Category::getCategories(0);
        return $data;
    }


}