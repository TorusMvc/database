<?php

namespace Pyramit;

class connection {

	public static function conn() {
		try {

			$host      = config( 'database.mysql.host' );
			$usernamne = config( 'database.mysql.username' );
			$password  = config( 'database.mysql.password' );
			$database  = config( 'database.mysql.database' );
			$charset   = config( 'database.mysql.charset' );
			$port      = config( 'database.mysql.port' );

			$connect = new \PDO( "mysql:host=$host;port=$port;dbname=$database;charset=$charset", $usernamne, $password );

			return $connect;
		} catch ( PDOException $ex ) {
			die( $ex->getMessage() );
		}

	}

}