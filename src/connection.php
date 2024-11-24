<?php
namespace Pyramit;

class connection {

	public static function conn() {
		require $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
		try {

			$host     = $pdo['host'];
			$user     = $pdo['user'];
			$password = $pdo['password'];
			$database = $pdo['database'];
			$charset  = $pdo['charset'];
			$port     = $pdo['port'];
			$connect = new \PDO("mysql:host=$host;port=$port;dbname=$database;charset=$charset", $user, $password);

			return $connect;
		} catch ( PDOException $ex ) {
			die( $ex->getMessage() );
		}

	}

}