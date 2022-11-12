<?php

namespace App\Services;

class Router
{
    private static $lists = [];

    public static function page($uri, $page_name)
    {
        self::$lists[] = [
            'uri' => $uri,
            'page' => $page_name
        ];
    }

    public static function post($uri, $class, $method, $post = true)
    {
        self::$lists[] = [
            'uri' => $uri,
            'class' => $class,
            'method' => $method,
        ];
    }

    public static function redirect($uri){
        header("Location: " . $uri  );
    }

    public static function run()
    {
        $query = (isset($_GET['q'])) ? $_GET['q'] : '';

        foreach (self::$lists as $route) {
            if ($route['uri'] === '/' . $query) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $action = new $route['class'];
                    $method = $route['method'];
                    $action->$method($_POST);
                    die();
                } else {
                    require_once 'views/pages/' . $route['page'] . '.php';
                    die();
                }
            }
        }
    }

}