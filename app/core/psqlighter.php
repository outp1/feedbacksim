<?php

class Psqlighter { 

	protected $conn;


	public function __construct() {

		$host=$_ENV['PSQL_HOST'];
		$db =$_ENV['PSQL_DB'];
		$username =$_ENV['PSQL_USER'];
		$password =$_ENV['PSQL_PASS'];

		$this->conn = pg_connect("host=$host port=5432 dbname=$db user=$username password=$password");

		if (!$this->conn) 
			die('Could not connect');
		else
			return $this->conn;

	}
	
	public function __destruct() {
		return pg_close($this->conn);
	}
}
 
# Создаем соединение с базой
 

// синтаксиc 
// $sql = "CREATE TABLE IF NOT EXISTS testtable (
// id serial PRIMARY KEY,
// number character varying(20) NOT NULL UNIQUE,
// name character varying(20) NOT NULL,
// kol character varying(20) NOT NULL
// )";
//  
// $res = pg_query($sql);
// // $res = pg_query($dbconn, "select table_name, column_name from information_schema.columns where table_schema='public'");
// if (!$res) {
// echo "Произошла ошибка.\n";
// }
//   
// while ($row = pg_fetch_row($res)) {
// echo "tableName: $row[0] ColumnName: $row[1]";
// echo "<br />\n";
// }
//  
// $res = pg_query($dbconn, "INSERT INTO testtable (id,number,name,kol) VALUES(1,'2','Name1','4')");
// $res = pg_query($dbconn, "INSERT INTO testtable (id,number,name,kol) VALUES(2,'3','Name2','4')");
//  
// $res = pg_query($dbconn, "select name, kol from testtable where id=2");
//  
// while ($row = pg_fetch_row($res)) {
// echo "Name: $row[0] Kol: $row[1]";
// echo "<br />\n";
// }

?>
