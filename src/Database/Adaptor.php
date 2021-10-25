<?php
namespace PhpFramework\Database;

class Adaptor{
    private static $pdo;
    private static $sth;
    public static function setup($dsn, $username, $password){
        self::$pdo = new \PDO($dsn, $username, $password); //초기화
    }
    
    public static function exec($query, $params = []){
        if(self::$sth = self::$pdo->prepare($query)){
            return self::$sth->execute($params);
        }
    }

    public static function getAll($query, $params= [], $classname = 'stdClass'){
        if(self::exec($query, $params)){
            return self::$sth->fetchAll(\PDO::FETCH_CLASS, $classname); //fetchAll : 결과를 다 return
        }
    }
}