<?php

require_once('bdd.php');

class MyPDO
{
    private static $_pdo = null;

    private function __construct() {}

	public static function pdo() : PDO {
        if ( self::$_pdo == null )
            self::$_pdo = new PDO(SQL_DSN, SQL_USERNAME, SQL_PASSWORD);
        return self::$_pdo;
	}
}
