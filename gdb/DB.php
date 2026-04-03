<?php
namespace gdb ;
class DB
{
    protected \PDO $pdo;

    public function __construct()
    {
        $db_name = "bestmeal";
        $db_host = "127.0.0.1";
        $db_port = "3306";
        $db_user = "root";
        $db_pwd = "";

        $dsn = "mysql:dbname=$db_name;host=$db_host;port=$db_port;charset=utf8";
        $this->pdo = new \PDO($dsn, $db_user, $db_pwd);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
}