<?php

class Response {
    public static function show($data="")
    {
        if (is_array($data)){
            print json_encode($data,201);
        }else{
            print $data;
        }
    }
}