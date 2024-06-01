<?php

class HttpResponse
{
    public static $global_path = [];

    public static function get($pathname, $content)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            self::$global_path[$pathname] = $content;
        }else{
            print "The method GET is not exist. The method are you using is ".$_SERVER['REQUEST_METHOD'];
        }
    }

    public static function post($pathname, $content)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            self::$global_path[$pathname] = $content;
        }else{
            print "The method POST is not exist. The method are you using is ".$_SERVER['REQUEST_METHOD'];
        }
    }

    public static function put($pathname, $content)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            self::$global_path[$pathname] = $content;
        }else{
            print "The method PUT is not exist. The method are you using is ".$_SERVER['REQUEST_METHOD'];
        }
    }

    public static function delete($pathname, $content)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            self::$global_path[$pathname] = $content;
        }else{
            print "The method DELETE is not exist. The method are you using is ".$_SERVER['REQUEST_METHOD'];
        }
    }

    public static function run()
    {
        $error_log = false;
        $message = "";
        foreach (self::$global_path as $path => $content) {
            if (parse_url($path,PHP_URL_PATH) == parse_url($_SERVER["REQUEST_URI"],PHP_URL_PATH)) {
                if(is_callable(self::$global_path[$path])) {
                    self::$global_path[$path]();
                }else{
                    if (is_array(self::$global_path[$path])){
                        include "./controllers/".self::$global_path[$path][0].".php";
                        $data = new self::$global_path[$path][0]();
                        call_user_func([$data, self::$global_path[$path][1]]);
                    }else{
                        print json_encode(self::$global_path[$path]);
                    }
                }
                $error_log = true;
                break;
            }else{
                $message = parse_url($_SERVER["REQUEST_URI"],PHP_URL_PATH);
            }
        }

        if (!$error_log) {
            print "The route is not correct. You are declaring this page: ".$message;
        }
    }
}