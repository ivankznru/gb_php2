<?php

class App

{
    public static function Init() 
    {
        date_default_timezone_set('Europe/Moscow');
        session_start();
        db::getInstance()->Connect(Config::get('db_user'), Config::get('db_password'), Config::get('db_base'));

        if (php_sapi_name() !== 'cli' && isset($_SERVER) && isset($_GET)) {
            self::web(isset($_GET['path']) ? $_GET['path'] : '');
        }
    }

    protected static function web($url)
    {
        
        $url = explode("/", $url);

        if (isset($url[0]) && $url[0]) {
            $_GET['page'] = $url[0];
            if (isset($url[1])) {
                if (is_numeric($url[1])) {
                    $_GET['id'] = $url[1];
                } else {
                    $_GET['action'] = $url[1];
                }
                if (isset($url[2])) {
                    $_GET['id'] = $url[2];
                }
            }
        }
        else{

            $_GET['page'] = 'Index';
        }

        if (isset($_GET['page'])) {

            $data = array();
            $user = new User();
            $data['user_data'] = $user->verifyUser();
            
            $controllerName = ucfirst($_GET['page']) . 'Controller';
            $methodName = isset($_GET['action']) ? $_GET['action'] : 'index';
            $controller = new $controllerName();

            $cdata = $controller->$methodName($_GET);

            if (!isset($_GET['asAjax'])) {
                $data = array_merge($data, $cdata);
                $data['redirect'] = end(explode("/", $_SERVER['REQUEST_URI']));
                $data['session'] = $_SESSION;
            } else {
                $data = $cdata;
            }

            $view = $controller->view . '.twig';

            if (!isset($_GET['asAjax'])) {
                $loader = new Twig_Loader_Filesystem(Config::get('path_templates'));
                $twig = new Twig_Environment($loader);
                $template = $twig->loadTemplate($view);
                
                echo $template->render($data);
            } else {
                echo json_encode($data);
            }
        }
    }


}