<?php 

class Model_Review extends Model
{
	
	public function __construct() 
	{
		parent::__construct();
		$table = "CREATE TABLE IF NOT EXISTS reviews (
		review_id		INT NOT NULL,
		username		TEXT NOT NULL,
		email			TEXT NOT NULL,
		review_text		TEXT NOT NULL,
		image_id		TEXT,
		message_date		TEXT,
		date			TEXT,
		mod_status		BOOLEAN DEFAULT False,
		upd_date		TEXT DEFAULT '0'
);";
		pg_query($this->conn, $table);
	}

	public function get_data()
	{
		$query = "SELECT * FROM reviews";
		return $data = pg_fetch_all(pg_query($this->conn, $query));
	}
}

?>
