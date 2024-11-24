<?php
//Hi My Torus
namespace Pyramit;

use Pyramit\Connection;

class DB {

	public static function query() {
		$item = func_get_args(); // gelen veriyi dizi halinde alıyoruz
		$data = Connection::conn()->query( implode( $item ) );
		$data = $data->fetchAll( \PDO::FETCH_OBJ );

		return $data;
	}

	public static function select() {
		$item = func_get_args(); // gelen veriyi dizi halinde alıyoruz
		$data = Connection::conn()->prepare( implode( $item ) );
		$data->execute();
		$data = $data->fetchAll( \PDO::FETCH_OBJ );

		return $data;
	}

	public static function insert() {
		$data   = func_get_args(); // gelen veriyi dizi halinde alıyoruz
		$values = [];
		$params = [];
		$keys   = [];
		foreach ( $data[0][1] as $key => $value ) {
			$values[] = "?";
			$params[] = $value;
			$keys[]   = $key;
		}
		$table    = $data[0][0];
		$val      = implode( ', ', $keys );
		$sql      = "INSERT INTO $table ($val) VALUES ";
		$sql      .= '(' . implode( ', ', $values ) . ')';
		$response = Connection::conn()->prepare( $sql );
		if ( $response->execute( $params ) ) {
			return true;
		} else {
			return false;
		}

	}


	public static function update() {
		$data = func_get_args(); // gelen veriyi dizi halinde alıyoruz

		// Sorguya dinamik olarak hangi alanların güncelleneceğini ekleyeceğiz
		$setParts = []; // 'name = ?, email = ?, age = ?' gibi kısımlar olacak
		$params   = []; // Parametreler dizisi, bindParam ile kullanılacak

		$table = $data[0][0];
		$sql   = "UPDATE $table SET ";

		// Verileri döngüyle işleyip sorguyu dinamik olarak hazırlıyoruz
		foreach ( $data[0][1] as $key => $value ) {
			$setParts[] = "$key = ?";  // her alan için 'key = ?' şeklinde bir kısım
			$params[]   = $value;        // her alanın değeri
		}

		// SET kısmındaki tüm alanları birleştiriyoruz
		$sql .= implode( ", ", $setParts );

		// WHERE kısmı, hangi kaydın güncelleneceğini belirtmek için
		$sql .= " WHERE id = ?";

		// Parametreleri array olarak ekliyoruz
		$params[] = $data[0][2][0];  // WHERE kısmındaki ID parametresini ekliyoruz

		// SQL sorgusunu hazırlıyoruz
		$response = Connection::conn()->prepare( $sql );

		// Veriyi güncelleme işlemi
		if ( $response->execute( $params ) ) {
			return true;
		} else {
			return false;
		}
	}


	public static function delete() {
		$data = func_get_args(); // gelen veriyi dizi halinde alıyoruz

		$params   = []; // Parametreler dizisi, bindParam ile kullanılacak

		$table = $data[0][0];
		$sql   = "DELETE FROM $table WHERE id = ?";

		// Parametreleri array olarak ekliyoruz
		$params[] = $data[0][1][0];  // WHERE kısmındaki ID parametresini ekliyoruz

		// SQL sorgusunu hazırlıyoruz
		$response = Connection::conn()->prepare( $sql );

		// Veriyi güncelleme işlemi
		if ( $response->execute( $params ) ) {
			return true;
		} else {
			return false;
		}
	}


}