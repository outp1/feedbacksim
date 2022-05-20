<?php 

class Model_AdmPanel extends Model
{
	
	public function __construct() 
	{
		parent::__construct();
	}

	public function get_data() {
		$query = "SELECT * FROM reviews";
		return $data = pg_fetch_all(pg_query($this->conn, $query));
	}

	public function moderate($data = null)
	{
		if ($data['action'] == 'accept_review') {
			$query = "UPDATE reviews SET mod_status = True WHERE review_id = $data[review_id]";
			pg_query($this->conn, $query);
			header('Content-Type: application/json');
			$data = ['result' => 'ok'];
			echo json_encode($data);
		}
	}
}

?>


