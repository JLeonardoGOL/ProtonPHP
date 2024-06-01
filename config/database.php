<?php

namespace db;

class Database
{
    public function ConnectionDB(array $params)
    {
        return self::GetConnectionDB($params);
    }

    protected function GetConnectionDB($params)
    {
        $driver = $params[0];
        $hostname = $params[1];
        $database = $params[2];
        $user = $params[3];
        $pass = $params[4];
        try {
            return new \PDO("$driver:server=$hostname;database=$database;Encrypt=false", "$user", "$pass");
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public static function query($query = "", $params = [])
    {
        $database = new \config\Database();
        $database = $database::db();

        $sql_conn = new \db\Database();
        $sql_conn = $sql_conn->ConnectionDB($database);

        $result = $sql_conn->prepare($query);
        $result->execute($params);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
}