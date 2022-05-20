<?php 

class Controller_login extends Controller
{
	function __construct()
	{
		parent::__construct();
		$this->model = new Model_Login();
	}
	
	function action_index()
	{
		$this->view->generate('login_view.php', 'template_view.php');
		var_dump($_COOKIE);
	}

	function action_login(){
		if (!empty($_POST)){
			$this->model->login($_POST);	
		}
	}
}
?>
