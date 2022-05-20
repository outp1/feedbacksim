<?php 

class Model_Login extends Model
{
	
	public function __construct() 
	{
		parent::__construct();
		//якобы генерируется бд с юзерами, куда добавляется суперпользователь
	}

	public function login($data = null)
	{
		//якобы данные берутся из бд, но сроки жмут	
		if ($data['login'] == $_ENV['ADMIN_LOGIN'] && $data['password'] == $_ENV['ADMIN_PASS']) {
			header('Content-Type: application/json');
			$data = ['result' => 'admin'];
			echo json_encode($data);
		}
	}
}

?>

