<?php class Controller_Main extends Controller

{
	
	function __construct(){
		parent::__construct();
		$this->model = new Model_Review();
	}

	function action_index()
	{	
		$data = $this->model->get_data();
		$this->view->generate('main_view.php', 'template_view.php', $data);
	}
}
