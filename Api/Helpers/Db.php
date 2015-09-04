<?php
namespace Api\Helpers;

// Database
require_once __DIR__ . '/../Libs/MysqliDb/MysqliDb.php';


class Db {
	public static $mysql;

	public static function Connect($host = null, $database = null, $username = null, $password = null, $port = null) {
		self::$mysql = new \MysqliDb($host, $username, $password, $database, $port);
	}

}


