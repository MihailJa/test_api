<?php
 define('DB_NAME', 'students');
 define('DB_HOST', '127.0.0.1');
 define('DB_USER', 'root');
 define('DB_PASS', '');

class DB {
/*
    $dsn = $dsn = "mysql:host=localhost";
    $pdo = new PDO($dsn,"root","");
"CREATE DATABASE IF NOT EXISTS Student"
    //Creation of user "user_name"
    $pdo->query("CREATE USER 'user_name'@'%' IDENTIFIED BY 'pass_word';");
    //Creation of database "new_db"
    $pdo->query("CREATE DATABASE `new_db`;");
    //Adding all privileges on our newly created database
    $pdo->query("GRANT ALL PRIVILEGES on `new_db`.* TO 'user_name'@'%';");*/
    private static $db;
    
    public static function connect() {
        if (!self::$db) {
            try {
                self::$db = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST.';charset=utf8mb4;', DB_USER, DB_PASS, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
            } catch (PDOException $e) {
                print 'Error!: '.$e->getMessage().'<br/>';
                die();
            }
        }
        return self::$db;
    }

    public static function query($q) {
        return self::connect()->query($q);
    }


    public static function exec($q) {
        return self::connect()->exec($q);
    }

    public static function fetch_row($q) {
        return $q->fetch();
    }

    public static function fetch_all($q) {
        return $q->fetchAll();
    }

    public static function insert_id() {
        return self::connect()->lastInsertId();
    }

    public static function error() {
        $res = self::connect()->errorInfo();
        trigger_error($res[2], E_USER_WARNING);
        return $res[2];
    }

}
