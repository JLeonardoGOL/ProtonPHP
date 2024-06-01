<?php

namespace config;

class Database
{
    public static function db()
    {
        return self::id();
    }

    protected static function id()
    {
        $driver = "sqlsrv";
        $hostname = "localhost";
        $database = "master";
        $user = "sa";
        $pass = "desarrollo12345*";
        return [$driver,$hostname,$database,$user,$pass];
    }
}